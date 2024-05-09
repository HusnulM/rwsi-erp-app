<?php

class Wos extends Controller {
    
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){

		}else{
			header('location:'. BASEURL);
		}
	}

    public function index(){
        $check = $this->model('Home_model')->checkUsermenu('wos','Read');
        if ($check){
            $data['title'] = 'Input WOS';
            $data['menu']  = 'Input WOS';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $this->view('templates/header_a', $data);
            $this->view('wos/create', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function displaywos(){
        $check = $this->model('Home_model')->checkUsermenu('wos/displaywos','Read');
        if ($check){
            $data['title'] = 'Display WOS';
            $data['menu']  = 'Display WOS';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $this->view('templates/header_a', $data);
            $this->view('wos/display', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function receiptwos(){
        $check = $this->model('Home_model')->checkUsermenu('wos/receiptwos','Read');
        if ($check){
            $data['title'] = 'Receipt WOS';
            $data['menu']  = 'Receipt WOS';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   
            
            $data['meja']     = $this->model('Meja_model')->listnomeja();
            $data['userlist'] = $this->model('User_model')->userList();
			$data['activity'] = $this->model('Activity_model')->activityList();
			$data['defect']   = $this->model('Inspection_model')->jenisDefect();
			$data['section']  = $this->model('Inspection_model')->defectSection();

            $this->view('templates/header_a', $data);
            $this->view('wos/receiptwos', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function report(){
        $check = $this->model('Home_model')->checkUsermenu('wos','Read');
        if ($check){
            $data['title'] = 'WOS Report';
            $data['menu']  = 'WOS Report';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $this->view('templates/header_a', $data);
            $this->view('wos/reports', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }
    
    public function addlabel(){
        $check = $this->model('Home_model')->checkUsermenu('wos/addlabel','Read');
        if ($check){
            $data['title'] = 'Add WOS Label';
            $data['menu']  = 'Add WOS Label';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $this->view('templates/header_a', $data);
            $this->view('wos/addlabel', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }
    
    public function trackingwos(){
        $check = $this->model('Home_model')->checkUsermenu('wos/trackingwos','Read');
        if ($check){
            $data['title'] = 'Tracking WOS';
            $data['menu']  = 'Tracking WOS';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $this->view('templates/header_a', $data);
            $this->view('wos/trackingwos', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }
    
    public function trackingwosrfid(){
        $check = $this->model('Home_model')->checkUsermenu('wos/trackingwosrfid','Read');
        if ($check){
            $data['title'] = 'Tracking WOS By RFID';
            $data['menu']  = 'Tracking WOS By RFID';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $this->view('templates/header_a', $data);
            $this->view('wos/trackingwosrfid', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        } 
    }
    
    public function printwostracking($qrcode){
		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['header']   = $this->model('Wos_model')->getwosdatabyqrcode($qrcode);
		$data['detail']   = $this->model('Laporan_model')->getWosTracking($data['header']['id'],$data['header']['bomid']);
		$this->view('wos/printwostracking', $data);
	}

    // wos/receiptwos
    public function getwosdatabyqrcode($qrcode){
        $data = $this->model('Wos_model')->getwosdatabyqrcode($qrcode);
        echo json_encode($data);
    }
    
    public function getwosdatabyrfid($reffid){
        $data = $this->model('Wos_model')->getwosdatabyrfid($reffid);
        echo json_encode($data);
    }
    
    public function getwosdata($reffid){
        $data = $this->model('Wos_model')->getwosdata($reffid);
        echo json_encode($data);
    }
    
    public function getwoslastposition($reffid){
        $data = $this->model('Wos_model')->checkWosLastPosition($reffid);
        echo json_encode($data);
    }

    public function getwosdatabydate($strdate, $enddate){
        $data['data'] = $this->model('Wos_model')->getwosbydate($strdate, $enddate);
        echo json_encode($data);
    }
    
    public function checkreffiduse($reffid){
        $data = $this->model('Wos_model')->reffidvalidation($reffid);
        echo json_encode($data);
    }

    public function save(){
        $isreffidused = $this->model('Wos_model')->reffidvalidation($_POST['reffid']);
        if($isreffidused['rows'] > 0){
            $return = array(
                "msgtype" => "2",
                "message" => "REFFID ". $_POST['reffid'] . " already use in another WOS"
            );
            echo json_encode($return);
            exit;
        }else{
            if( $this->model('Wos_model')->save($_POST) > 0 ) {
                $return = array(
                    "msgtype" => "1",
                    "message" => "WOS Data created"
                );
                echo json_encode($return);
                exit;				
            }else{
                $return = array(
                    "msgtype" => "2",
                    "message" => "WOS Error"
                );
                echo json_encode($return);
                exit;	
            }
        }
    }
    
    public function savelabel(){
        $checklabel = $this->model('Wos_model')->checklabel($_POST['qrcode']);
        if($checklabel['rows'] > 0){
            $return = array(
                "msgtype" => "2",
                "message" => "QRCODE ". $_POST['qrcode'] . " already use in another WOS"
            );
            echo json_encode($return);
            exit;
        }else{
            if( $this->model('Wos_model')->savelabel($_POST) > 0 ) {
                $return = array(
                    "msgtype" => "1",
                    "message" => "WOS Label created"
                );
                echo json_encode($return);
                exit;				
            }else{
                $return = array(
                    "msgtype" => "2",
                    "message" => "No Data Updated"
                );
                echo json_encode($return);
                exit;	
            }
        }
    }
    
    public function savewos(){
        
            if( $this->model('Wos_model')->savewos($_POST) > 0 ) {
                $return = array(
                    "msgtype" => "1",
                    "message" => "WOS Data created"
                );
                echo json_encode($return);
                exit;				
            }else{
                $return = array(
                    "msgtype" => "2",
                    "message" => "WOS Error"
                );
                echo json_encode($return);
                exit;	
            }
    }

    public function closewos($reffid){
        if( $this->model('Wos_model')->closewos($reffid, $_POST) > 0 ) {
            $return = array(
                "msgtype" => "1",
                "message" => "WOS REFFID ". $reffid . ' Closed'
            );
            echo json_encode($return);
            exit;				
        }else{
            $return = array(
                "msgtype" => "2",
                "message" => "WOS Error"
            );
            echo json_encode($return);
            exit;	
        }
    }
}