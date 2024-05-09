<?php

class Pricecomp_model{

	private $db;

	public function __construct()
	{
		$this->db = new Database;
    }

    public function getPriceCompData(){
		$this->db->query("SELECT a.*, b.cust_name FROM v_pricecomp04 as a left join t_customer as b on a.customer = b.cust_id WHERE b.cust_id is not null");
		return $this->db->resultSet();
    }

    public function save($data){        
        $query1 = "INSERT INTO t_pricecompare(customer,partnumber,bomid,actualprice,createdon,createdby)
                   VALUES(:customer,:partnumber,:bomid,:actualprice,:createdon,:createdby)
                   ON DUPLICATE KEY UPDATE actualprice=:actualprice";
        
        $_price = "";
        $_price = str_replace(".", "",  $data['price']);
        $_price = str_replace(",", ".", $_price);

        $this->db->query($query1);
		$this->db->bind('customer',      $data['custid']);
        $this->db->bind('partnumber',    $data['partnumber']);
        $this->db->bind('bomid',         $data['bomid']);
        $this->db->bind('actualprice',   $_price);
		$this->db->bind('createdon',     date('Y-m-d'));
        $this->db->bind('createdby',     $_SESSION['usr_erp']['user']);
        $this->db->execute();
        
        return $this->db->rowCount();
    }
}