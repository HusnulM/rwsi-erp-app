<?php

class Material_model{

    private $db;
	  private $table = 't_barang';

    public function __construct()
    {
		  $this->db = new Database;
    }
    
    public function getListBarang()
    {
      $this->db->query('SELECT * FROM t_material limit');
		  return $this->db->resultSet();
    }
    
    public function getListMaterial()
    {
      $this->db->query("SELECT *, fCurrencyConvertion('USD','IDR') as 'curs' FROM t_material");
		  return $this->db->resultSet();
    }

    public function getBarangByKode($kodebrg)
    {
      $this->db->query("SELECT * FROM t_material WHERE material='$kodebrg'");
		  return $this->db->single();
    }

    public function getNextNumber($object){
      $this->db->query("call sp_NextNriv('$object')");
      return $this->db->single();
    }
    
    public function checklabel($qrcode){
      $this->db->query("SELECT COUNT(*) as 'rows' FROM t_labelmaterial WHERE qrlabel='$qrcode'");
      return $this->db->single();
    }
    
    public function getbylabel($qrlabel){
      $this->db->query("SELECT * FROM t_labelmaterial WHERE qrlabel='$qrlabel'");
      return $this->db->single();
    }
    
    public function getDetailLabel($label){
      $this->db->query("SELECT * FROM v_label_gr_details WHERE qrlabel = '$label'");
      return $this->db->resultSet();
    }
    
    public function savelabel($data){
      $query1 = "INSERT INTO t_labelmaterial(qrlabel,material,vendor,grdate,lotnumber,grnum,gryear,gritem,createdby)
      VALUES(:qrlabel,:material,:vendor,:grdate,:lotnumber,:grnum,:gryear,:gritem,:createdby)";

      $this->db->query($query1);
      $this->db->bind('qrlabel',   $data['qrcode']);
      $this->db->bind('material',  $data['material']);
      $this->db->bind('vendor',    $data['vendor']);
      $this->db->bind('grdate',    $data['grdate']);
      $this->db->bind('lotnumber', $data['lotnumber']);
      $this->db->bind('grnum',     $data['grnum']);
      $this->db->bind('gryear',    $data['gryear']);
      $this->db->bind('gritem',    $data['gritem']);
      $this->db->bind('createdby', $_SESSION['usr_erp']['user']);
      $this->db->execute();

      return $this->db->rowCount();
    }
    
    public function closegr($grnum,$gryear,$gritem){
      $query2 = "UPDATE t_inv_i SET label=:label WHERE grnum=:grnum and year=:year and gritem=:gritem";
      $this->db->query($query2);
      $this->db->bind('grnum',     $grnum);
      $this->db->bind('year',      $gryear);
      $this->db->bind('gritem',    $gritem);
      $this->db->bind('label',     'X');     
      $this->db->execute();
      return $this->db->rowCount();
    }

    public function  save($data){
        $currentDate = date('Y-m-d');
        $kodebrg = $this->getNextNumber('BARANG');
        $query = "INSERT INTO t_material (material,matdesc, matunit, active, createdon, createdby) 
                      VALUES(:material,:matdesc,:matunit,:active,:createdon,:createdby)";
        $this->db->query($query);
        
        $this->db->bind('material',  $kodebrg['nextnumb']);
            $this->db->bind('matdesc',  $data['namabrg']);
            $this->db->bind('matunit',   $data['satuan']);
            $this->db->bind('active',   '1');
            $this->db->bind('createdon',$currentDate);
            $this->db->bind('createdby',$_SESSION['usr_erp']['user']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function  update($data){
      $query = "UPDATE t_material set matdesc=:matdesc, matunit=:matunit WHERE material=:material";
      $this->db->query($query);
      
      $this->db->bind('material',  $data['kodebrg']);
          $this->db->bind('matdesc',  $data['namabrg']);
          $this->db->bind('matunit',   $data['satuan']);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function delete($kodebrg){
      $this->db->query("DELETE FROM t_material WHERE material=:material");
      $this->db->bind('material',$kodebrg);
      $this->db->execute();

      return $this->db->rowCount();
    }
}