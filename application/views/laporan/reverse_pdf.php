<?php
     ini_set('display_errors', 1);

     include   APPPATH.'libraries/FPDF/MultiCell.php';

     $pdf      =    new PDF_MC_Table('L');

     $pdf->AddPage('L', 'A4');
     $pdf->setPaperSizeWhenPageBreak('Legal');

     $pdf->SetFont('Arial', 'B', 20);
     $pdf->Cell(277, 10, 'Laporan Reverse', 0, 1, 'C');
     if($waktuAwal !== false && $waktuAkhir !== false){
          $pdf->SetFont('Arial', '', 10);
          $pdf->Cell(277, 10, 'Periode '.$waktuAwal.' s/d '.$waktuAkhir, 0, 1, 'C');
     }

     $pdf->SetFont('Arial', '', 12);
     $pdf->Ln();

     $pdf->SetFont('Arial', 'B', 14);
     $pdf->Cell(15, 15, 'No.', 1, 0, 'C');
     $pdf->Cell(65, 15, 'Nomor Transaksi', 1, 0, 'L');
     $pdf->Cell(80, 15, 'Keterangan', 1, 0, 'L');
     $pdf->Cell(47, 15, 'Status Reverse', 1, 0, 'C');
     $pdf->Cell(70, 15, 'Waktu Reverse', 1, 0, 'R');
     $pdf->Ln();

     $pdf->SetFont('Arial', '', 12);
     $pdf->SetWidths([15, 65, 80, 47, 70]);
     $pdf->SetAligns(['C', 'L', 'L', 'C', 'R']);

     if($statusReverse !== false){
          $this->db->where('statusReverse', $statusReverse);
     }
     if($waktuAwal !== false && $waktuAkhir !== false){
          $opsiRentangWaktu   =    [
               'waktu >=' => $waktuAwal.' 00:00:00',
               'waktu <=' => $waktuAkhir.' 23:59:59'
          ];

          $this->db->where($opsiRentangWaktu);
     }
     $laporanReverse     =    $this->db->get('ts_reverse')->result_array();

     foreach($laporanReverse as $indexData => $data){
          if($data['statusReverse'] === 'reverse'){
               $keterangan    =    ' '.$data['statusReverse']." \n Transaksi ini Sudah di Reverse";
          }else{
               $keterangan    =    ' '.$data['statusReverse'];
          }

          $pdf->Row([
               ($indexData+1).'.', 
               $data['nomorTransaksi'], 
               $data['keterangan'], 
               $data['statusReverse'], 
               $data['waktu']
          ]);
     }
     
     // $pdf->SetFont('Arial', 'B', 14);
     // $pdf->Cell(245, 15, 'Total', 1, 0, 'C');
     // $pdf->Cell(90, 15, 'Rp. '.number_format($saldoAkhir), 1, 0, 'C');

     $pdf->Output();
?>