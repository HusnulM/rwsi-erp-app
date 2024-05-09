<?php

class Material extends Controller {
    
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){

		}else{
			header('location:'. BASEURL);
		}
    }
    
    public function listmaterial(){
		$data = $this->model('Datatable_model')->listMaterial();
		echo $data;
	}
    
//     public function listmaterial(){
//         //$this->model('Material_model')->getListMaterial();
// 		$data['data'] = $this->model('Material_model')->getListBarang();
//  		echo json_encode($data);
// 	}
    
    public function getbylabel($qrlabel){
        $data = $this->model('Material_model')->getbylabel($qrlabel);
        echo json_encode($data);
    }
    
    public function getdetailbylabel($params){
        $url   = parse_url($_SERVER['REQUEST_URI']);
        $data  = parse_str($url['query'], $params);
        $label = $params['label'];
        // v_label_gr_details
        $data = $this->model('Material_model')->getDetailLabel($label);
        echo json_encode($data);
    }

    public function trackinglabel(){
        $check = $this->model('Home_model')->checkUsermenu('material/trackinglabel','Read');
        if ($check){
            $data['title'] = 'Tracking Label Material';
            $data['menu']  = 'Tracking Label Material';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();    

            $this->view('templates/header_a', $data);
            $this->view('material/trackinglable', $data);
            $this->view('templates/footer_a');
        }else{
            // echo json_encode("no authorization!");
            $this->view('templates/401');
        } 
    }
    
    public function label(){
        $check = $this->model('Home_model')->checkUsermenu('material','Update');
        if ($check){
            $data['title'] = 'Create Label Material';
            $data['menu']  = 'Create Label Material';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();    

            $this->view('templates/header_a', $data);
            $this->view('material/label', $data);
            $this->view('templates/footer_a');
        }else{
            // echo json_encode("no authorization!");
            $this->view('templates/401');
        }     
    }

    public function savelabel(){
        $checklabel = $this->model('Material_model')->checklabel($_POST['qrcode']);
        if($checklabel['rows'] > 0){
            $return = array(
                "msgtype" => "2",
                "message" => "QR Label Already Exists"
            );
            echo json_encode($return);
            exit;	
        }else{
            if( $this->model('Material_model')->savelabel($_POST) > 0 ) {
                $return = array(
                    "msgtype" => "1",
                    "message" => "Label Material created"
                );
                echo json_encode($return);
                exit;				
            }else{
                $return = array(
                    "msgtype" => "2",
                    "message" => "Check Your Input"
                );
                echo json_encode($return);
                exit;	
            }
        }
    }
    
    public function closegr($grnum,$gryear,$gritem){
        if( $this->model('Material_model')->closegr($grnum,$gryear,$gritem) > 0 ) {
            $return = array(
                "msgtype" => "1",
                "message" => "Material Closed"
            );
            echo json_encode($return);
            exit;				
        }else{
            $return = array(
                "msgtype" => "2",
                "message" => "Error"
            );
            echo json_encode($return);
            exit;	
        }
    }

    public function index(){
        $check = $this->model('Home_model')->checkUsermenu('material','Read');
        if ($check){
            $data['title'] = 'Master Material';
            $data['menu']  = 'Master Material';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         

            $data['material'] = $this->model('Barang_model')->getListBarang(); 
            $data['kurs']     = $this->model('Barang_model')->getusdtoidr();
            $data['kurs2']    = $this->model('Barang_model')->getjpytoidr();

            $data['showprice'] = $this->model('Barang_model')->checkauthdisplayprice();

            $this->view('templates/header_a', $data);
            $this->view('material/index', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function create(){
        $check = $this->model('Home_model')->checkUsermenu('material','Create');
        if ($check){
            $data['title'] = 'Tambah Master Material';
            $data['menu']  = 'Tambah Master Material';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();  
            $data['showprice'] = $this->model('Barang_model')->checkauthdisplayprice();

            $this->view('templates/header_a', $data);
            $this->view('material/create', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }         
    }

    public function edit($params){
        $url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
        $material = $params['material'];
        
        $check = $this->model('Home_model')->checkUsermenu('material','Update');
        if ($check){
            $data['title'] = 'Edit Master Material';
            $data['menu']  = 'Edit Master Material';

            // Wajib di semua route ke view
            $data['setting']  = $this->model('Setting_model')->getgensetting();
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         

            $data['material'] = $this->model('Barang_model')->getBarangByKode($material);
            $data['altuom']   = $this->model('Barang_model')->getBarangBaseUomByKode($material, $data['material']['matunit']);
            $data['showprice'] = $this->model('Barang_model')->checkauthdisplayprice();

            $this->view('templates/header_a', $data);
            $this->view('material/edit', $data);
            $this->view('templates/footer_a');
        }else{
            // echo json_encode("no authorization!");
            $this->view('templates/401');
        }         
    }

    public function save(){
        // echo json_encode($_POST);
        if( $this->model('Barang_model')->save($_POST) > 0 ) {
			Flasher::setMessage('Material Berhasil disimpan','','success');
			header('location: '. BASEURL . '/material');
			exit;			
		}else{
			Flasher::setMessage('Gagal menyimpan data material,','','danger');
			header('location: '. BASEURL . '/material');
			exit;	
		}
    }
    
    public function update(){
        if( $this->model('Barang_model')->update($_POST) > 0 ) {
			Flasher::setMessage('Material Berhasil di update','','success');
			header('location: '. BASEURL . '/material');
			exit;			
		}else{
			Flasher::setMessage('Gagal menyimpan data material,','','danger');
			header('location: '. BASEURL . '/material');
			exit;	
		}
        // $exec = $this->model('Barang_model')->update($_POST);
        // echo json_encode($exec);
	}

    public function delete($params){
        
        $url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
        $material = $params['material'];
        
        $check = $this->model('Home_model')->checkUsermenu('material','Delete');
        if ($check){
            if( $this->model('Barang_model')->delete($material) > 0 ) {
                Flasher::setMessage('Material Berhasil di hapus','','success');
                header('location: '. BASEURL . '/material');
                exit;			
            }else{
                Flasher::setMessage('Gagal menyimpan data material,','','danger');
                header('location: '. BASEURL . '/material');
                exit;	
            }
        }else{
            // echo json_encode("no authorization!");
            $this->view('templates/401');
        }         
    }
    
    public function updatekursusdidr($newvalue){
        // echo json_encode($_POST);
        if( $this->model('Barang_model')->updatekursusdidr($newvalue) > 0 ) {
			echo json_encode("OK");
			exit;			
		}else{
			echo json_encode("OK");
			exit;	
		}
    }

    public function updatekursjpyidr($newvalue){
        // echo json_encode($_POST);
        if( $this->model('Barang_model')->updatekursjpyidr($newvalue) > 0 ) {
			echo json_encode("OK");
			exit;			
		}else{
			echo json_encode("OK");
			exit;	
		}
    }
}