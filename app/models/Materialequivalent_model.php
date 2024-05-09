<?php

class Materialequivalent_model{

    private $db;

    public function __construct()
    {
		$this->db = new Database;
    }

    public function countMaterial(){
        $this->db->query("SELECT COUNT(*) as total FROM t_material3");
        return $this->db->single();
    }

    public function getmaterialEqAll(){
        $this->db->query("SELECT * FROM t_material3");
        return $this->db->resultSet();
    }

    public function getmaterialEqByPart($part){
        $this->db->query("SELECT * FROM t_material3 WHERE material='$part'");
        return $this->db->single();
    }

    public function save($data){
        $material = $data['partnumber'];
        $check  = $this->getmaterialEqByPart($material);
        $matequiNumber = 'AWSI - ';
        if($check){
            
            $query1 = "UPDATE t_material3 SET drawingpn=:drawingpn,orignpn=:orignpn,eq01=:eq01,eq02=:eq02,eq03=:eq03,eq04=:eq04,eq05=:eq05,eq06=:eq06,eq07=:eq07,eq08=:eq08,eq09=:eq09,eq10=:eq10,eq11=:eq11,eq12=:eq12 WHERE material=:material";
      
            $this->db->query($query1);
            $this->db->bind('material', $data['partnumber']);
            $this->db->bind('drawingpn',$data['drawingpn']);
            $this->db->bind('orignpn',  $data['orignpn']);
            $this->db->bind('eq01',     $data['eqpn1']);
            $this->db->bind('eq02',     $data['eqpn2']);
            $this->db->bind('eq03',     $data['eqpn3']);
            $this->db->bind('eq04',     $data['eqpn4']);
            $this->db->bind('eq05',     $data['eqpn5']);
            $this->db->bind('eq06',     $data['eqpn6']);
            $this->db->bind('eq07',     $data['eqpn7']);
            $this->db->bind('eq08',     $data['eqpn8']);
            $this->db->bind('eq09',     $data['eqpn9']);
            $this->db->bind('eq10',     $data['eqpn10']);
            $this->db->bind('eq11',     $data['eqpn11']);
            $this->db->bind('eq12',     $data['eqpn12']);
            $this->db->execute();
        }else{
            $count = $this->countMaterial();
            $count['total'] = $count['total'] + 1;
            $strlen = strlen($count['total']);
            if($strlen == 1){
                $matequiNumber = $matequiNumber.'00000'.$count['total'];
            }elseif($strlen == 2){
                $matequiNumber = $matequiNumber.'0000'.$count['total'];
            }elseif($strlen == 3){
                $matequiNumber = $matequiNumber.'000'.$count['total'];
            }elseif($strlen == 4){
                $matequiNumber = $matequiNumber.'00'.$count['total'];
            }elseif($strlen == 5){
                $matequiNumber = $matequiNumber.'0'.$count['total'];
            }else{
                $matequiNumber = $matequiNumber.$count['total'];
            }

            $query1 = "INSERT INTO t_material3(material,drawingpn,orignpn,eq01,eq02,eq03,eq04,eq05,eq06,eq07,eq08,eq09,eq10,eq11,eq12,createdby)
            VALUES(:material,:drawingpn,:orignpn,:eq01,:eq02,:eq03,:eq04,:eq05,:eq06,:eq07,:eq08,:eq09,:eq10,:eq11,:eq12,:createdby)";
      
            $this->db->query($query1);
            $this->db->bind('material', $matequiNumber);
            $this->db->bind('drawingpn',$data['drawingpn']);
            $this->db->bind('orignpn',  $data['orignpn']);
            $this->db->bind('eq01',     $data['eqpn1']);
            $this->db->bind('eq02',     $data['eqpn2']);
            $this->db->bind('eq03',     $data['eqpn3']);
            $this->db->bind('eq04',     $data['eqpn4']);
            $this->db->bind('eq05',     $data['eqpn5']);
            $this->db->bind('eq06',     $data['eqpn6']);
            $this->db->bind('eq07',     $data['eqpn7']);
            $this->db->bind('eq08',     $data['eqpn8']);
            $this->db->bind('eq09',     $data['eqpn9']);
            $this->db->bind('eq10',     $data['eqpn10']);
            $this->db->bind('eq11',     $data['eqpn11']);
            $this->db->bind('eq12',     $data['eqpn12']);
            $this->db->bind('createdby',$_SESSION['usr_erp']['user']);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }
}