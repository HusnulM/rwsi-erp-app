<?php

class Reset extends Controller{
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){
            if($_SESSION['usr_erp']['userlevel'] == 'SysAdmin'){

            }else{
                header('location:'. BASEURL);
            }
		}else{
			header('location:'. BASEURL);
		}
    }
    
    public function index(){
		$data['title'] = 'Reset Data';
		$data['menu']  = 'Reset Data';
		$data['menu-dsc'] = '';

		$data['setting'] = $this->model('Setting_model')->getgensetting();

		$this->view('templates/header_a', $data);
		$this->view('reset/index', $data);
		$this->view('templates/footer_a');
    }

	public function resetdata(){
		$this->model('Home_model')->resetdata();
	}
}