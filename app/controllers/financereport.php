<?php

class Financereport extends Controller{

	public function __construct(){
		if( isset($_SESSION['usr_erp']) ){
			
		}else{
			header('location:'. BASEURL);
		}
    }

    public function poamount(){
        $check = $this->model('Home_model')->checkUsermenu('financereport/poamount','Read');
        if ($check){
			$data['title']    = 'Report Amount PO';
			$data['menu']     = 'Report Amount PO';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$this->view('templates/header_a', $data);
			$this->view('financereport/amountpo', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }   
    }

    public function poamountview($strdate, $enddate){
        $check = $this->model('Home_model')->checkUsermenu('financereport/poamount','Read');
        if ($check){
			$data['title']    = 'Report Amount PO';
			$data['menu']     = 'Report Amount PO';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

            $data['podata']   = $this->model('Financereport_model')->amountpo($strdate, $enddate);
            $data['strdate']  = $strdate;
			$data['enddate']  = $enddate;

			$this->view('templates/header_a', $data);
			$this->view('financereport/amountpoview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }   
    }
    
    public function debtamount(){
        $check = $this->model('Home_model')->checkUsermenu('financereport/debtamount','Read');
        if ($check){
			$data['title']    = 'Report Debt Amount PO';
			$data['menu']     = 'Report Debt Amount PO';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$this->view('templates/header_a', $data);
			$this->view('financereport/debamount', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }   
    }

	public function debtamountview($strdate, $enddate){
        $check = $this->model('Home_model')->checkUsermenu('financereport/debtamount','Read');
        if ($check){
			$data['title']    = 'Report Debt Amount PO';
			$data['menu']     = 'Report Debt Amount PO';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

            $data['podata']   = $this->model('Financereport_model')->debtamountpo($strdate, $enddate);
			$data['kurs']     = $this->model('Barang_model')->getusdtoidr();
			
			$data['strdate']  = $strdate;
			$data['enddate']  = $enddate;

			$this->view('templates/header_a', $data);
			$this->view('financereport/debamountview', $data);
			$this->view('templates/footer_a');
			// echo json_encode($data['kurs']['kurs']);
		}else{
            $this->view('templates/401');
        }   
    }
    
    public function transferprod(){
        $check = $this->model('Home_model')->checkUsermenu('financereport/transferprod','Read');
        if ($check){
			$data['title']    = 'Report Transfer Stock ke Gudang Produksi';
			$data['menu']     = 'Report Transfer Stock ke Gudang Produksi';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$this->view('templates/header_a', $data);
			$this->view('financereport/transferprod', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }   
    }

	public function transferproduksiview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('financereport/transferprod','Read');
        if ($check){
			$data['title']    = 'Report Transfer Stock ke Gudang Produksi';
			$data['menu']     = 'Report Transfer Stock ke Gudang Produksi';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

            $data['podata']   = $this->model('Financereport_model')->inventory04($strdate, $enddate);
			$data['kurs']     = $this->model('Barang_model')->getusdtoidr();
			
			$data['strdate']  = $strdate;
			$data['enddate']  = $enddate;

			$this->view('templates/header_a', $data);
			$this->view('financereport/transferprodview', $data);
			$this->view('templates/footer_a');
			// echo json_encode($data['kurs']['kurs']);
		}else{
            $this->view('templates/401');
        }  
	}
	
	public function inventoryvalue(){
		$check = $this->model('Home_model')->checkUsermenu('financereport/inventoryvalue','Read');
        if ($check){
			$data['title']    = 'Report Inventory Value';
			$data['menu']     = 'Report Inventory Value';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

            $data['stock']   = $this->model('Financereport_model')->inventory01();
			$data['kurs']     = $this->model('Barang_model')->getusdtoidr();

			$this->view('templates/header_a', $data);
			$this->view('financereport/inventoryvalue', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }  
	}
	
	public function expinventoryvalue(){
		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['stock']   = $this->model('Financereport_model')->inventory01();
		$data['kurs']     = $this->model('Barang_model')->getusdtoidr();

		$excel = new PHPExcel();
		$excel->getProperties()->setCreator($_SESSION['usr_erp']['user'])
             ->setLastModifiedBy($_SESSION['usr_erp']['user'])
             ->setTitle("PO Amount")
             ->setSubject("PO Amount")
             ->setDescription("PO Amount")
             ->setKeywords("PO Amount");
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

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Material"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "Description"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "Part Name"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Part Number"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Warehouse"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Quantity"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "Unit"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "Unit Price"); 
		$excel->setActiveSheetIndex(0)->setCellValue('J1', "Total Amount"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data['stock'] as $i => $h){ // Ambil semua data dari hasil eksekusi $sql
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $h['material']);		
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['matdesc']);			
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['partname']);			
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['partnumber']);			
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $h['warehouse']);			
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $h['quantity']);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $h['matunit']);
			if($h['stdpriceusd'] > 0){
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, round($h['stdpriceusd']*$data['kurs']['kurs']),0);
				$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, round(($h['stdpriceusd']*$data['kurs']['kurs'])*$h['quantity']),0);
			}else{
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $h['stdprice']);
				$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $h['stdprice']*$h['quantity']);
			}
			
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);

			$excel->getActiveSheet()->getStyle('I'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Inventory Value");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Inventory-Value.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
    
    public function poamountexport($strdate, $enddate){

		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['podata']   = $this->model('Financereport_model')->amountpo($strdate, $enddate);

		$excel = new PHPExcel();
		$excel->getProperties()->setCreator($_SESSION['usr_erp']['user'])
             ->setLastModifiedBy($_SESSION['usr_erp']['user'])
             ->setTitle("PO Amount")
             ->setSubject("PO Amount")
             ->setDescription("PO Amount")
             ->setKeywords("PO Amount");
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

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Vendor"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "PO No."); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "PO Date"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Create Date"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Material"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Description"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "Quantity"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "Unit"); 
		$excel->setActiveSheetIndex(0)->setCellValue('J1', "Unit Price"); 
		$excel->setActiveSheetIndex(0)->setCellValue('K1', "PPN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L1', "Amount"); 
		// $excel->setActiveSheetIndex(0)->setCellValue('H8', "Item Remark"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data['podata'] as $i => $h){ // Ambil semua data dari hasil eksekusi $sql
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $h['namavendor']);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['ponum']);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['podat']);	
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['createdon']);			
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $h['material']);			
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $h['matdesc']);			
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $h['quantity']);			
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $h['unit']);			
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $h['price']);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, number_format($h['ppn'],0)."%");
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $h['amount']+($h['amount']*($h['ppn']/100)));
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Purchase Order");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="PO-Amount-Report.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function debtamountexport($strdate, $enddate){

		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['podata']   = $this->model('Financereport_model')->debtamountpo($strdate, $enddate);
		$data['kurs']     = $this->model('Barang_model')->getusdtoidr();

		$excel = new PHPExcel();
		$excel->getProperties()->setCreator($_SESSION['usr_erp']['user'])
             ->setLastModifiedBy($_SESSION['usr_erp']['user'])
             ->setTitle("PO Amount")
             ->setSubject("PO Amount")
             ->setDescription("PO Amount")
             ->setKeywords("PO Amount");
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

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "PO No"); // Set kolom B3 dengan tulisan "NIS"
		// $excel->setActiveSheetIndex(0)->setCellValue('C1', "Item"); // Set kolom C3 dengan tulisan "NAMA"
		// $excel->setActiveSheetIndex(0)->setCellValue('D1', "Movement Type"); 
		// $excel->setActiveSheetIndex(0)->setCellValue('E1', "Movement Date"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "Vendor"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "Material"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Description"); 
// 		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Note"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Quantity"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Unit"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "Unit Price"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "Total Amount"); 
		// $excel->setActiveSheetIndex(0)->setCellValue('N1', "Reference"); 
		// $excel->setActiveSheetIndex(0)->setCellValue('O1', "Warehouse"); 
		// $excel->setActiveSheetIndex(0)->setCellValue('H8', "Item Remark"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
// 		$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data['podata'] as $i => $h){ // Ambil semua data dari hasil eksekusi $sql
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $h['reference']);
			// $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['gritem']);
			// $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['movement']);	
			// $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['movementdate']);			
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['namavendor']);			
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['material']);			
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['matdesc']);			
// 			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['note']);			
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $h['quantity']);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $h['unit']);
			if($h['stdpriceusd'] > 0){
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, round($h['stdpriceusd']*$data['kurs']['kurs']),0);
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, round(($h['stdpriceusd']*$data['kurs']['kurs'])*$h['quantity']),0);
			}else{
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $h['stdprice']);
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $h['stdprice']*$h['quantity']);
			}
			// $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $h['reference']);
			// $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $h['warehouse']. " - " . $h['whsname']);
			
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
// 			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);

			$excel->getActiveSheet()->getStyle('H'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Purchase Order");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="PO-Debt-Amount-Report.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function transferprodtexport($strdate, $enddate){

		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['podata']   = $this->model('Financereport_model')->inventory04($strdate, $enddate);
		$data['kurs']     = $this->model('Barang_model')->getusdtoidr();

		$excel = new PHPExcel();
		$excel->getProperties()->setCreator($_SESSION['usr']['user'])
             ->setLastModifiedBy($_SESSION['usr']['user'])
             ->setTitle("PO Amount")
             ->setSubject("PO Amount")
             ->setDescription("PO Amount")
             ->setKeywords("PO Amount");
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

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Movement Date"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "Material"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "Description"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Quantity"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Unit"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Unit Price"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "Total Amount"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "From Warehouse"); 
		$excel->setActiveSheetIndex(0)->setCellValue('J1', "Warehouse Dest"); 
		// $excel->setActiveSheetIndex(0)->setCellValue('H8', "Item Remark"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data['podata'] as $i => $h){ // Ambil semua data dari hasil eksekusi $sql
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $h['movementdate']);					
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['material']);			
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['matdesc']);						
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['quantity']);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $h['unit']);
			if($h['stdpriceusd'] > 0){
				$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, round($h['stdpriceusd']*$data['kurs']['kurs']),0);
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, round(($h['stdpriceusd']*$data['kurs']['kurs'])*$h['quantity']),0);
			}else{
				$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $h['stdprice']);
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $h['stdprice']*$h['quantity']);
			}
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $h['warehouse']. " - " . $h['whsfrom']);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $h['warehouseto']. " - " . $h['whsdest']);
			
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
			// $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);

			$excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Purchase Order");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Transferprod-Report.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}