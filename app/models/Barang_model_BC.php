<?php

class Barang_model{

    private $db;
	  private $table = 't_barang';

    public function __construct()
    {
		  $this->db = new Database;
    }
    
    public function getListBarang()
    {
      $this->db->query("SELECT *, fCurrencyConvertion('USD','IDR') as 'curs' FROM t_material");
		  return $this->db->resultSet();
    }

    public function checkauthdisplayprice(){
      $user = $_SESSION['usr_erp']['user'];
      $this->db->query("SELECT count(*) as 'rows' FROM t_user_object_auth WHERE ob_auth = 'OB_MATPRICE' AND username = '$user'");
		  return $this->db->single();
    }

    public function getusdtoidr(){
      $this->db->query("SELECT fCurrencyConvertion('USD','IDR') as 'kurs'");
      return $this->db->single(); 
    }

    public function getListBarangWithStock(){
      $this->db->query("SELECT material, matdesc, partnumber, partname, matunit, FORMAT(fGetMaterialTotalStock(material), '.', '@') as 'stock' FROM t_material");
		  return $this->db->resultSet();
    }

    public function getBarangByKode($kodebrg)
    {
      $this->db->query("SELECT * FROM t_material WHERE material='$kodebrg'");
		  return $this->db->single();
    }

    public function getBarangBaseUomByKode($kodebrg, $buom)
    {
      $this->db->query("SELECT * FROM t_material2 WHERE material='$kodebrg' and altuom <> '$buom'");
		  return $this->db->resultSet();
    }

    public function getNextNumber($object){
      $this->db->query("call sp_NextNriv('$object')");
      return $this->db->single();
    }

    public function getmaterialunit($matnr, $exclunit){
      $this->db->query("SELECT * FROM t_material2 where material = '$matnr' and altuom not in('$exclunit')");
      return $this->db->resultSet();
    }

    public function  save($data){
        $currentDate = date('Y-m-d h:m:s');

        $checkprice = $this->checkauthdisplayprice();

        $priceidr = 0;
        $priceusd = 0;

        if($checkprice['rows'] > 1){
          $olddata = $this->getBarangByKode($data['kodebrg']);
          $priceidr = $olddata['stdprice'];
          $priceusd = $olddata['stdpriceusd'];
        }

        if(isset($data['inp_stdprice'])){
          $priceidr = $data['inp_stdprice'];
        }

        if(isset($data['inp_stdpriceusd'])){
          $priceusd = $data['inp_stdpriceusd'];
        }
        
        if(isset($data['inp_topprice'])){
          $topprice = $data['inp_topprice'];
        }
        
        if(isset($data['inp_toppriceusd'])){
          $toppriceusd = $data['inp_toppriceusd'];
        }
        
        $material = "";
        if($data['kodebrg'] === ""){
          $kodebrg  = $this->getNextNumber('BARANG');
          $material = $kodebrg['nextnumb'];
        }else{
          $material = $data['kodebrg'];
        }
        // $kodebrg = $this->getNextNumber('BARANG');
        $query = "INSERT INTO t_material (material,matdesc,partname,partnumber,color,size,matunit,minstock,orderunit,stdprice,stdpriceusd,topprice,toppriceusd,active,createdon,createdby) 
                      VALUES(:material,:matdesc,:partname,:partnumber,:color,:size,:matunit,:minstock,:orderunit,:stdprice,:stdpriceusd,:topprice,:toppriceusd,:active,:createdon,:createdby)";
        $this->db->query($query);
        
        $this->db->bind('material',  $material);
        $this->db->bind('matdesc',   $data['namabrg']);
        $this->db->bind('partname',  $data['partname']);
        $this->db->bind('partnumber',$data['partnumber']);
        $this->db->bind('color',     $data['color']);
        $this->db->bind('size',      $data['size']);
        $this->db->bind('matunit',   $data['satuan']);

        if($data['inp_min_stock'] === ""){
          $data['inp_min_stock'] = 0;
        }
        $this->db->bind('minstock',  $data['inp_min_stock']);
        $this->db->bind('orderunit', $data['inp_ounit']);
        
        $idrprice = "";
        $idrprice = str_replace(".", "",  $data['inp_stdprice']);
        $idrprice = str_replace(",", ".", $idrprice);
        if($idrprice === ""){
          $idrprice = 0;
        }
        $this->db->bind('stdprice',  $idrprice);

        $usdprice = "";
        $usdprice = str_replace(".", "",  $data['inp_stdpriceusd']);
        $usdprice = str_replace(",", ".", $usdprice);
        if($usdprice === ""){
          $usdprice = 0;
        }
        $this->db->bind('stdpriceusd',  $usdprice);
        
        $topprice = "";
        $topprice = str_replace(".", "",  $data['inp_topprice']);
        $topprice = str_replace(",", ".", $topprice);
        if($topprice === ""){
          $topprice = 0;
        }
        $this->db->bind('topprice',  $topprice);
        
        $toppriceusd = "";
        $toppriceusd = str_replace(".", "",  $data['inp_toppriceusd']);
        $toppriceusd = str_replace(",", ".", $toppriceusd);
        if($toppriceusd === ""){
          $toppriceusd = 0;
        }
        $this->db->bind('toppriceusd',  $toppriceusd);
        
        $this->db->bind('active',    '1');
        $this->db->bind('createdon', $currentDate);
        $this->db->bind('createdby', $_SESSION['usr_erp']['user']);
        $this->db->execute();

        $altuom = $data['altuom'];
        if(count($altuom)>0){
          $this->savealtuom($material, $data);
        }
        
        return $this->db->rowCount();
    }

    public function savealtuom($kodebrg, $data){

      $altuom = $data['altuom'];
      $currentDate = date('Y-m-d h:m:s');

      $query = "INSERT INTO t_material2 (material,altuom,convalt,baseuom,convbase,createdon,createdby) 
                      VALUES(:material,:altuom,:convalt,:baseuom,:convbase,:createdon,:createdby)
                      ON DUPLICATE KEY UPDATE convalt=:convalt,baseuom=:baseuom,convbase=:convbase";
      $this->db->query($query);
      
      for($i=0; $i<sizeof($altuom); $i++){
        $this->db->bind('material',  $kodebrg);
        $this->db->bind('altuom',    $altuom[$i]);
        $this->db->bind('convalt',   $data['altuomval'][$i]);
        $this->db->bind('baseuom',   $data['baseuom'][$i]);
        $this->db->bind('convbase',  $data['baseuomval'][$i]);
        $this->db->bind('createdon', $currentDate);
        $this->db->bind('createdby', $_SESSION['usr_erp']['user']);
        $this->db->execute();
      }

      // return $this->db->rowCount();
    }

    public function  update($data){

        $checkprice = $this->checkauthdisplayprice();
        $olddata = $this->getBarangByKode($data['kodebrg']);

        $priceidr = 0;
        $priceusd = 0;

        if($checkprice['rows'] > 1){
          $priceidr = $olddata['stdprice'];
          $priceusd = $olddata['stdpriceusd'];
        }

        if(isset($data['inp_stdprice'])){
          $priceidr = $data['inp_stdprice'];
        }

        if(isset($data['inp_stdpriceusd'])){
          $priceusd = $data['inp_stdpriceusd'];
        }
        
        if(isset($data['inp_topprice'])){
          $topprice = $data['inp_topprice'];
        }
        
        if(isset($data['inp_toppriceusd'])){
          $toppriceusd = $data['inp_toppriceusd'];
        }
        
        $this->delete($data['kodebrg']);

        $currentDate = date('Y-m-d h:m:s');
        $query = "INSERT INTO t_material (material,matdesc,partname,partnumber,color,size,matunit,minstock,orderunit,stdprice,stdpriceusd,topprice,toppriceusd,active,createdon,createdby) 
                      VALUES(:material,:matdesc,:partname,:partnumber,:color,:size,:matunit,:minstock,:orderunit,:stdprice,:stdpriceusd,:topprice,:toppriceusd,:active,:createdon,:createdby)
              ON DUPLICATE KEY UPDATE matdesc=:matdesc,partname=:partname,partnumber=:partnumber,color=:color,size=:size,matunit=:matunit,minstock=:minstock,orderunit=:orderunit,stdprice=:stdprice,stdpriceusd=:stdpriceusd,topprice=:topprice,toppriceusd=:toppriceusd";
        $this->db->query($query);

        if($data['inp_min_stock'] === ""){
          $data['inp_min_stock'] = 0;
        }
        
        $this->db->bind('material',  $data['kodebrg']);
        $this->db->bind('matdesc',   $data['namabrg']);
        $this->db->bind('partname',  $data['partname']);
        $this->db->bind('partnumber',$data['partnumber']);
        $this->db->bind('color',     $data['color']);
        $this->db->bind('size',      $data['size']);
        $this->db->bind('matunit',   $data['satuan']);
        $this->db->bind('minstock',  $data['inp_min_stock']);
        $this->db->bind('orderunit', $data['inp_ounit']);
        
        $idrprice = "";
        $idrprice = str_replace(".", "",  $priceidr);
        $idrprice = str_replace(",", ".", $idrprice);

        if($idrprice === ""){
          $idrprice = 0;
        }
        $this->db->bind('stdprice',  $idrprice);
        
        $usdprice = "";
        $usdprice = str_replace(".", "",  $priceusd);
        $usdprice = str_replace(",", ".", $usdprice);
        if($usdprice === ""){
          $usdprice = 0;
        }
        $this->db->bind('stdpriceusd',  $usdprice);
        
        $topprice = "";
        $topprice = str_replace(".", "",  $data['inp_topprice']);
        $topprice = str_replace(",", ".", $topprice);
        if($topprice === ""){
          $topprice = 0;
        }
        $this->db->bind('topprice',  $topprice);
        
        $toppriceusd = "";
        $toppriceusd = str_replace(".", "",  $data['inp_toppriceusd']);
        $toppriceusd = str_replace(",", ".", $toppriceusd);
        if($toppriceusd === ""){
          $toppriceusd = 0;
        }
        $this->db->bind('toppriceusd',  $toppriceusd);

        $this->db->bind('active',    '1');
        $this->db->bind('createdon', $currentDate);
        $this->db->bind('createdby', $_SESSION['usr_erp']['user']);
        $this->db->execute();

        // $this->savealtuom($data['kodebrg'], $data);
        if(isset($data['altuom'])){
          $altuom = $data['altuom'];
          if(count($altuom)>0){
            $this->savealtuom($data['kodebrg'], $data);
          }
        }
        return $this->db->rowCount();
    }

    public function delete($kodebrg){
      $this->db->query("DELETE FROM t_material WHERE material=:material");
      $this->db->bind('material',$kodebrg);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function updatekursusdidr($newvalue){
        $newcurs = "";
        $newcurs = str_replace(".", "",  $newvalue);
        $newcurs = str_replace(".", "",  $newcurs);
        $newcurs = str_replace(",", ".",  $newcurs);
        $query = "UPDATE t_kurs set kurs2=:kurs2 WHERE currency1=:currency1 AND currency2=:currency2";
        $this->db->query($query);
      
        $this->db->bind('currency1',   'USD');
        $this->db->bind('currency2',   'IDR');
        $this->db->bind('kurs2',        $newcurs);
        $this->db->execute();

        return $this->db->rowCount();
    }
}