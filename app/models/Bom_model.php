<?php

class Bom_model{

    private $db;

    public function __construct()
    {
		$this->db = new Database;
    }

    public function bomList(){
        if($_SESSION['usr_erp']['userlevel'] === "Customer"){
            $custid = $_SESSION['usr_erp']['customer'];
            $this->db->query("SELECT * FROM t_bom01 WHERE cust_id = '$custid'");
        }else{
            $this->db->query("SELECT * FROM t_bom01");    
        }
        
        return $this->db->resultSet(); 
    }

    public function bomHeader($bomid){
        $this->db->query("SELECT * FROM t_bom01 WHERE bomid='$bomid'");
        return $this->db->single(); 
    }

    public function bomDetail($bomid){
        $this->db->query("SELECT a.*, b.matdesc FROM t_bom02 as a left join t_material as b on a.component = b.material WHERE a.bomid='$bomid'");
        return $this->db->resultSet(); 
    }

    public function bomVersionDetail($bomid, $version){
        $this->db->query("SELECT a.*, b.matdesc FROM t_bom02 as a left join t_material as b on a.component = b.material WHERE a.bomid='$bomid' and a.bom_version='$version'");
        return $this->db->resultSet(); 
    }

    public function bomVersionList($bomid){
        $this->db->query("SELECT distinct bom_version from t_bom02 WHERE bomid='$bomid'");
        return $this->db->resultSet(); 
    }

    public function getLatestVersion($bomid){
        $this->db->query("SELECT max(bom_version) as latestversion from t_bom02 WHERE bomid='$bomid'");
        return $this->db->single(); 
    }

    public function bomcalculation($bomid,$qty,$version){
        $this->db->query("SELECT a.bomid,a.partnumber,a.component,a.quantity,ROUND(a.quantity*'$qty',2) as 'Total', a.unit, b.matdesc, b.stdprice, b.stdpriceusd FROM t_bom02 as a left join t_material as b on a.component = b.material WHERE a.bomid='$bomid' and a.bom_version='$version'");
        return $this->db->resultSet(); 
    }

    public function getusdtoidr(){
        $this->db->query("SELECT * FROM t_kurs WHERE currency1='USD' and currency2='IDR'");
        return $this->db->single(); 
    }

    public function delete($bomid){
        $this->db->query('DELETE FROM t_bom01 WHERE bomid=:bomid');
        $this->db->bind('bomid',$bomid);
        $this->db->execute();  
        return $this->db->rowCount();
    }

    public function deleteVersion($bomid, $version){
        $this->db->query('DELETE FROM t_bom02 WHERE bomid=:bomid AND bom_version=:bom_version');
        $this->db->bind('bomid',$bomid);
        $this->db->bind('bom_version',$version);
        $this->db->execute();  
        return $this->db->rowCount();
    }

    public function createNewBomVersion($data){
        // $this->deleteVersion($data['bomid'], $data['bom_version']);

        $bomid = $data['bomid'];
        $matnr = $data['itm_material'];
        $menge = $data['itm_qty'];
        $meins = $data['itm_unit'];

        $query2 = "INSERT INTO t_bom02(bomid,bom_version,partnumber,component,quantity,unit,createdon,createdby)
        VALUES(:bomid,:bom_version,:partnumber,:component,:quantity,:unit,:createdon,:createdby)
        ON DUPLICATE KEY UPDATE partnumber=:partnumber,component=:component,quantity=:quantity,unit=:unit";
        $this->db->query($query2);
        for($i = 0; $i < count($matnr); $i++){
            $_menge = "";
            $_menge = str_replace(".", "",  $menge[$i]);
            $_menge = str_replace(",", ".", $_menge);
            $this->db->bind('bomid',        $bomid);
            $this->db->bind('bom_version',  $data['bom_version']);
            $this->db->bind('partnumber',   $data['partnumb']);
            $this->db->bind('component',    $matnr[$i]);            
            $this->db->bind('quantity',     $_menge);
            $this->db->bind('unit',         $meins[$i]);
            $this->db->bind('createdon',    date('Y-m-d'));
            $this->db->bind('createdby',    $_SESSION['usr_erp']['user']);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function update($data){
        $this->delete($data['bomid']);
        // $this->save($data, $data['bomid']);
        $bomid = $data['bomid'];
        $matnr = $data['itm_material'];
        $menge = $data['itm_qty'];
        $meins = $data['itm_unit'];
        $createdon = date('Y-m-d h:m:s');
        $d2 = new Datetime("now");

        if($bomid == null){
            $bomid = $d2->format('U');
        }

        $query1 = "INSERT INTO t_bom01(bomid,partnumber,partname,cust_id,customer,qtycct,reference,createdon,createdby)
                   VALUES(:bomid,:partnumber,:partname,:cust_id,:customer,:qtycct,:reference,:createdon,:createdby)
                   ON DUPLICATE KEY UPDATE partnumber=:partnumber,partname=:partname,cust_id=:cust_id,customer=:customer,reference=:reference,qtycct=:qtycct";

        $this->db->query($query1);
        $this->db->bind('bomid',      $bomid);
        $this->db->bind('partnumber', $data['partnumb']);
        $this->db->bind('partname',   $data['partname']);
        $this->db->bind('cust_id',    $data['custid']); 
        $this->db->bind('customer',   $data['customer']); 
        $this->db->bind('qtycct',     $data['qtycct']); 
        $this->db->bind('reference',  $data['reference']); 
		$this->db->bind('createdon',  $createdon);
        $this->db->bind('createdby',  $_SESSION['usr_erp']['user']);
        $this->db->execute();

        $query2 = "INSERT INTO t_bom02(bomid,bom_version,partnumber,component,quantity,unit,createdon,createdby)
        VALUES(:bomid,:bom_version,:partnumber,:component,:quantity,:unit,:createdon,:createdby)
        ON DUPLICATE KEY UPDATE partnumber=:partnumber,component=:component,quantity=:quantity,unit=:unit";
        $this->db->query($query2);
        for($i = 0; $i < count($matnr); $i++){
            $_menge = "";
            $_menge = str_replace(".", "",  $menge[$i]);
            $_menge = str_replace(",", ".", $_menge);
            $this->db->bind('bomid',        $bomid);
            $this->db->bind('bom_version',  $data['bom_version']);
            $this->db->bind('partnumber',   $data['partnumb']);
            $this->db->bind('component',    $matnr[$i]);            
            $this->db->bind('quantity',     $_menge);
            $this->db->bind('unit',         $meins[$i]);
            $this->db->bind('createdon',    $createdon);
            $this->db->bind('createdby',    $_SESSION['usr_erp']['user']);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function save($data, $bomid = null){
        $matnr = $data['itm_material'];
        $menge = $data['itm_qty'];
        $meins = $data['itm_unit'];
        $createdon = date('Y-m-d h:m:s');
        $d2 = new Datetime("now");

        if($bomid == null){
            $bomid = $d2->format('U');
        }

        $query1 = "INSERT INTO t_bom01(bomid,partnumber,partname,cust_id,customer,qtycct,reference,createdon,createdby)
                   VALUES(:bomid,:partnumber,:partname,:cust_id,:customer,:qtycct,:reference,:createdon,:createdby)
                   ON DUPLICATE KEY UPDATE partnumber=:partnumber,partname=:partname,cust_id=:cust_id,customer=:customer,reference=:reference,qtycct=:qtycct";

        $this->db->query($query1);
        $this->db->bind('bomid',      $bomid);
        $this->db->bind('partnumber', $data['partnumb']);
        $this->db->bind('partname',   $data['partname']);
        $this->db->bind('cust_id',    $data['custid']); 
        $this->db->bind('customer',   $data['customer']); 
        $this->db->bind('qtycct',     $data['qtycct']); 
        $this->db->bind('reference',  $data['reference']); 
		$this->db->bind('createdon',  $createdon);
        $this->db->bind('createdby',  $_SESSION['usr_erp']['user']);
        $this->db->execute();

        $query2 = "INSERT INTO t_bom02(bomid,bom_version,partnumber,component,quantity,unit,createdon,createdby)
        VALUES(:bomid,:bom_version,:partnumber,:component,:quantity,:unit,:createdon,:createdby)
        ON DUPLICATE KEY UPDATE partnumber=:partnumber,component=:component,quantity=:quantity,unit=:unit";
        $this->db->query($query2);
        for($i = 0; $i < count($matnr); $i++){
            $_menge = "";
            $_menge = str_replace(".", "",  $menge[$i]);
            $_menge = str_replace(",", ".", $_menge);
            $this->db->bind('bomid',        $bomid);
            $this->db->bind('bom_version',  1);
            $this->db->bind('partnumber',   $data['partnumb']);
            $this->db->bind('component',    $matnr[$i]);            
            $this->db->bind('quantity',     $_menge);
            $this->db->bind('unit',         $meins[$i]);
            $this->db->bind('createdon',    $createdon);
            $this->db->bind('createdby',    $_SESSION['usr_erp']['user']);
            $this->db->execute();
        }
        return $this->db->rowCount();
    }
    
    public function convertbomtopr($data, $prnum){
        $no = 0;
       
        $createdon = date('Y-m-d h:m:s');

        $query1 = "INSERT INTO t_pr01(prnum,note,prdate,approvestat,warehouse,requestby,createdon,createdby)
                   VALUES(:prnum,:note,:prdate,:approvestat,:warehouse,:requestby,:createdon,:createdby)
                   ON DUPLICATE KEY UPDATE note=:note, prdate=:prdate,approvestat=:approvestat,warehouse=:warehouse,requestby=:requestby,createdon=:createdon,createdby=:createdby";
        

        $this->db->query($query1);
		$this->db->bind('prnum',      $prnum);
        $this->db->bind('note',       'PR Otomatis dari BOM');
        $this->db->bind('prdate',     date('Y-m-d'));
        if($_SESSION['usr_erp']['jbtn'] >= 4){
            $this->db->bind('approvestat','2');
        }else{
            $this->db->bind('approvestat','1');
        }
        
        $this->db->bind('warehouse',  'WH00');
        $this->db->bind('requestby',  'Admin');
		$this->db->bind('createdon',  $createdon);
        $this->db->bind('createdby',  $_SESSION['usr_erp']['user']);
        $this->db->execute();
        $rows = 0;

        $query2 = "INSERT INTO t_pr02(prnum,pritem,material,matdesc,quantity,unit,remark,createdon,createdby)
        VALUES(:prnum,:pritem,:material,:matdesc,:quantity,:unit,:remark,:createdon,:createdby)
        ON DUPLICATE KEY UPDATE material=:material, matdesc=:matdesc, quantity=:quantity, unit=:unit,remark=:remark";
        $this->db->query($query2);
        for($i = 0; $i < count($data); $i++){
            $rows = $rows + 1;
            $this->db->bind('prnum',    $prnum);
			$this->db->bind('pritem',   $rows);
			$this->db->bind('material', $data[$i]['component']);
			$this->db->bind('matdesc',  $data[$i]['matdesc']);
            
            $_menge = "";
            $_menge = str_replace(".", "",  $data[$i]['Total']);
            $_menge = str_replace(",", ".", $_menge);
            $this->db->bind('quantity', $_menge);
            $this->db->bind('unit',     $data[$i]['unit']);
            $this->db->bind('remark',   $data[$i]['partnumber']);
            $this->db->bind('createdon',  $createdon);
            $this->db->bind('createdby',  $_SESSION['usr_erp']['user']);
            $this->db->execute();
        }
        return $this->db->rowCount();
    }
}