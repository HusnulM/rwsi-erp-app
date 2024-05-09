<?php

class Movement extends Controller {
    
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){
		}else{
			header('location:'. BASEURL);
		}
    }

    public function index(){
            $data['title'] = 'Inventory Movement';
            $data['menu']  = 'Inventory Movement';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------

            $data['invmov']   = $this->model('Movement_model')->getInvMovementByAuth();
            $data['whs']      = $this->model('Warehouse_model')->getWarehouseByAuth();

            $data['whslist'] = json_encode($data['whs']);

            $this->view('templates/header_a', $data);
            $this->view('movement/indexnew', $data);
            $this->view('templates/footer_a');
    }

    public function checkporelstat($params){
        $url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];
        $data = $this->model('Po_model')->getPOHeader($ponum);
        echo json_encode($data);
    }

    public function checkauthwhs($whsnum){
        $data = $this->model('Movement_model')->checkwhsauth($whsnum);
        echo json_encode($data);
    }

    public function checkstock($material, $whs, $inputqty){
        $data = $this->model('Movement_model')->checkStockwhs($material, $whs, $inputqty);
        echo json_encode($data);
    }
    
    public function getGrdata($strdate, $enddate){
        $data['data'] = $this->model('Movement_model')->getGRDATA($strdate, $enddate);
        echo json_encode($data);
    }
    
    public function listpotogr(){
        $data['data'] = $this->model('Movement_model')->getPotoGR();
        echo json_encode($data);
    }

    public function listreservasitotf(){
        $data['data'] = $this->model('Movement_model')->getResrvasitoTF();
        echo json_encode($data);
    }

    public function post(){

        if($_POST['immvt'] === "101"){
            $data = $this->model('Po_model')->getPOHeader($_POST['itm_refnum'][0]);
            if($data['approvestat'] === "2"){
                $nextNumb = $this->model('Home_model')->getNextNumber('GRPO');
                if( $this->model('Movement_model')->post($_POST, $nextNumb['nextnumb']) > 0 ) {
                    $return = array(
                        "msgtype" => "1",
                        "message" => "Inventory Movement Posted!",
                        "docnum"  => $nextNumb['nextnumb']
                    );
                    echo json_encode($return);
                    exit;			
                }else{
                    $return = array(
                        "msgtype" => "3",
                        "message" => "Error!",
                        "data"    => Flasher::errorMessage()
                    );
                    $this->model('Movement_model')->delete($nextNumb['nextnumb']);
                    echo json_encode($return);
                    exit;	
                }
            }else{
                $return = array(
                    "msgtype" => "3",
                    "message" => "PO ". $_POST['itm_refnum'][0] ." Not Approved yet or Rejected!"
                );
                echo json_encode($return);
                exit;	
            }
        }else{
            $checkstock = $this->model('Movement_model')->checkinventorystock($_POST);
            
            // echo json_encode($checkstock);
            if(count($checkstock) > 0){
                $return = array(
                    "msgtype" => "2",
                    "message" => "Check inventory stock",
                    "data"    => $checkstock
                );
                echo json_encode($return);
            }else{
                $nextNumb = $this->model('Home_model')->getNextNumber('GRPO');
                if( $this->model('Movement_model')->post($_POST, $nextNumb['nextnumb']) > 0 ) {
                    $return = array(
                        "msgtype" => "1",
                        "message" => "Inventory Movement Posted!",
                        "docnum"  => $nextNumb['nextnumb']
                    );
                    echo json_encode($return);
                    exit;			
                }else{
                    $return = array(
                        "msgtype" => "3",
                        "message" => "Error!",
                        "data"    => Flasher::errorMessage()
                    );
                    $this->model('Movement_model')->delete($nextNumb['nextnumb']);
                    echo json_encode($return);
                    exit;	
                }
            }        
        }
    }
}