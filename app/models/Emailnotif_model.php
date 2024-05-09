<?php

class Emailnotif_model{

    private $db;

    public function __construct()
    {
		$this->db = new Database;
    }

    public function getAll(){
        $this->db->query("SELECT * FROM t_email_notif");
        return $this->db->resultSet();
    }

    public function save($data){
        $email  = $data['email'];
        $name   = $data['name'];
        $dataToInsert = array();

        for($i = 0; $i < count($email); $i++){
            $insertData = array(
                "email"  => $email[$i],
                "name"   => $name[$i]
            );

            array_push($dataToInsert, $insertData);
        }

        $query = Helpers::insertOrUpdate($dataToInsert,'t_email_notif');
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($email){
        $query = "DELETE FROM t_email_notif WHERE email='$email'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }
}