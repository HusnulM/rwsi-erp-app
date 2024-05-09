<?php

class Mpp_model{

    private $db;

    public function __construct()
    {
		$this->db = new Database;
    }

    public function getMPPHeader($bomid, $period){
        $this->db->query("SELECT *, fGetPeriodName(periode) as 'periodname' FROM v_mpp01 WHERE bomid='$bomid' AND periode='$period'");
        return $this->db->single();
    }

    public function getMPPItems($bomid, $period){
        $this->db->query("SELECT * FROM t_mpp02 WHERE bomid='$bomid' AND periode='$period' order by tanggal asc");
        return $this->db->resultSet();
    }

    public function getMPPSummaryData(){
        $this->db->query("SELECT *, fGetPeriodName(periode) as 'periodname' FROM v_mpp01");
        return $this->db->resultSet();
    }
    
    public function materialcalculation($bomid,$qty,$period){
        $this->db->query("SELECT distinct a.bomid,a.partnumber,a.component,a.quantity,ROUND(a.quantity*'$qty',2) as 'Total', a.unit, b.matdesc, fGetTotalRequest(a.bomid,$period,a.component) as 'qtyreq' FROM t_bom02 as a left join t_material as b on a.component = b.material left join t_mpp02 as c on a.bomid = c.bomid WHERE a.bomid='$bomid' and c.periode='$period'");
        return $this->db->resultSet(); 
    }
    
    public function getMPPRerportSummaryData($period){
        $this->db->query("SELECT *, fGetPeriodName(periode) as 'periodname' FROM v_mpp01 where periode='$period'");
        return $this->db->resultSet();
    }

    public function save($data){
        $period = $data['bulan'].$data['tahun'];
        $headerToInsert = array();

        $headertData = array(
            "bomid"        => $data['bomid'],
            "periode"      => $period,
            "assyno"       => $data['assyno'],
            "custid"       => $data['customerid'],
            "customer"     => $data['customer'],
            "partnumber"   => $data['partnumber'],
            "createdon"    => date('Y-m-d'),
            "createdby"    => $_SESSION['usr_erp']['user']
        );

        array_push($headerToInsert, $headertData);
        $query = Helpers::insertOrUpdate($headerToInsert,'t_mpp01');
        $this->db->query($query);
        $this->db->execute();

        $dataToInsert = array();
        $tanggal     = $data['mppdate'];
        // $assyno      = $data['assyno'];
        $quantity    = $data['quantity'];
        $inputqty = 0;
        for($i = 0; $i < sizeof($tanggal); $i++){
            if($quantity[$i] <= 0){
                $inputqty = 0;
            }else{
                $inputqty = $quantity[$i];
            }
            $insertData = array(
                "bomid"        => $data['bomid'],
                "periode"      => $period,
                "tanggal"      => $tanggal[$i],
                "assyno"       => null,
                "partnumber"   => $data['partnumber'],
                "quantity"     => $inputqty,
                "createdon"    => date('Y-m-d'),
                "createdby"    => $_SESSION['usr_erp']['user']
            );

            array_push($dataToInsert, $insertData);
        }

        $query2 = Helpers::insertOrUpdate($dataToInsert,'t_mpp02');
        $this->db->query($query2);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function saveReservation($data, $rsnum){
        try {
            $matnr = $data['itm_material'];
            $maktx = $data['itm_matdesc'];
            $menge = $data['itm_qty'];
            $meins = $data['itm_unit'];
            $txz01 = $data['itm_remark'];
    
            $query1 = "INSERT INTO t_reserv01(resnum,resdate,note,requestor,fromwhs,towhs,refnum,approvestat,createdon,createdby)
                        VALUES(:resnum,:resdate,:note,:requestor,:fromwhs,:towhs,:refnum,:approvestat,:createdon,:createdby)";
    
            $this->db->query($query1);
            $this->db->bind('resnum',       $rsnum);
            $this->db->bind('resdate',      $data['resdate']);
            $this->db->bind('note',         $data['note']);
            $this->db->bind('requestor',    $data['requestor']);
            $this->db->bind('fromwhs',      $data['fromwhs']);
            $this->db->bind('towhs',        $data['towhs']);
            $this->db->bind('refnum',       null);
            $this->db->bind('approvestat',  '1');
            $this->db->bind('createdon',    date('Y-m-d'));
            $this->db->bind('createdby',    $_SESSION['usr_erp']['user']);
            $this->db->execute();
            $rows = 0;
            
            $dataToInsert = array();
            for($i = 0; $i < count($matnr); $i++){
                $rows = $rows + 1;                
                $_menge = "";
                $_menge = str_replace(".", "",  $menge[$i]);
                $_menge = str_replace(",", ".", $_menge);
                $insertData = array(
                    "resnum"    => $rsnum,
                    "resitem"   => $rows,
                    "material"  => $matnr[$i],
                    "matdesc"   => $maktx[$i],
                    "quantity"  => $_menge,
                    "unit"      => $meins[$i],
                    "fromwhs"   => $data['fromwhs'],
                    "towhs"     => $data['towhs'],
                    "remark"    => $txz01[$i],
                    "createdon" => date('Y-m-d'),
                    "createdby" => $_SESSION['usr_erp']['user']
                );
    
                array_push($dataToInsert, $insertData);
            }
            $query2 = Helpers::insertOrUpdate($dataToInsert,'t_reserv02');
            $this->db->query($query2);
            $this->db->execute();

            $periode = $data['periode'];
            $tanggal = $data['tanggal'];
            $bomid   = $data['bomid'];
            $query3 = "UPDATE t_mpp02 set rsnum='$rsnum' WHERE bomid='$bomid' AND periode='$periode' AND tanggal='$tanggal'";
            $this->db->query($query3);
            $this->db->execute();

            return $this->db->rowCount();
        } catch (Exception $e) {
            $message = 'Caught exception: '.  $e->getMessage(). "\n";
            Flasher::setErrorMessage($message,'error');
            return 0;
        }
    }
}