<?php

class Pricecomp extends Controller{

	public function __construct(){
		if( isset($_SESSION['usr_erp']) ){
			
		}else{
			header('location:'. BASEURL);
		}
    }

    public function index(){
		$check = $this->model('Home_model')->checkUsermenu('pricecomp','Read');
        if ($check){
			$data['title']    = 'Price Comparison';
			$data['menu']     = 'Price Comparison';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$this->view('templates/header_a', $data);
			$this->view('pricecomp/index', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }          
    }

    public function report(){
        $check = $this->model('Home_model')->checkUsermenu('pricecomp','Read');
        if ($check){
			$data['title']    = 'Price Comparison';
			$data['menu']     = 'Price Comparison';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

            $data['pricecomp'] = $this->model('Pricecomp_model')->getPriceCompData();

			$this->view('templates/header_a', $data);
			$this->view('pricecomp/report', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }   
    }

    public function save(){
        if( $this->model('Pricecomp_model')->save($_POST) > 0 ) {
			Flasher::setMessage('Price Comparison ','Created','success');
			header('location: '. BASEURL . '/pricecomp');
			exit;			
		}else{
			Flasher::setMessage('Error','','danger');
			header('location: '. BASEURL . '/pricecomp');
			exit;	
		}
    }
}