<?php

class Home extends Controller {

	public function index()
	{
		if( isset($_SESSION['usr_erp']) ){
			$data['title'] = 'Dashboard';
			$data['menu'] = 'Dashboard';
			$data['menu-dsc'] = '';
			$data['setting'] = $this->model('Setting_model')->getgensetting();
			$data['appmenu'] = $this->model('Home_model')->getUsermenu();

			$this->view('templates/header_a', $data);
			$this->view('dashboard/home', $data);
			$this->view('templates/footer_a',$data);
		}else{
			$data['title'] = 'Login | Procurement Management';
			$this->view('home/login', $data);
		}
	}

	public function members(){
		$data['user'] = $this->model('Home_model')->login($_POST);
		if($data['user'] === false){
			header('location: '. BASEURL );
		}else if($data['user'] == 'X'){
			header('location: '. BASEURL );
		}else{
			Auth::setLoginSession($data['user']['username'],$data['user']['password'],'admin',$data['user']['userlevel'],$data['user']['nama'],$data['user']['jbtn'],$data['user']['department'],$data['user']['jabatan'],$data['user']['cust_id']);
			header('location: '. BASEURL );
		}
	}
	
	public function loginwithreffid(){
		$data['user'] = $this->model('Home_model')->getuserbyreffid($_POST['reffid']);
		if($data['user']['userlevel'] === "Customer"){
		    header('location: '. BASEURL );
		}else{
    		if($data['user']){
    			Auth::setLoginSession($data['user']['username'],$data['user']['password'],'admin',$data['user']['userlevel'],$data['user']['nama'],$data['user']['jbtn'],$data['user']['department'],$data['user']['jabatan'],'');
    			header('location: '. BASEURL );
    		}else{
    			Flasher::setMessage('REFFID Not Registerred','','error');
    			header('location: '. BASEURL );
    		}
		}
	}
	
	public function loginwithqr($uri=null,$reffid){
		$data['user'] = $this->model('Home_model')->getuserbyreffid($reffid);
// 		echo json_encode($data);
		if($data['user']){
			Auth::setLoginSession($data['user']['username'],$data['user']['password'],'admin',$data['user']['userlevel'],$data['user']['nama'],$data['user']['jbtn'],$data['user']['department'],$data['user']['jabatan'],'');
		
			echo json_encode("true");
			exit;
		}else{
			echo json_encode("false");
			exit;
		}
	}
	
	public function loginrfidws()
	{
		$id = $_POST['reffid'];
		$data['user'] = $this->model('Home_model')->getuserbyreffid($id);
		if ($data['user']['userlevel'] === "Customer") {
			echo json_encode(array("message" => "user is customer"));
		} else {
			if ($data['user']) {
				Auth::setLoginSession($data['user']['username'], $data['user']['password'], 'admin', $data['user']['userlevel'], $data['user']['nama'], $data['user']['jbtn'], $data['user']['department'], $data['user']['jabatan'], '');
				echo json_encode(array("message" => "success"));
			} else {
				echo json_encode(array("error" => "reffid not registered"));
			}
		}
	}

	public function logout(){
		//setcookie($_SESSION['usr_erp']['user'], "AUTH-USER", time() - 3600); 
		if($_SESSION['usr_erp']['userlevel'] === "Customer"){
		    unset($_SESSION['usr_erp']);
    		header('location: '. BASEURL );
		}else{
		    if($_SESSION['usr_erp']['department'] === "Produksi" ){
		        unset($_SESSION['usr_erp']);
    		    header('location: '. BASEURL );
		    }else{
        		unset($_SESSION['usr_erp']);
        		header('location: '. 'https://rwsi.co.id/ERPAPPS/');
		    }
		}
	}

	public function register(){
		if( $this->model('Home_model')->register($_POST) > 0 ) {
			Flasher::setMessage('Berhasil','','success');
			header('location: '. BASEURL );
			exit;			
		}else if( $this->model('Home_model')->register($_POST) == 'X' ) {
			Flasher::setMessage('Gagal',', User Sudah Terdaftar','danger');
			header('location: '. BASEURL );
			exit;			
		}else{
			Flasher::setMessage('Gagal','','danger');
			header('location: '. BASEURL );
			exit;	
		}
	}
}