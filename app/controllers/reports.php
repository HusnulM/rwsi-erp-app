<?php

class Reports extends Controller{

	public function __construct(){
		if( isset($_SESSION['usr_erp']) ){
			
		}else{
			header('location:'. BASEURL);
		}
    }

    public function reportpr(){
		$check = $this->model('Home_model')->checkUsermenu('reports/reportpr','Read');
        if ($check){
			$data['title']    = 'Report Purchase Request';
			$data['menu']     = 'Report Purchase Request';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$this->view('templates/header_a', $data);
			$this->view('reports/laporanpr', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }          
    }

    public function reportprview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('reports/reportpr','Read');
        if ($check){
			$data['title']    = 'Report Purchase Request';
			$data['menu']     = 'Report Purchase Request';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$data['strdate'] = $strdate;
			$data['enddate'] = $enddate;
	
			$data['prdata']  = $this->model('Laporan_model')->getPR($strdate, $enddate);
	
			$this->view('templates/header_a', $data);
			$this->view('reports/laporanprview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }          
	}
	
	public function laporanprdata($strdate, $enddate){
		$data = $this->model('Laporan_model')->getPR($strdate, $enddate);
		echo json_encode($data);
    }

    public function reportpo(){
		$check = $this->model('Home_model')->checkUsermenu('reports/reportpo','Read');
        if ($check){
			$data['title']    = 'Report Purchase Order';
			$data['menu']     = 'Report Purchase Order';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$this->view('templates/header_a', $data);
			$this->view('reports/laporanpo', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }          
    }

    public function reportpoview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('reports/reportpo','Read');
        if ($check){
			$data['title']    = 'Report Purchase Order';
			$data['menu']     = 'Report Purchase Order';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$data['strdate'] = $strdate;
			$data['enddate'] = $enddate;
	
			$this->view('templates/header_a', $data);
			$this->view('reports/laporanpoview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }          
	}
	
	public function laporanpodata($strdate, $enddate){
		$data = $this->model('Laporan_model')->getDataPO($strdate, $enddate);
		echo json_encode($data);
    }

    public function grpo(){
		$check = $this->model('Home_model')->checkUsermenu('reports/grpo','Read');
        if ($check){
			$data['title']    = 'Report Receipt PO';
			$data['menu']     = 'Report Receipt PO';
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$this->view('templates/header_a', $data);
			$this->view('reports/laporangr', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }  
	}
	
	public function grpoview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('reports/grpo','Read');
        if ($check){
			$data['title']    = 'Laporan Barang Masuk';
			$data['menu']     = 'Laporan Barang Masuk';
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$data['grdata']   = $this->model('Laporan_model')->getDataGR($strdate, $enddate);
	
			$data['strdate'] = $strdate;
			$data['enddate'] = $enddate;
	
			$this->view('templates/header_a', $data);
			$this->view('reports/laporangrview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }
	}
	
	public function laporangrdata($strdate, $enddate){
		$data = $this->model('Laporan_model')->getDataGR($strdate, $enddate);
		echo json_encode($data);
    }

    public function stock(){
		$check = $this->model('Home_model')->checkUsermenu('reports/stock','Read');
        if ($check){
			$data['title']    = 'Laporan Stok Barang';
			$data['menu']     = 'Laporan Stok Barang';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------  

			$data['whs'] = $this->model('Warehouse_model')->getWarehouseByAuth();   

			// $data['whsauth'] = $this->model('Laporan_model')->getWhsAuth();
			// echo json_encode($data['whsauth']);
			$this->view('templates/header_a', $data);
			$this->view('reports/rstock', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }        
	}
	
	public function allstockview(){
		$check = $this->model('Home_model')->checkUsermenu('reports/allstockview','Read');
        if ($check){
			$data['title']    = 'Laporan Stok Material';
			$data['menu']     = 'Laporan Stok Material';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------  
	
			// $data['stock'] = $this->model('Laporan_model')->getStock($material,$warehouse);   
			// echo json_encode($data['stock']);
			$this->view('templates/header_a', $data);
			$this->view('reports/rtotalstock', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }
	}

	public function materialstock(){
		$data['data'] = $this->model('Laporan_model')->getAllStock();
		echo json_encode($data);   
	}

	public function materialstockbykode($params){
		$url   = parse_url($_SERVER['REQUEST_URI']);
        $data  = parse_str($url['query'], $params);
		$matnr = $params['material'];

		$data = $this->model('Laporan_model')->breakdownstock($matnr);
		echo json_encode($data);   
	}

	public function stockview($material = null,$warehouse = null){
		$check = $this->model('Home_model')->checkUsermenu('reports/stock','Read');
        if ($check){
			$data['title']    = 'Laporan Stok Barang';
			$data['menu']     = 'Laporan Stok Barang';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------  
	
			$data['stock'] = $this->model('Laporan_model')->getStock($material,$warehouse);   
			$data['material']  = $material;
			$data['warehouse'] = $warehouse;
			
			// echo json_encode($data['stock']);
			$this->view('templates/header_a', $data);
			$this->view('reports/rstockview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }
	}
	
	public function movement(){
		$check = $this->model('Home_model')->checkUsermenu('reports/movement','Read');
        if ($check){
			$data['title']    = 'Inventory Movement';
			$data['menu']     = 'Inventory Movement';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$this->view('templates/header_a', $data);
			$this->view('reports/rmovement', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }        
	}
	
	public function movementview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('reports/movement','Read');
        if ($check){
			$data['title']    = 'Inventory Movement';
			$data['menu']     = 'Inventory Movement';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$data['mvdata']   = $this->model('Laporan_model')->getMovementData($strdate, $enddate);
			$data['strdate'] = $strdate;
			$data['enddate'] = $enddate;
	
			$this->view('templates/header_a', $data);
			$this->view('reports/rmovementview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }        
	}

	public function reservasi(){
		$check = $this->model('Home_model')->checkUsermenu('reports/reservasi','Read');
        if ($check){
			$data['title']    = 'Report Reservation';
			$data['menu']     = 'Report Reservation';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$this->view('templates/header_a', $data);
			$this->view('reports/rreservasi', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }     
	}
	
	public function reservasiview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('reports/reservasi','Read');
        if ($check){
			$data['title']    = 'Report Reservation';
			$data['menu']     = 'Report Reservation';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$data['mvdata']   = $this->model('Laporan_model')->getReservasiData($strdate, $enddate);
			$data['strdate'] = $strdate;
			$data['enddate'] = $enddate;

			$this->view('templates/header_a', $data);
			$this->view('reports/rreservasiview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }  
	}
	
	public function delivery(){
		$check = $this->model('Home_model')->checkUsermenu('reports/delivery','Read');
        if ($check){
			$data['title']    = 'Report Delivery';
			$data['menu']     = 'Report Delivery';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$this->view('templates/header_a', $data);
			$this->view('reports/rdelivery', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }          
    }
    
    public function wipstock(){
		$check = $this->model('Home_model')->checkUsermenu('reports/wipstock','Read');
        if ($check){
			$data['title']    = 'Report WIP Stock';
			$data['menu']     = 'Report WIP Stock';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
			
			$data['wip'] = $this->model('Wip_model')->reportSummaryWIP();
	
			$this->view('templates/header_a', $data);
			$this->view('reports/rwipstock', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        }          
    }
    
    public function wostracking(){
		$check = $this->model('Home_model')->checkUsermenu('reports/wostracking','Read');
        if ($check){
			$data['title']    = 'Report Wos Tracking';
			$data['menu']     = 'Report Wos Tracking';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$this->view('templates/header_a', $data);
			$this->view('reports/wostracking', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        } 
	}

	public function wostrackingview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('reports/wostracking','Read');
        if ($check){
			$data['title']    = 'Report Wos Tracking';
			$data['menu']     = 'Report Wos Tracking';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$data['strdate'] = $strdate;
			$data['enddate'] = $enddate;
			$data['wosdata'] = $this->model('Laporan_model')->getWosData($strdate, $enddate);
	
			$this->view('templates/header_a', $data);
			$this->view('reports/wostrackingview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        } 
	}

	public function getwostracking($wosid,$bomid){
		$data = $this->model('Laporan_model')->getWosTracking($wosid,$bomid);
		echo json_encode($data);
	}
	
	public function wostrackingmaterial(){
		$check = $this->model('Home_model')->checkUsermenu('reports/wostrackingmaterial','Read');
        if ($check){
			$data['title']    = 'Report Wos Tracking Material';
			$data['menu']     = 'Report Wos Tracking Material';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 
	
			$this->view('templates/header_a', $data);
			$this->view('reports/wostrackingmaterial', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        } 
	}

	public function wostrackingmaterialview($strdate, $enddate){
		$check = $this->model('Home_model')->checkUsermenu('reports/wostrackingmaterial','Read');
        if ($check){
			$data['title']    = 'Report Wos Tracking Material';
			$data['menu']     = 'Report Wos Tracking Material';
			
			// Wajib di semua route ke view--------------------------------------------
			$data['setting']  = $this->model('Setting_model')->getgensetting();    //--
			$data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//------------------------------------------------------------------------- 

			$data['strdate'] = $strdate;
			$data['enddate'] = $enddate;
			$data['wosdata'] = $this->model('Laporan_model')->getTrackingWosMaterial($strdate, $enddate);
	
			$this->view('templates/header_a', $data);
			$this->view('reports/wostrackingmaterialview', $data);
			$this->view('templates/footer_a');
		}else{
            $this->view('templates/401');
        } 
	}
	
	public function getwostrackingprocess($wosid,$bomid){
		$data['data'] = $this->model('Laporan_model')->getWosTracking($wosid,$bomid);
		echo json_encode($data);
	}
	
	public function trackingmaterialbyprocess($transid){
		$data = $this->model('Laporan_model')->getTrackingWosMaterialByProcess($transid);
		echo json_encode($data);
	}
	
	public function exportpo_excel($params){
	    
	    $url = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
		$ponum = $params['ponum'];
		
		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['header']   = $this->model('Po_model')->getPOHeader($ponum);
		$data['poitem']   = $this->model('Po_model')->getPOitemPrint($ponum);

		$excel = new PHPExcel();
		$excel->getProperties()->setCreator($_SESSION['usr_erp']['user'])
             ->setLastModifiedBy($_SESSION['usr_erp']['user'])
             ->setTitle("Purchase Requisition")
             ->setSubject("Purchase Requisition")
             ->setDescription("Purchase Requisition")
             ->setKeywords("Purchase Requisition");
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

		// Header		
		$excel->setActiveSheetIndex(0)->setCellValue('A1', $data['setting']['company']);
		$excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A2', "Purchase Order"); 
		$excel->getActiveSheet()->mergeCells('A2:G2'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

		$objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo ');
        $objDrawing->setDescription('Logo ');
        $objDrawing->setPath('./images/aws-logo.png');
        $objDrawing->setResizeProportional(true);
        $objDrawing->setWidth(100);
        $objDrawing->setCoordinates('G1');
        $objDrawing->setWorksheet($excel->getActiveSheet());

		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Purchase Order");
		$excel->setActiveSheetIndex(0)->setCellValue('C5', $data['header']['ponum'],PHPExcel_Cell_DataType::TYPE_STRING);
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "PO Note");
		$excel->setActiveSheetIndex(0)->setCellValue('G5', $data['header']['note']);

		$excel->setActiveSheetIndex(0)->setCellValue('B6', "Vendor");
		$excel->setActiveSheetIndex(0)->setCellValue('C6', $data['header']['namavendor']);
		$excel->setActiveSheetIndex(0)->setCellValue('F6', "PO Date");
		$excel->setActiveSheetIndex(0)->setCellValue('G6', $data['header']['podat']);

		$excel->setActiveSheetIndex(0)->setCellValue('B7', "Alamat Vendor");
		$excel->setActiveSheetIndex(0)->setCellValue('C7', $data['header']['alamat']);
		$excel->setActiveSheetIndex(0)->setCellValue('F7', "Created Date");
		$excel->setActiveSheetIndex(0)->setCellValue('G7', $data['header']['createdon']);

		$excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('F5')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('G5')->getFont()->setBold(TRUE);

		$excel->getActiveSheet()->getStyle('B6')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('C6')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('F6')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('G6')->getFont()->setBold(TRUE);

		$excel->getActiveSheet()->getStyle('B7')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('C7')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('F7')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('G7')->getFont()->setBold(TRUE);

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A9', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B9', "Material"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C9', "Description"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D9', "Quantity"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E9', "Unit"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F9', "Unit Price"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G9', "Amount"); 
		// $excel->setActiveSheetIndex(0)->setCellValue('H8', "Item Remark"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F9')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G9')->applyFromArray($style_col);
		// $excel->getActiveSheet()->getStyle('H8')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
		// Buat query untuk menampilkan semua data siswa
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 10; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data['poitem'] as $i => $h){ // Ambil semua data dari hasil eksekusi $sql
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $h['material']);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['partnumber']);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['quantity']);	
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['unit']);			
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, "Rp. ". number_format($h['price']));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "Rp. ". number_format($h['price']*$h['quantity']));
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(13); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(35); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom B

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Purchase Order");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="PO-'. $ponum . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	
	public function exportstock($material = null,$warehouse = null){

		$data['setting']  = $this->model('Setting_model')->getgensetting();
		$data['stock'] = $this->model('Laporan_model')->getStock($material,$warehouse);   

		$excel = new PHPExcel();
		$excel->getProperties()->setCreator($_SESSION['usr_erp']['user'])
             ->setLastModifiedBy($_SESSION['usr_erp']['user'])
             ->setTitle("Purchase Requisition")
             ->setSubject("Purchase Requisition")
             ->setDescription("Purchase Requisition")
             ->setKeywords("Purchase Requisition");
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
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "Description"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "Part Name"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Part Number"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Warehouse"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Quantity"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "Base UOM"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);

		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data['stock'] as $i => $h){ // Ambil semua data dari hasil eksekusi $sql
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $h['material']);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $h['matdesc']);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $h['partname']);	
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $h['partnumber']);			
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $h['warehouse']." - ".$h['deskripsi']);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $h['quantity']);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $h['matunit']);
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);			
			$excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			// $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
			
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
		header('Content-Disposition: attachment; filename="MaterialStock.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');

	}
}