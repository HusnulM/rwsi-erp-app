<?php

class Inspection extends Controller{
    public function __construct(){
		if( isset($_SESSION['usr_erp']) ){

		}else{
			header('location:'. BASEURL);
		}
	}

    public function index(){
		$check = $this->model('Home_model')->checkUsermenu('inspection','Read');
        if ($check){
			$data['title'] = 'Data Entry Inspection';
			$data['menu']  = 'Data Entry Inspection';
			
			// Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------   

			// $data['quotation']  = $this->model('Quotation_model')->listquotation();
			$data['meja']     = $this->model('Meja_model')->listnomeja();
			$data['userlist'] = $this->model('User_model')->userList();
			$data['activity'] = $this->model('Activity_model')->activityList();
			$data['defect']   = $this->model('Inspection_model')->jenisDefect();
			$data['section']  = $this->model('Inspection_model')->defectSection();
	
			$this->view('templates/header_a', $data);
			$this->view('inspection/create', $data);
			$this->view('templates/footer_a');
		}else{
			$this->view('templates/401');
		}
	}

	public function report(){
		$check = $this->model('Home_model')->checkUsermenu('inspection','Read');
        if ($check){
			$data['title'] = 'Laporan Inspection';
			$data['menu']  = 'Laporan Inspection';
			
			// Wajib di semua route ke view--------------------------------------------
            $data['setting']  = $this->model('Setting_model')->getgensetting();    //--
            $data['appmenu']  = $this->model('Home_model')->getUsermenu();         //--
			//-------------------------------------------------------------------------   

			// $data['meja']     = $this->model('Meja_model')->listnomeja();
			// $data['userlist'] = $this->model('User_model')->userList();
			// $data['activity'] = $this->model('Activity_model')->activityList();
			// $data['defect']   = $this->model('Inspection_model')->jenisDefect();
	
			$this->view('templates/header_a', $data);
			$this->view('inspection/report', $data);
			$this->view('templates/footer_a');
		}else{
			$this->view('templates/401');
		}
	}
	
	public function save(){
		if( $this->model('Inspection_model')->save($_POST) > 0 ) {
			Flasher::setMessage('Inspection','Created!','success');
			header('location: '. BASEURL . '/inspection');
			exit;			
		}else{
			Flasher::setMessage('Error','','success');
			header('location: '. BASEURL . '/inspection');
			exit;	
		}
	}
	
	public function defectprocess($idsection){
		$data = $this->model('Inspection_model')->defectProcess($idsection);
		echo json_encode($data);
	}

	public function defectlist($idsection){
		$data = $this->model('Inspection_model')->defectList($idsection);
		echo json_encode($data);
	}

	public function reportDefect($strdate, $enddate){
		$data = $this->model('Inspection_model')->reportDefect($strdate, $enddate);
		echo json_encode($data);
	}
	
	public function exportisnpection($strdate, $enddate){

		$arraydata = [];
		$data['defect'] = $this->model('Inspection_model')->reportDefect($strdate, $enddate);
		
		$data['header'] = [
// 			"isnpecdate"=> "Tanggal",
			"defect"=> "Defect",
			"jmlng"=> "Jumlah NG"
		];

		array_push($arraydata, $data['header']);

		for($i = 0; $i < sizeof($data['defect']); $i++){
			// $data['header']
			array_push($arraydata, $data['defect'][$i]);
		}

		// echo json_encode($arraydata);
		$objPHPExcel = new PHPExcel();
		$objWorksheet = $objPHPExcel->getActiveSheet();


		$objWorksheet->fromArray(
			$arraydata
			// array($data['defect']
			//   array('', 2010, 2011, 2012),
			//   array('Q1', 12, 15, 21),
			//   array('Q2', 56, 73, 86),
			//   array('Q3', 52, 61, 69),
			//   array('Q4', 30, 32, 0),
			// )
		);

		$dataSeriesLabels1 = array(
			new PHPExcel_Chart_DataSeriesValues(
				'String',
				'Worksheet!$A$2',
				NULL,
				1),
		);

		$xAxisTickValues1 = array(
			new PHPExcel_Chart_DataSeriesValues(
				'String',
				'Worksheet!$A$2:$A$'. sizeof($arraydata),
				NULL,
				50)
		);

		$dataSeriesValues1 = array(
			new PHPExcel_Chart_DataSeriesValues(
				'Number',
				'Worksheet!$B$2:$B$'. sizeof($arraydata),
				NULL,
				50),
		);

		$series1 = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART, // Tipe Chart
			NULL, // Grouping (Pie charts tidak ada grouping)
			range(0, count($dataSeriesValues1)-1), // Urutan Chart
			$dataSeriesLabels1, // Data Label
			$xAxisTickValues1,  // Data Sumbu X
			$dataSeriesValues1  // Nilai Data
		);

		// Pengaturan tampilan objek (layout) untuk diagram Pie.
		$layout1 = new PHPExcel_Chart_Layout();
		$layout1->setShowVal(false);
		$layout1->setShowPercent(false);
		
		// Masukkan seri data dalam area plot.
		// Area plot akan mengambil data layout dan di gabung dengan data seri
		// yang sebelumnya sudah di tentukan.
		$plotArea1 = new PHPExcel_Chart_PlotArea(
			$layout1,
			array($series1)
		);
		
		// Tentukan legend chart
		$legend1 = new PHPExcel_Chart_Legend(
			PHPExcel_Chart_Legend::POSITION_RIGHT,
			NULL,
			true
		);
		
		// Tentukan judul chart
		$title1 = new PHPExcel_Chart_Title('GRAFIK NG');
		
		// Pembuatan chart
		$chart1 = new PHPExcel_Chart(
			'nama-chartnya', // Nama chart
			$title1,    // Judul chart
			NULL,   // Legend chart
			$plotArea1, // Area plot
			true, // plotVisibleOnly
			0,    // displayBlanksAs
			NULL, // Label sumbu X
			NULL  // Label sumbu Y - Diagram pie tidak ada sumbu Y
		);
		
		// Set posisi titik kiri atas dan kanan bawah chart
		// Fungsinya untuk menentukan lokasi dibuatnya chart
		$chart1->setTopLeftPosition('F4');
		$chart1->setBottomRightPosition('M20');
		
		// Tambahkan chart ke dalam Worksheet
		$objWorksheet->addChart($chart1);

		// Tentukan index sheet aktif ke sheet paling awal
		// supaya ketika file di buka, maka sheet ini yang
		// akan di tampilkan pertama kali. (opsional)
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Bersihkan kode dari output buffer untuk menghindari
		// pesan error yang dapat mencegah proses download.
		ob_clean();
		
		// Redirect output to a client’s web browser (Excel2007)
		// Redirect hasil output ke web browser (Excel 2007)
		// Anda dapat mengubah nama file yang akan di download
		// pada bagian filename:
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan '.date('d/m/Y').'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
		exit;
	}
}