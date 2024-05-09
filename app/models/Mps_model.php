<?php

class Mps_model{

    private $db;

    public function __construct()
    {
		$this->db = new Database;
    }
    
    public function getMpstoNotify(){
        $this->db->query("SELECT id, mpsproject, namaproject, mps_activity, activity_name, plan_date, selisih FROM v_mps01 where selisih <= 7  order by mpsproject, id ASC");
        return $this->db->resultSet();
    }
    
    public function getInfoDueDate(){
        $this->db->query("SELECT * FROM v_infomation where status = 1");
        return $this->db->resultSet();
    }

    public function getMpsActivity(){
        $this->db->query("SELECT * FROM t_mps_activity");
        return $this->db->resultSet();
    }

    public function getMpsProject(){
        $this->db->query("SELECT * FROM t_mps_project");
        return $this->db->resultSet();
    }

    public function getMpsProjectByID($id){
        $this->db->query("SELECT * FROM t_mps_project WHERE idproject='$id'");
        return $this->db->single();
    }

    public function getMpsActivityByProject($id){
        $this->db->query("SELECT a.*, b.activity_name FROM t_mps_project_activity as a inner join t_mps_activity as b on a.mps_activity = b.activity_id WHERE a.mpsproject='$id'");
        return $this->db->resultSet();
    }

    public function saveMpsProject($data){
        $timestamp    = date_create();
        $mpsprojectid = date_timestamp_get($timestamp);
        $currentDate  = date('Y-m-d');
        $query = "INSERT INTO t_mps_project (idproject,namaproject,status,createdon,createdby) 
                      VALUES(:idproject,:namaproject,:status,:createdon,:createdby)";
        $this->db->query($query);
        $this->db->bind('idproject',   $mpsprojectid);
        $this->db->bind('namaproject', $data['namampsproject']);
        $this->db->bind('status',      '1');
        $this->db->bind('createdon',   $currentDate);
        $this->db->bind('createdby',   $_SESSION['usr_erp']['user']);
        $this->db->execute();


        $idactivity = $data['idactivity'];
        $plandate   = $data['plandate'];
        $actdate    = $data['actdate'];
        $dataToInsert = array();

        $query2 = "INSERT INTO t_mps_project_activity (mpsproject,mps_activity,plan_date,act_date,status,createdon,createdby) 
                      VALUES(:mpsproject,:mps_activity,:plan_date,:act_date,:status,:createdon,:createdby)";
        $this->db->query($query2);
        for($i = 0; $i < count($idactivity); $i++){
            $_plandate = "0000-00-00";
            $_actdate  = "0000-00-00";
            if($plandate[$i] !== ""){
                $_plandate = $plandate[$i];
            }

            if($actdate[$i] !== ""){
                $_actdate = $actdate[$i];
            }

            $insertData = array(
                "mpsproject"   => $mpsprojectid,
                "mps_activity" => $idactivity[$i],
                "plan_date"    => $_plandate,
                "act_date"     => $_actdate,
                "status"       => "Created",
                "createdon"    => date('Y-m-d'),
                "createdby"    => $_SESSION['usr_erp']['user']
            );

            array_push($dataToInsert, $insertData);
        }

        $insert_values = array();
        foreach($dataToInsert as $d){
            $_plandate = "NULL";
            $_actdate  = "NULL";
            if($d['plan_date'] !== null){
                $_plandate = $d['plan_date'];
            }

            if($d['act_date'] !== null){
                $_actdate = $d['act_date'];
            }

            $question_marks[] = '('  . $this->placeholders('?', sizeof($d)) . ')';
            $insert_values[]  = '("'  . $d['mpsproject'] . '", "'  . $d['mps_activity'] . '", "' . $_plandate . '", "' . $_actdate . '", "'. $d['status'].'", "' . $d['createdon'] . '", "' . $d['createdby'] . '")';
        }

        $updateCols = array();

        foreach ($colNames as $curCol) {
            $updateCols[] = $curCol . " = VALUES($curCol)";
        }

        $datafields = array('mpsproject','mps_activity','plan_date','act_date','status','createdon','createdby');
        $sql = "INSERT INTO t_mps_project_activity (" . implode(",", $datafields ) . ") VALUES " .
        implode(',', $insert_values);

        $this->db->query($sql);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateMpsProject($data){
        $idprocess  = $data['idprocess'];
        $idactivity = $data['idactivity'];
        $plandate   = $data['plandate'];
        $actdate    = $data['actdate'];
        $dataToInsert = array();

        for($i = 0; $i < count($idactivity); $i++){
            $_plandate = "0000-00-00";
            $_actdate  = "0000-00-00";
            $_status   = 'Created';

            if($plandate[$i] !== ""){
                $_plandate = $plandate[$i];
            }

            if($actdate[$i] !== ""){
                $_actdate = $actdate[$i];
                $_status  = 'Closed';
            }

            $insertData = array(
                "id"           => $idprocess[$i],
                "mpsproject"   => $data['idproject'],
                "mps_activity" => $idactivity[$i],
                "plan_date"    => $_plandate,
                "act_date"     => $_actdate,
                "status"       => $_status,
                "createdon"    => date('Y-m-d'),
                "createdby"    => $_SESSION['usr_erp']['user']
            );

            array_push($dataToInsert, $insertData);
        }

        $query = Helpers::insertOrUpdate($dataToInsert,'t_mps_project_activity');
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function deleteMpsProject($id){
        $query = "DELETE FROM t_mps_project WHERE idproject='$id'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function closeMpsProject($id){
        $query = "UPDATE t_mps_project set status='2' WHERE idproject='$id'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    function placeholders($text, $count=0, $separator=","){
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }
    
        return implode($separator, $result);
    }
    
    public function getMpsAttachments($id, $project){
        $this->db->query("SELECT * FROM t_mps_attachments where mps_activity_id ='$id' AND mpsproject = '$project'");
        return $this->db->resultSet();
    }
    
    public function savedocfile($data){
        $files = $_FILES;
        $jumlahFile = count($files['efile']['name']);

        $queryInsertImage = "INSERT INTO t_mps_attachments (mps_activity_id, mpsproject, mps_activity, efilename, filepath, createdby, createdon) 
                               VALUES(:mps_activity_id, :mpsproject, :mps_activity, :efilename, :filepath, :createdby, :createdon)";
        
        $this->db->query($queryInsertImage);

        for ($i = 0; $i < $jumlahFile; $i++) {
            $namaFile  = $files['efile']['name'][$i];
            $lokasiTmp = $files['efile']['tmp_name'][$i];
            $location  = "./images/mps/". $namaFile;

            $this->db->bind('mps_activity_id', $data['mpsactid']);
            $this->db->bind('mpsproject',      $data['mpsproject']);
            $this->db->bind('mps_activity',    $data['mpsactivity']);
            $this->db->bind('efilename',       $namaFile);
            $this->db->bind('filepath',        $location);
            $this->db->bind('createdby',       $_SESSION['usr_erp']['user']);
            $this->db->bind('createdon',       date('Y-m-d'));			
            $this->db->execute();

            move_uploaded_file($lokasiTmp, $location);
            // echo "nama: $namaFile, tmp: {$lokasiTmp} <br>";
        }
        return $this->db->rowCount();
	}
}