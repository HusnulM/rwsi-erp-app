<?php

class Financereport_model{
    private $db;

    public function __construct()
    {
		$this->db = new Database;
    }

    public function amountpo($strdate, $enddate){
        $this->db->query("SELECT * FROM v_reportAmountPO where podat BETWEEN '$strdate' AND '$enddate'");
        return $this->db->resultSet();
    }
    
    public function debtamountpo($strdate, $enddate){
      $this->db->query("SELECT * FROM v_AmoundDebt where movementdate BETWEEN '$strdate' AND '$enddate'");
      return $this->db->resultSet();
    }
    
    public function inventory01(){
      $this->db->query("SELECT * FROM v_inventory01 WHERE quantity > 0");
      return $this->db->resultSet();
    }
    
    public function inventory04($strdate, $enddate){
      $this->db->query("SELECT * FROM v_inventory04 where movementdate BETWEEN '$strdate' AND '$enddate' and warehouse = 'WH00'");
      return $this->db->resultSet();
    }
}