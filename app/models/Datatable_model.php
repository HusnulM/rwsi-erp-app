<?php
class Datatable_model{

    public function listMaterial(){
    
        $host     = DB_HOST; /* Host name */
        $user     = DB_USER; /* User */
        $password = DB_PASS; /* Password */
        $dbname   = DB_NAME; /* Database name */
    
        $con = mysqli_connect($host, $user, $password,$dbname);    
    
        ## Read value
        $draw = $_POST['draw'];
        $row  = $_POST['start'];
        $rowperpage  = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName  = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = mysqli_real_escape_string($con,$_POST['search']['value']); // Search value
    
        ## Search 
        $searchQuery = " ";
        if($searchValue != ''){
          $searchQuery = " and (material like '%".$searchValue."%' or 
                matdesc like '%".$searchValue."%' or 
                partname like'%".$searchValue."%' or
                partnumber like'%".$searchValue."%' 
                ) ";
        }
    
        ## Total number of records without filtering
        $sel = mysqli_query($con,"select count(*) as allcount from t_material");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];
    
        ## Total number of records with filtering
        $sel = mysqli_query($con,"select count(*) as allcount from t_material WHERE 1 ".$searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];
    
        ## Fetch records
        $empQuery = "select *, fCurrencyConvertion('USD','IDR') as 'curs', FORMAT(fGetMaterialTotalStock(material), '.', '@') as 'stock' from t_material WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
        $empRecords = mysqli_query($con, $empQuery);
        $data = array();
    
        while ($row = mysqli_fetch_assoc($empRecords)) {
            $data[] = array(
                "material"=>$row['material'],
                "matdesc"=>$row['matdesc'],
                "mattype"=>$row['mattype'],
                "matgroup"=>$row['matgroup'],
                "partname"=>$row['partname'],
                "partnumber"=>$row['partnumber'],
                "color"=>$row['color'],
                "size"=>$row['size'],
                "matunit"=>$row['matunit'],
                "minstock"=>$row['minstock'],
                "orderunit"=>$row['orderunit'],
                "stdprice"=>$row['stdprice'],
                "stdpriceusd"=>$row['stdpriceusd'],
                "price_jpy"=>$row['price_jpy'],
                "topprice"=>$row['topprice'],
                "toppriceusd"=>$row['toppriceusd'],
                "topprice_jpy"=>$row['topprice_jpy'],
                "active"=>$row['active'],
                "createdon"=>$row['createdon'],
                "createdby"=>$row['createdby'],
                "curs"=>$row['curs'],
                "stock"=>$row['stock'],
              );
        }
    
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "data" => $data
        );
    
        echo json_encode($response);
    }
}
