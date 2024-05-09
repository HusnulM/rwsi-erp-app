<?php

class Approvereservation extends Controller{

	public function __construct(){
		if( isset($_SESSION['usr_erp']) ){

		}else{
			header('location:'. BASEURL);
		}
    }

    public function index(){
		$check = $this->model('Home_model')->checkUsermenu('approvereservation','Read');
        if ($check){
			$data['title'] = 'Approve Reservation';
			$data['menu']  = 'Approve Reservation';
			
			// Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------   
			
			$data['rsdata']  = $this->model('Reservation_model')->getOpenReservation();
	
			$this->view('templates/header_a', $data);
			$this->view('reservation/approve', $data);
			$this->view('templates/footer_a');            
        }else{
            $this->view('templates/401');
        }  
    }
    
    public function detail($resnum){
		$check = $this->model('Home_model')->checkUsermenu('approvereservation','Read');
        if ($check){
			$data['title'] = 'Approve Reservation';
			$data['menu']  = 'Approve Reservation';
			
			// Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------  

			$data['head']     = $this->model('Reservation_model')->getReservation01($resnum);
			$data['item']     = $this->model('Reservation_model')->getReservation02($resnum);

			$data['resnum'] = $resnum;
	
			$this->view('templates/header_a', $data);
			$this->view('reservation/approvedetail', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
		}
    }
    
    public function approve($prnum){
        if( $this->model('Reservation_model')->approve($prnum) > 0 ) {
			Flasher::setMessage('Reservation', $prnum . ' Approved' ,'success');
			header('location: '. BASEURL . '/approvereservation');
			exit;			
		}else{
			Flasher::setMessage('Approve Reservation', $prnum . ' Failed','danger');
			header('location: '. BASEURL . '/approvereservation');
			exit;	
		}
    }

	public function deleteitem($rsnum, $rsitem){
		if( $this->model('Reservation_model')->deleteitem($rsnum, $rsitem) > 0 ) {
			$return = array(
				"msgtype" => "1",
				"message" => "Reservation Item Deleted"
			);
			echo json_encode($return);
			exit;			
		}else{
			$return = array(
				"msgtype" => "2",
				"message" => "Cannot Delete Reservation Item"
			);
			echo json_encode($return);
			exit;	
		}
	}
}