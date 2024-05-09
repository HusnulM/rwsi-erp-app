<?php

class Mpp extends Controller {
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){

		}else{
			header('location:'. BASEURL);
		}
    }

    public function index(){
        $check = $this->model('Home_model')->checkUsermenu('mpp','Read');
        if ($check){
            $data['title'] = 'Input Monthly Production Planning';
            $data['menu']  = 'Input Monthly Production Planning';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------    

            $this->view('templates/header_a', $data);
            $this->view('mpp/index', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }  
    }

    public function request(){
        $check = $this->model('Home_model')->checkUsermenu('mpp/request','Read');
        if ($check){
            $data['title'] = 'Request Part By Monthly Production Planning';
            $data['menu']  = 'Request Part By Monthly Production Planning';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------    

            $data['mppdata'] = $this->model('Mpp_model')->getMPPSummaryData();

            $this->view('templates/header_a', $data);
            $this->view('mpp/request', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }  
    }

    public function detail($bomid, $period){
        $check = $this->model('Home_model')->checkUsermenu('mpp/request','Read');
        if ($check){
            $data['title'] = 'Request Part By Monthly Production Planning';
            $data['menu']  = 'Request Part By Monthly Production Planning';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------    

            $data['mppheader'] = $this->model('Mpp_model')->getMPPHeader($bomid, $period);
            $data['mppitems']  = $this->model('Mpp_model')->getMPPItems($bomid, $period);
            $data['whs'] = $this->model('Warehouse_model')->getWarehouseByAuth();
            $data['bomid']  = $bomid;
            $data['period'] = $period;

            $this->view('templates/header_a', $data);
            $this->view('mpp/mppdetails', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }  
    }
    
    public function report($bomid = null, $period = null){
        $check = $this->model('Home_model')->checkUsermenu('mpp/report','Read');
        if ($check){
            $data['title'] = 'Report Summary MPP Request';
            $data['menu']  = 'Report Summary MPP Request';

            // Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
            //-------------------------------------------------------------------------    

            
            $data['bomid']  = $bomid;
            $data['period'] = $period;

            $this->view('templates/header_a', $data);
            $this->view('mpp/rsummary', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }  
    }

    public function save(){
        // echo json_encode($_POST);
        if( $this->model('Mpp_model')->save($_POST) > 0 ) {
			Flasher::setMessage('Monthly Production Planning Created','','success');
			header('location: '. BASEURL . '/mpp');
			exit;			
		}else{
			Flasher::setMessage('Failed,','','danger');
			header('location: '. BASEURL . '/mpp');
			exit;	
	    }
    }

    public function createReservation(){
        $nextNumb = $this->model('Home_model')->getNextNumber('RSRV');
		if( $this->model('Mpp_model')->saveReservation($_POST, $nextNumb['nextnumb']) > 0 ) {
			$result = ["msg"=>"success", "docnum"=>$nextNumb];
			echo json_encode($result);
			exit;			
		}else{
			$result = ["msg"=> Flasher::errorMessage()];
            echo json_encode($result);
            $this->model('Reservation_model')->delete($nextNumb['nextnumb']);
			exit;	
		}
    }

    // public function calculatePartReqeuest($bomid,$qty){
    //     $data     = $this->model('Bom_model')->bomcalculation($bomid,$qty);
    //     echo json_encode($data);
    // }
    
    // public function summarydata(){
    //     $data['data'] = $this->model('Mpp_model')->getMPPSummaryData();
    //     echo json_encode($data);
    // }

    // public function calculatePartReqeuest($bomid,$qty,$period){
    //     $data = $this->model('Mpp_model')->materialcalculation($bomid,$qty,$period);
    //     echo json_encode($data);
    // }
    
    public function summarydata($period){
        $data['data'] = $this->model('Mpp_model')->getMPPRerportSummaryData($period);
        echo json_encode($data);
    }

    public function calculatePartReqeuest($bomid,$qty,$period){
        $data = $this->model('Mpp_model')->materialcalculation($bomid,$qty,$period);
        echo json_encode($data);
    }

    public function exportMpp($bomid,$period,$qty){
        $data['header'] = $this->model('Mpp_model')->getMPPHeader($bomid,$period);
        $data['item']   = $this->model('Mpp_model')->materialcalculation($bomid,$qty,$period);

        $excel = new PHPExcel();
		$excel->getProperties()->setCreator($_SESSION['usr']['user'])
             ->setLastModifiedBy($_SESSION['usr']['user'])
             ->setTitle("MPP Request")
             ->setSubject("MPP Request")
             ->setDescription("MPP Request")
             ->setKeywords("MPP Request");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$style_aligment_left = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			)
		);
		
		// $excel->setActiveSheetIndex(0)->setCellValue('A1', $data['setting']['company']);
		// $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
		// $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		// $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		// $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A2', "MPP Request Detail"); 
		$excel->getActiveSheet()->mergeCells('A2:G2'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "PART NUMBER");
		$excel->setActiveSheetIndex(0)->setCellValue('B4', $data['header']['partnumber']);
		$excel->setActiveSheetIndex(0)->setCellValue('D4', "PERIODE");
		$excel->setActiveSheetIndex(0)->setCellValue('E4', $data['header']['periodname'],PHPExcel_Cell_DataType::TYPE_STRING);

		$excel->setActiveSheetIndex(0)->setCellValue('A5', "CUSTOMER");
		$excel->setActiveSheetIndex(0)->setCellValue('B5', $data['header']['customer']);
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "QUANTITY");
		$excel->setActiveSheetIndex(0)->setCellValue('E5', $data['header']['totalqty'],PHPExcel_Cell_DataType::TYPE_STRING);


		$excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(TRUE);
		
		$excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('D5')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('E5')->getFont()->setBold(TRUE);

		$excel->getActiveSheet()->getStyle('A6')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('B6')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('D6')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('E6')->getFont()->setBold(TRUE);

		// $excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE);
		// $excel->getActiveSheet()->getStyle('B7')->getFont()->setBold(TRUE);
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A9', "NO"); // 
		$excel->setActiveSheetIndex(0)->setCellValue('B9', "Material"); // 
		$excel->setActiveSheetIndex(0)->setCellValue('C9', "Description"); // 
		$excel->setActiveSheetIndex(0)->setCellValue('D9', "Requirement Quantity"); // 
		$excel->setActiveSheetIndex(0)->setCellValue('E9', "Requested Quantity"); // 
		$excel->setActiveSheetIndex(0)->setCellValue('F9', "Open Quantity"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G9', "Unit"); 
		
		$excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G9')->applyFromArray($style_col);
		// Set height baris ke 1, 2 dan 3
// 		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
// 		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
// 		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
		// Buat query untuk menampilkan semua data siswa
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 10; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data['item'] as $i => $h){ // Ambil semua data dari hasil eksekusi $sql
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $h['component'],PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['matdesc'],PHPExcel_Cell_DataType::TYPE_STRING);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['Total']);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['qtyreq']);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $h['Total']-$h['qtyreq']);
			// Khusus untuk no telepon. kita set type kolom nya jadi STRING
			$excel->setActiveSheetIndex(0)->setCellValueExplicit('G'.$numrow, $h['unit'], PHPExcel_Cell_DataType::TYPE_STRING);
			
			// $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $h['jumlah']);
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			
			// $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
// 		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
// 		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(50); // Set width kolom B
// 		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
// 		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
// 		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(55); // Set width kolom E
// 		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
		// Set orientasi kertas jadi LANDSCAPE
		
		$namafile = 'mpp-request-'.$data['header']['partnumber'] . '-' . $data['header']['periodname'];
		
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("MPP Request Detail");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. $namafile .'".xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');

        
    }
}