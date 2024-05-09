<?php

class Materialequivalent extends Controller {

    public function index(){
        $check = $this->model('Home_model')->checkUsermenu('materialequivalent','Read');
        if ($check){
            $data['title'] = 'Part Number Equivalent';
            $data['menu']  = 'Part Number Equivalent';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();    
            $matequiNumber = 'AWSI - ';
            $count = $this->model('Materialequivalent_model')->countMaterial();
            $count['total'] = $count['total'] + 1;
            $strlen = strlen($count['total']);
            if($strlen == 1){
                $matequiNumber = $matequiNumber.'00000'.$count['total'];
            }elseif($strlen == 2){
                $matequiNumber = $matequiNumber.'0000'.$count['total'];
            }elseif($strlen == 3){
                $matequiNumber = $matequiNumber.'000'.$count['total'];
            }elseif($strlen == 4){
                $matequiNumber = $matequiNumber.'00'.$count['total'];
            }elseif($strlen == 5){
                $matequiNumber = $matequiNumber.'0'.$count['total'];
            }else{
                $matequiNumber = $matequiNumber.$count['total'];
            }

            $data['matnumber'] = $matequiNumber;

            // echo json_encode($data['showprice']);
            $this->view('templates/header_a', $data);
            $this->view('material/materialequivalent', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function report(){
        $check = $this->model('Home_model')->checkUsermenu('materialequivalent','Read');
        if ($check){
            $data['title'] = 'Part Number Equivalent';
            $data['menu']  = 'Part Number Equivalent';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();        
            
            $data['material'] = $this->model('Materialequivalent_model')->getmaterialEqAll();

            // echo json_encode($data['showprice']);
            $this->view('templates/header_a', $data);
            $this->view('material/materialequivalentreport', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function edit($params){
        $url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$material = $params['material'];
        // echo json_encode($material);
        $check = $this->model('Home_model')->checkUsermenu('materialequivalent','Read');
        if ($check){
            $data['title'] = 'Part Number Equivalent';
            $data['menu']  = 'Part Number Equivalent';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();        
            
            $data['mat'] = $this->model('Materialequivalent_model')->getmaterialEqByPart($material);
            // echo json_encode($data['material']);
            // echo json_encode($data['showprice']);
            $this->view('templates/header_a', $data);
            $this->view('material/editmaterialequivalent', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    
    public function save(){
        if( $this->model('Materialequivalent_model')->save($_POST) > 0 ) {
			Flasher::setMessage('Part Equivalent Berhasil di simpan','','success');
			header('location: '. BASEURL . '/materialequivalent');
			exit;			
		}else{
			Flasher::setMessage('Error','','danger');
			header('location: '. BASEURL . '/materialequivalent');
			exit;	
		}
    }

}