<?php

class Wip_model{

	private $db;

	public function __construct()
	{
		$this->db = new Database;
		ini_set('date.timezone', 'Asia/Jakarta');
    }
    
    public function listmeja(){
        $this->db->query("SELECT * FROM t_meja WHERE filter_summary ='X'");
        return $this->db->resultSet();
    }
    
    public function getWipProcessAuth(){
        $user = $_SESSION['usr_erp']['user'];
        $this->db->query("SELECT * FROM t_user_object_auth WHERE username = '$user' and ob_auth='OB_WIP' and ob_value = '*'");
        $data = $this->db->resultSet();
        if($data){
            return $data;
        }else{
            $this->db->query("SELECT * FROM t_user_object_auth WHERE username = '$user' and ob_auth='OB_WIP'");
            return $this->db->resultSet();
        }        
    }

    public function getWipData($strdate, $enddate){
        $this->db->query("SELECT area,deskripsi, partnumber, customer, period, sum(quantity) as quantity FROM v_stockwip
WHERE quantity > 0 and period between '$strdate' AND '$enddate' and deskripsi not like'%DELIVERY%'
GROUP BY area,deskripsi, partnumber, customer");
        return $this->db->resultSet();
    }
    
    public function reportSummaryWIP(){
        
        if($_SESSION['usr_erp']['userlevel'] === "Customer"){
            $custid = $_SESSION['usr_erp']['customer'];
            $this->db->query("SELECT area,deskripsi, partnumber, customer, sum(quantity) as quantity FROM v_stockwip 
            WHERE cust_id = '$custid' AND quantity > 0 and deskripsi like'%GUDANG FG SIAP KIRIM%' and deskripsi not like'%DELIVERY%'
            GROUP BY area,deskripsi, partnumber, customer");
        }else{
            //  $this->db->query("SELECT area,deskripsi, partnumber, customer, sum(quantity) as quantity FROM v_stockwip WHERE quantity > 0 and deskripsi not like'%DELIVERY%'
            //     GROUP BY area,deskripsi, partnumber, customer");
                
            $this->db->query("SELECT area,deskripsi, partnumber, customer, sum(quantity) as quantity FROM v_stockwip WHERE quantity > 0
                              and area in(select nomeja from t_meja where filter_summary = 'X')
                              GROUP BY area,deskripsi, partnumber, customer");
        }
        
       
        return $this->db->resultSet();
    }

    public function getSummaryWIP(){
        $this->db->query("CALL sp_ReportWIP1()");
        return $this->db->resultSet();
    }

    public function getDetailWIP($strdate, $enddate){
        $this->db->query("SELECT * FROM v_wip01 WHERE periode between '$strdate' AND '$enddate' AND area1 not like'%DELIVERY%' order by wipid,from_area,wiptype,periode,jam asc");
        return $this->db->resultSet();
    }
    
    public function getareadesc($area){
        $this->db->query("SELECT * FROM t_meja WHERE nomeja='$area'");
        return $this->db->single();
    }

    public function save($data){
        ini_set('date.timezone', 'Asia/Jakarta');
        $query1 = "INSERT INTO t_wip(wiptype,from_area,dest_area,bomid,partnumber,customer,quantity,periode,createdon,createdby)
        VALUES(:wiptype,:from_area,:dest_area,:bomid,:partnumber,:customer,:quantity,:periode,:createdon,:createdby)";
        
        if($data['bomid'] === ""){
            return 0;
            exit;
        }elseif($data['area1'] === ""){
            return 0;
            exit;
        }
        
        $this->db->query($query1);
        $this->db->bind('wiptype',      strtoupper($data['wiptype']));
        $this->db->bind('from_area',    $data['area1']);
        $this->db->bind('dest_area',    $data['area2']);
        $this->db->bind('bomid',        $data['bomid']);
        $this->db->bind('partnumber',   $data['partnumber']);
        $this->db->bind('customer',     $data['customer']);
        $this->db->bind('quantity',     $data['quantity']);
        $this->db->bind('periode',      $data['idate']);
        $this->db->bind('createdon',    date('Y-m-d h:m:s'));
        $this->db->bind('createdby',    $_SESSION['usr_erp']['user']);
        $this->db->execute();

        if(strtoupper($data['wiptype']) === "OUT"){
            $areadesc = $this->getareadesc($data['area2']);
            if (strpos($areadesc['deskripsi'], 'DELIVERY') !== false) {
                
            }else{
                $query2 = "INSERT INTO t_wip(wiptype,from_area,dest_area,bomid,partnumber,customer,quantity,periode,createdon,createdby)
                VALUES(:wiptype,:from_area,:dest_area,:bomid,:partnumber,:customer,:quantity,:periode,:createdon,:createdby)";
    
                $this->db->query($query2);
                $this->db->bind('wiptype',      'IN');
                $this->db->bind('from_area',    $data['area2']);
                $this->db->bind('dest_area',    0);
                $this->db->bind('bomid',        $data['bomid']);
                $this->db->bind('partnumber',   $data['partnumber']);
                $this->db->bind('customer',     $data['customer']);
                $this->db->bind('quantity',     $data['quantity']);
                $this->db->bind('periode',      $data['idate']);
                $this->db->bind('createdon',    date('Y-m-d h:m:s'));
                $this->db->bind('createdby',    $_SESSION['usr_erp']['user']);
                $this->db->execute();
            }
        }
        
        return $this->db->rowCount();
    }

    public function update($data){

    }

    public function delete($id){

    }
}