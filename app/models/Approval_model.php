<?php

class Approval_model{

    private $db;

    public function __construct()
	{
		$this->db = new Database;
    }

    public function getmappingapproval(){
        $this->db->query("SELECT * FROM t_approval");
        return $this->db->resultSet();
    }

    public function getuserapproval(){
        $this->db->query("SELECT * FROM v_user WHERE jabatan >= 4 or userlevel = 'SysAdmin'");
        return $this->db->resultSet();
    }

    public function getusercreator(){
        $this->db->query("SELECT * FROM v_user");
        return $this->db->resultSet();
    }

    public function  save($data){
        $query = "INSERT INTO t_approval (object,creator,approval) 
                      VALUES(:object,:creator,:approval)";
        $this->db->query($query);
        
        $this->db->bind('object',   $data['object']);
        $this->db->bind('creator',  $data['creator']);
        $this->db->bind('approval', $data['approval']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($object,$creator,$approval){
        $query = "DELETE FROM t_approval WHERE object=:object AND creator=:creator AND approval=:approval";
        $this->db->query($query);
      
        $this->db->bind('object',   $object);
        $this->db->bind('creator',  $creator);
        $this->db->bind('approval', $approval);
        $this->db->execute();

        return $this->db->rowCount();
    }
}