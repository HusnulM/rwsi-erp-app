<?php

class Mps extends Controller {
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){
		}else{
			header('location:'. BASEURL);
		}
    }
    
    public function activity(){
        $check = $this->model('Home_model')->checkUsermenu('mps/activity','Read');
        if ($check){
            $data['title'] = 'MPS Activity';
            $data['menu']  = 'MPS Activity';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $data['activity'] = $this->model('Mps_model')->getMpsActivity();   

            $this->view('templates/header_a', $data);
            $this->view('mps/activity', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function project(){
        $check = $this->model('Home_model')->checkUsermenu('mps/project','Read');
        if ($check){
            $data['title'] = 'MPS Project';
            $data['menu']  = 'MPS Project';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $data['project'] = $this->model('Mps_model')->getMpsProject();   

            $this->view('templates/header_a', $data);
            $this->view('mps/project', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function createproject(){
        $check = $this->model('Home_model')->checkUsermenu('mps/project','Create');
        if ($check){
            $data['title'] = 'Create MPS Project';
            $data['menu']  = 'Create MPS Project';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $data['activity'] = $this->model('Mps_model')->getMpsActivity();   

            $this->view('templates/header_a', $data);
            $this->view('mps/createproject', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }    
    }

    public function detailproject($id){
        $check = $this->model('Home_model')->checkUsermenu('mps/project','Read');
        if ($check){
            $data['title'] = 'Detail MPS Project';
            $data['menu']  = 'Detail MPS Project';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------   

            $data['project']  = $this->model('Mps_model')->getMpsProjectByID($id);
            $data['activity'] = $this->model('Mps_model')->getMpsActivityByProject($id);
            
            $this->view('templates/header_a', $data);
            $this->view('mps/detailproject', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        } 
    }


    public function savempsproject(){
        if( $this->model('Mps_model')->saveMpsProject($_POST) > 0 ) {
			Flasher::setMessage('MPS Project created','','success');
			header('location: '. BASEURL . '/mps/project');
			exit;			
		}else{
			Flasher::setMessage('Failed,','','danger');
			header('location: '. BASEURL . '/mps/project');
			exit;	
	    }
    }

    public function updatempsproject(){
        if( $this->model('Mps_model')->updateMpsProject($_POST) > 0 ) {
			Flasher::setMessage('MPS Project updated','','success');
			header('location: '. BASEURL . '/mps/project');
			exit;			
		}else{
			Flasher::setMessage('No data updated','','danger');
			header('location: '. BASEURL . '/mps/project');
			exit;	
	    }
    }
    
    public function deleteproject($id){
        if( $this->model('Mps_model')->deleteMpsProject($id) > 0 ) {
			Flasher::setMessage('MPS Project deleted','','success');
			header('location: '. BASEURL . '/mps/project');
			exit;			
		}else{
			Flasher::setMessage('No data updated','','danger');
			header('location: '. BASEURL . '/mps/project');
			exit;	
	    }
    }
    
    public function closeproject($id){
        if( $this->model('Mps_model')->closeMpsProject($id) > 0 ) {
			Flasher::setMessage('MPS Project closed','','success');
			header('location: '. BASEURL . '/mps/project');
			exit;			
		}else{
			Flasher::setMessage('No data updated','','danger');
			header('location: '. BASEURL . '/mps/project');
			exit;	
	    }
    }
    
    public function attachments($id, $project){
        $data = $this->model('Mps_model')->getMpsAttachments($id, $project);
		echo json_encode($data);
    }

    public function saveattachments(){
        if( $this->model('Mps_model')->savedocfile($_POST) > 0 ) {
			$return = array(
				"msgtype" => "1",
				"message" => "Document Berhasil di upload"
			);
			echo json_encode($return);
			exit;			
		}else{
			$return = array(
				"msgtype" => "2",
				"message" => "Document Gagal di upload"
			);
			echo json_encode($return);
			exit;	
		}
    }
}