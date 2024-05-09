<?php  
     
     /**
      * @author Achmad Solichin
      * @website http://achmatim.net
      * @email achmatim@gmail.com
      */
     require_once("fpdf17/fpdf.php");
      
     class FPDF_AutoWrapTable extends FPDF {
           private $pdata = array();
           private $hdata = array();
           private $options = array(
               'filename' => '',
               'destinationfile' => '',
               'paper_size'=>'F4',
               'orientation'=>'P'
           );
      
           function __construct($pdata = array(), $options = array(), $hdata = array()) {
             parent::__construct();
             $this->data    = $pdata;
             $this->options = $options;
             $this->hdata   = $hdata;
         }
      
         public function rptDetailData () {
             //
             $border = 0;
             $this->AddPage();
             $this->SetAutoPageBreak(true,60);
             $this->AliasNbPages();
             $left = 10;
      
             //header AWSI-F-PUR-01-04
             $this->Cell(5,4,'',0,1);
             $this->SetFont("Arial", "", 8);
             $this->SetX($left); $this->Cell(0, 5, 'AWSI-F-PUR-01-04', 0, 1,'R');
             $this->Ln(20);
            $this->Cell(10,7,'',0,1);
            $this->SetFont("Arial", "B", 16);
            $this->SetX($left); $this->Cell(0, 10, 'PURCHASE ORDER', 0, 1,'C');
            $this->Image('aws-logo.png',480,50,90,80);

            // $this->SetFont("Arial", "B", 16);
            // $this->SetX($left); $this->Cell(0, 10, 'PURCHASE ORDER', 0, 1,'C');
            $this->Ln(60);
            $this->SetFont('Arial','B',10);
            $this->Cell(10,7,'',0,1);    
            $this->Cell(100,5,'PO Date',0);
            $this->Cell(5,5,':',0);
            $this->Cell(200,5, $this->hdata['podat'],0);

            $this->Cell(100,5,'Purchase Order',0);
            $this->Cell(5,5,':',0);
            $this->Cell(72,5,$this->hdata['ext_ponum'],0);
            
            $this->Ln(10);
            $this->Cell(10,7,'',0,1);
            $this->Cell(100,5,'Note',0);
            $this->Cell(5,5,':',0);
            $this->Cell(200,5,$this->hdata['note'],0);

            $this->Cell(100,5,'Created By',0);
            $this->Cell(5,5,':',0);
            $this->Cell(100,5,$this->hdata['createdby'],0,1);

            $this->Ln(5);
            $this->Cell(10,7,'',0,1);
            $this->Cell(100,5,'Vendor',0);
            $this->Cell(5,5,':',0);
            $this->Cell(200,5,$this->hdata['namavendor'],0);

            $this->Cell(100,7,'NPWP NO',0);
            $this->Cell(5,5,':',0);
            $this->Cell(100,5,'94.981.043.6-409.000',0,1);

            $this->Ln(5);
            $this->Cell(10,7,'',0,1);
            $this->Cell(100,15,'Vendor Address',0);
            $this->Cell(5,15,':',0);
            $this->SetX($left += 125);
            $this->MultiCell(200,15,$this->hdata['alamat'],0);
            // $this->Cell(40,15,'','B',1,'L');

            
            
            $this->Ln(10);
             $h = 20;
             $left = 10;
             $top = 80;
             #tableheader
             $this->SetFillColor(200,200,200);
             $left = $this->GetX();
             $this->SetFont('Arial','B',9);
             $this->Cell(25,$h,'No',1,0,'L',true);
            //  $this->SetX($left += 25); $this->Cell(52, $h, 'No.', 1, 0, 'C',true);
             $this->SetX($left += 25); $this->Cell(100, $h, 'Material', 1, 0, 'C',true);
             $this->SetX($left += 100); $this->Cell(200, $h, 'Description', 1, 0, 'C',true);
             $this->SetX($left += 200); $this->Cell(60, $h, 'Quantity', 1, 0, 'C',true);
             $this->SetX($left += 60); $this->Cell(35, $h, 'Unit', 1, 0, 'C',true);
             $this->SetX($left += 35); $this->Cell(50, $h, 'Unit Price', 1, 0, 'C',true);
             $this->SetX($left += 50); $this->Cell(70, $h, 'Sub Total', 1, 1, 'C',true);
             //$this->Ln(20);
             $totalharga = 0;
             $discount   = 0;
             $tax        = 0;
             $taxvalue   = 0;
             $totaltax   = 0;

             $this->SetFont('Arial','',8);
             $this->SetWidths(array(25,100,200,60,35,50,70,50,25,60,90));
             $this->SetAligns(array('C','L','L','R','L','R','R','R','R','R','R'));
             $no = 1; $this->SetFillColor(255);
             foreach ($this->data as $baris) {
                $qty = 0;
                if (strpos($baris['quantity'], '.00') !== false){
                    $qty = number_format($baris['quantity'],0,",",".");
                }else{
                    $qty = number_format($baris['quantity'],2,",",".");
                }
                 $this->Row(
                     array($no++,
                    //  $baris['ponum'],
                     $baris['material'],
                     $baris['partnumber'],
                     $qty,
                     $baris['unit'],
                     number_format($baris['price'],0,",","."),
                     number_format(($baris['price'] * $baris['quantity']),0,",","."),
                     
                 ));

                 $totalharga = $totalharga + ($baris['price']*$baris['quantity']);
             }
            $ppn = 0;
            $ppn = $totalharga*($this->hdata['ppn']/100);

            $this->SetFont('Arial','B',8);
            $this->Cell(440,15,'JUMLAH','L',0,'R');
            $this->Cell(30,15,'Rp.','',0,'R');
            $this->Cell(70,15,number_format($totalharga,0,",","."),'R',1,'R');
            $this->Cell(440,15,'PPN','L',0,'R');
            $this->Cell(30,15,'Rp.','',0,'R');
            $this->Cell(70,15,number_format($ppn,0,",","."),'R',1,'R');
            $this->Cell(440,15,'TOTAL','L,B',0,'R');
            $this->Cell(30,15,'Rp.','B',0,'R');
            $this->Cell(70,15,number_format($totalharga+$ppn,0,",","."),'R,B',1,'R');

            $check = "";
            $checkbox_size = 5; 
            $ori_font_family = 'Arial'; 
            $ori_font_size = '10'; 
            $ori_font_style = '';

            // Note
            $this->Cell(540,15,'NOTE: ABOVE PURCHASED PRODUCT (S) REQUIRE (S) FOLLOWING DOCUMENTS :','L,R',1,'C');
            $this->SetFont('ZapfDingbats','', 8);
            $this->Cell(15,15, chr(111), 'L', 0, 'R');
            $this->SetFont('Arial','B',8);
            $this->Cell(60,15, "TEST REPORT", '', 0, 'R');
            $this->SetFont('ZapfDingbats','', 8);
            $this->Cell(200,15, chr(111), '', 0, 'R');
            $this->SetFont('Arial','B',8);
            $this->Cell(265,15, "ENVIRONMENTAL CERTIFICATE", 'R', 1, 'L');
            
            $this->SetFont('ZapfDingbats','', 8);
            $this->Cell(15,15, chr(111), 'L', 0, 'R');
            $this->SetFont('Arial','B',8);
            $this->Cell(60,15, "MATERIAL SAFETY DATA SHEET (MSDS)", '', 0, 'L');
            $this->SetFont('ZapfDingbats','', 8);
            $this->Cell(200,15, chr(111), '', 0, 'R');
            $this->SetFont('Arial','B',8);
            $this->Cell(265,15, "QUALITY SYSTEM MANAGEMENT CERTIFICATE", 'R', 1, 'L');
            
            
            $this->SetFont('ZapfDingbats','', 8);
            $this->Cell(15,15, chr(111), 'L,B', 0, 'R');
            $this->SetFont('Arial','B',8);
            $this->Cell(60,15, "PRODUCT CERTIFICATE OF COMPLIANCE", 'B', 0, 'L');
            $this->SetFont('ZapfDingbats','', 8);
            $this->Cell(200,15, chr(111), 'B', 0, 'R');
            $this->SetFont('Arial','B',8);
            $this->Cell(265,15, "RoHS", 'B,R', 1, 'L');
            
            $this->Ln(5);
            $this->SetFont('Arial','B',10);
            $this->Cell(5,15,'','',0,'L');
            $this->Cell(15,15,'PRICE','',0,'L');
            $this->Cell(90,15,':','',0,'R');
            $this->Cell(150,15,$this->hdata['tf_price'],'',1,'L');

            $this->Cell(5,15,'','',0,'L');
            $this->Cell(15,15,'DESTINATION','',0,'L');
            $this->Cell(90,15,':','',0,'R');
            $this->Cell(150,15,$this->hdata['tf_dest'],'',1,'L');

            $this->Cell(5,15,'','',0,'L');
            $this->Cell(15,15,'SHIPMENT','',0,'L');
            $this->Cell(90,15,':','',0,'R');
            $this->Cell(150,15,$this->hdata['tf_shipment']. ", " . $this->hdata['tf_shipdate'],'',1,'L');

            $this->Cell(5,15,'','',0,'L');
            $this->Cell(15,15,'PAYMENT','',0,'L');
            $this->Cell(90,15,':','',0,'R');
            $this->Cell(150,15,$this->hdata['tf_top'],'',1,'L');

            $this->Cell(5,15,'','',0,'L');
            $this->Cell(15,15,'PACKING','',0,'L');
            $this->Cell(90,15,':','',0,'R');
            $this->Cell(120,15,$this->hdata['tf_packing'],'',1,'L');
            $this->SetFont('Arial','B',8);
            $this->Cell(5,15,'','',0,'L');
            $this->Cell(15,15,'','',0,'L');
            $this->Cell(90,15,'','',0,'R');
            $this->Cell(200,15,'','',0,'L');
            $this->Cell(120,15,'APPROVED BY,','',1,'C');

            $this->Ln(80);
            $this->Cell(270,15,'','',0,'C');
            $this->SetLineWidth(2);  
            $this->Cell(80,15,'DIRECTOR','T',0,'C');
            $this->Cell(70,15,'','',0,'C');
            $this->Cell(120,15,'PURCHASING MANAGER','T',1,'C');
            // $this->Cell(270,15,'Menyetujui',1,1,'C');
            // $this->Cell(270,50,'',1,0,'C');
            // $this->Cell(270,50,'',1,1,'C');
         }
      
         public function printPDF () {
      
             if ($this->options['paper_size'] == "F4") {
                 $a = 8.3 * 72; //1 inch = 72 pt
                 $b = 13.0 * 72;
                 $this->FPDF('P', "pt", array($a,$b));
             } else {
                 $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
             }
      
             $this->SetAutoPageBreak(false);
             $this->AliasNbPages();
             $this->SetFont("helvetica", "B", 10);
             //$this->AddPage();
      
             $this->rptDetailData();
      
             $this->Output($this->options['filename'],$this->options['destinationfile']);
           }
      
           private $widths;
         private $aligns;
      
         function SetWidths($w)
         {
             //Set the array of column widths
             $this->widths=$w;
         }
      
         function SetAligns($a)
         {
             //Set the array of column alignments
             $this->aligns=$a;
         }
      
         function Row($pdata)
         {
             //Calculate the height of the row
             $nb=0;
             for($i=0;$i<count($pdata);$i++)
                 $nb=max($nb,$this->NbLines($this->widths[$i],$pdata[$i]));
             $h=15*$nb;
             //Issue a page break first if needed
             $this->CheckPageBreak($h);
             //Draw the cells of the row
             for($i=0;$i<count($pdata);$i++)
             {
                 $w=$this->widths[$i];
                 $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                 //Save the current position
                 $x=$this->GetX();
                 $y=$this->GetY();
                 //Draw the border
                 $this->Rect($x,$y,$w,$h);
                 //Print the text
                 $this->MultiCell($w,15,$pdata[$i],0,$a);
                 //Put the position to the right of the cell
                 $this->SetXY($x+$w,$y);
             }
             //Go to the next line
             $this->Ln($h);
         }
      
         function CheckPageBreak($h)
         {
             //If the height h would cause an overflow, add a new page immediately
             if($this->GetY()+$h>$this->PageBreakTrigger)
                 $this->AddPage($this->CurOrientation);
         }
      
         function NbLines($w,$txt)
         {
             //Computes the number of lines a MultiCell of width w will take
             $cw=&$this->CurrentFont['cw'];
             if($w==0)
                 $w=$this->w-$this->rMargin-$this->x;
             $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
             $s=str_replace("\r",'',$txt);
             $nb=strlen($s);
             if($nb>0 and $s[$nb-1]=="\n")
                 $nb--;
             $sep=-1;
             $i=0;
             $j=0;
             $l=0;
             $nl=1;
             while($i<$nb)
             {
                 $c=$s[$i];
                 if($c=="\n")
                 {
                     $i++;
                     $sep=-1;
                     $j=$i;
                     $l=0;
                     $nl++;
                     continue;
                 }
                 if($c==' ')
                     $sep=$i;
                 $l+=$cw[$c];
                 if($l>$wmax)
                 {
                     if($sep==-1)
                     {
                         if($i==$j)
                             $i++;
                     }
                     else
                         $i=$sep+1;
                     $sep=-1;
                     $j=$i;
                     $l=0;
                     $nl++;
                 }
                 else
                     $i++;
             }
             return $nl;
         }
     } //end of class
      
     //contoh penggunaan
     $pdata = $data['poitem'];
     $hdata = $data['header'];
      
     //pilihan
     $options = array(
         'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
         'destinationfile' => '', //I=inline browser (default), F=local file, D=download
         'paper_size'=>'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
         'orientation'=>'P' //orientation: P=portrait, L=landscape
     );
      
     $tabel = new FPDF_AutoWrapTable($pdata, $options,$hdata);
     $tabel->printPDF();
     ?>