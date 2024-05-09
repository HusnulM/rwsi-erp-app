<?php

class Emailnotif extends Controller {
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){

		}else{
			header('location:'. BASEURL);
		}
    }

    public function index(){
        $check = $this->model('Home_model')->checkUsermenu('emailnotif','Read');
        if ($check){
            $data['title'] = 'Email Notif Recipient';
            $data['menu']  = 'Email Notif Recipient';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $data['rdata'] = $this->model('Emailnotif_model')->getAll();   

            $this->view('templates/header_a', $data);
            $this->view('emailnotif/index', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function save(){
        if( $this->model('Emailnotif_model')->save($_POST) > 0 ) {
			Flasher::setMessage('New Email Recipient Created','','success');
			header('location: '. BASEURL . '/emailnotif');
			exit;			
		}else{
			Flasher::setMessage('Failed','','danger');
			header('location: '. BASEURL . '/emailnotif');
			exit;	
	    }
    }

    public function delete($email){
        if( $this->model('Emailnotif_model')->delete($email) > 0 ) {
			Flasher::setMessage('New Email Recipient Deleted','','success');
			header('location: '. BASEURL . '/emailnotif');
			exit;			
		}else{
			Flasher::setMessage('Failed','','danger');
			header('location: '. BASEURL . '/emailnotif');
			exit;	
	    }
    }
}