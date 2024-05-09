<?php

class Po extends Controller{

	public function __construct(){
		if( isset($_SESSION['usr_erp']) ){

		}else{
			header('location:'. BASEURL);
		}
	}

    public function index(){
		$check = $this->model('Home_model')->checkUsermenu('po','Read');
        if ($check){
			$data['title'] = 'Purchase Order';
			$data['menu'] = 'Purchase Order';
			
			// Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------   

			$data['podata']  = $this->model('Po_model')->listopenpo();
	
			$this->view('templates/header_a', $data);
			$this->view('po/index', $data);
			$this->view('templates/footer_a');
		}else{
			$this->view('templates/401');
		}
    }
	
	public function create(){
		$check = $this->model('Home_model')->checkUsermenu('po','Create');
        if ($check){
			$data['title']    = 'Create Purchase Order';
			$data['menu']     = 'Create Purchase Order';
			
			// Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------   
	
			$this->view('templates/header_a', $data);
			$this->view('po/create', $data);
			$this->view('templates/footer_a');
		}else{
			$this->view('templates/401');
		}
	}

	public function detail($params){
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];

		$check = $this->model('Home_model')->checkUsermenu('po','Read');
        if ($check){
			$data['title']    = 'Detail Purchase Order';
			$data['menu']     = 'Detail Purchase Order';
			$data['menu-dsc'] = '';
			
			// Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------   

			$data['pohead']   = $this->model('Po_model')->getPOHeader($ponum);
			$data['vendor']   = $this->model('Vendor_model')->getVendorByKode($data['pohead']['vendor']);
	
			$this->view('templates/header_a', $data);
			$this->view('po/detail', $data);
			$this->view('templates/footer_a');
		}else{
			$this->view('templates/401');
		}
	}

	public function generatenopo($ponum){
		$data = $this->model('Po_model')->generatenopo($ponum);
		echo json_encode($data);
	}

	public function printpo($params){
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];

		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['header']   = $this->model('Po_model')->getOrderHeaderPrint($ponum);
		$data['poitem']   = $this->model('Po_model')->getPOitemPrint($ponum);
		$this->view('po/printpo', $data);
		 //echo json_encode($data['poitem']);
	}
	
	public function testprint($params){
	    $url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];
		
	    $data['poitem']   = $this->model('Po_model')->getPOitemPrint($ponum);
	    echo json_encode($data['poitem']);
	}
	
	public function listprtopo($idproject = null){
		$data = $this->model('Pr_model')->getPRtoPO($idproject);
		echo json_encode($data);
	}

	public function listopenpo(){
		$data = $this->model('Po_model')->listopenpo();
		echo json_encode($data);
	}

	public function savepo(){
		$nextNumb = $this->model('Po_model')->getNextPONumber('PO');
		$ponum = $this->model('Po_model')->generatenopo($nextNumb['nextnumb']);
		if( $this->model('Po_model')->createpo($_POST, $ponum['ponum']) > 0 ) {
			// $result = ["msg"=>"sukses", $nextNumb];
			// echo json_encode($nextNumb['nextnumb']);
			
			Flasher::setMessage('Purchase Order ', $ponum['ponum'] . ' created!', 'success');
			// $result = ["msg"=>"success", "docnum"=>$nextNumb];
			// echo json_encode($result);
			header('location: '. BASEURL . '/po');
			exit;			
		}else{
			$this->model('Po_model')->delete_error($ponum['ponum']);
			$result = ["msg"=>"error"];
			// echo json_encode($result);
			header('location: '. BASEURL . '/po/create');
			exit;	
		}
	}

	public function updatepo($params){
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];

		if( $this->model('Po_model')->updatepo($_POST, $ponum) > 0 ) {
			$result = ["msg"=>"sukses", $ponum];
			echo json_encode($result);
			exit;			
		}else{
			$result = ["msg"=>"error"];
            echo json_encode($result);
			exit;	
		}
	}

	public function getpoitem($params){
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];

		$data = $this->model('Po_model')->getPODetail($ponum);
		echo json_encode($data);
	}

	public function getopenpoitem($params){
		
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];

		$data = $this->model('Po_model')->getOpenPOitem($ponum);
		echo json_encode($data);
	}

	public function delete($params){
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];

		$data   = $this->model('Po_model')->getPOHeader($ponum);
		// echo json_encode($data);
		if($data['approvestat'] === "1"){
			if( $this->model('Po_model')->delete($ponum) > 0 ) {
				Flasher::setMessage('PO '. $ponum .' Berhasil','dihapus','success');
				header('location: '. BASEURL . '/po');
				exit;			
			}else{
				Flasher::setMessage('Gagal menghapus PO,','','danger');
				header('location: '. BASEURL . '/po');
				exit;	
			}
		}else{
			Flasher::setMessage('PO '. $ponum .' tidak bisa dihapus karena sudah di approve/reject,','','danger');
			header('location: '. BASEURL . '/po');
			exit;
		}
	}

	public function approvepo($params){
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];

		if( $this->model('Po_model')->approvepo($ponum) > 0 ) {
			Flasher::setMessage('PO', $ponum . ' Approved' ,'success');
			header('location: '. BASEURL . '/po');
			exit;			
		}else{
			Flasher::setMessage('Approve PO', $ponum . ' Failed','danger');
			header('location: '. BASEURL . '/po');
			exit;	
		}
	}

	public function rejectpo($params){
		$url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];
		if( $this->model('Po_model')->rejectpo($ponum) > 0 ) {
			Flasher::setMessage('PO '. $ponum, 'Rejected' ,'success');
			header('location: '. BASEURL . '/po');
			exit;			
		}else{
			Flasher::setMessage('Reject PO,', $ponum . ' Failed','danger');
			header('location: '. BASEURL . '/po');
			exit;	
		}
	}
}