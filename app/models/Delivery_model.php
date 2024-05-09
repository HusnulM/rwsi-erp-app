<?php

class Delivery_model{

    private $db;

    public function __construct()
    {
		$this->db = new Database;
    }

    public function getdelivery($strdate, $enddate, $bomid){
        if($_SESSION['usr_erp']['userlevel'] === "Customer"){
            $custid = $_SESSION['usr_erp']['customer'];
            if($bomid === '*'){
                $this->db->query("SELECT a.* FROM v_reportdelivery as a inner join t_bom01 as b on a.bomid = b.bomid 
                        WHERE a.deliverydate BETWEEN '$strdate' AND '$enddate' AND b.cust_id = '$custid' order by a.partnumber, a.deliverydate asc");
            }else{
                $this->db->query("SELECT a.* FROM v_reportdelivery as a inner join t_bom01 as b on a.bomid = b.bomid 
                        WHERE a.deliverydate BETWEEN '$strdate' AND '$enddate' AND b.cust_id = '$custid' and b.bomid = '$bomid' order by a.partnumber, a.deliverydate asc");
            }
        }else{
            if($bomid === '*'){
                $this->db->query("SELECT * FROM v_reportdelivery WHERE deliverydate BETWEEN '$strdate' AND '$enddate' order by partnumber, deliverydate asc");
            }else{
                $this->db->query("SELECT * FROM v_reportdelivery WHERE deliverydate BETWEEN '$strdate' AND '$enddate' and bomid = '$bomid' order by partnumber, deliverydate asc");
            }
        }
      
        return $this->db->resultSet();
    }

    public function save($data){
        $d2 = new Datetime("now");

        $query1 = "INSERT INTO t_delivery(deliveryid,bomid,partnumber,deltype,stdpack,reqqty,delqty,quantity,deliverydate,createdby)
                   VALUES(:deliveryid,:bomid,:partnumber,:deltype,:stdpack,:reqqty,:delqty,:quantity,:deliverydate,:createdby)";

        $this->db->query($query1);
        if($data['deltype'] === 'REQ'){
          $this->db->bind('reqqty',      $data['quantity']);
          $this->db->bind('delqty',      '0');
        }else{
          $this->db->bind('reqqty',      '0');
          $this->db->bind('delqty',      $data['quantity']);
        }
        $this->db->bind('deliveryid',    $d2->format('U'));
        $this->db->bind('bomid',         $data['bomid']);
        $this->db->bind('partnumber',    $data['partnumber']);
        $this->db->bind('deltype',       $data['deltype']);
        $this->db->bind('stdpack',       '0');
        $this->db->bind('quantity',      $data['quantity']);
        $this->db->bind('deliverydate',  $data['idate']);
        $this->db->bind('createdby',  $_SESSION['usr_erp']['user']);
        $this->db->execute();        
        
        return $this->db->rowCount();
    }
}