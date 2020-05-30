<?php
     ini_set('display_errors', 1);

     include   APPPATH.'libraries/FPDF/MultiCell.php';

     $pdf      =    new PDF_MC_Table('L');

     $pdf->AddPage('L', 'Legal');
     $pdf->setPaperSizeWhenPageBreak('Legal');

     $pdf->SetFont('Arial', 'B', 20);
     $pdf->Cell(335, 10, 'Laporan Transaksi Global', 0, 1, 'C');
     if($waktuAwal !== '' && $waktuAkhir !== '' && $waktuAwal !== 'null' && $waktuAkhir !== 'null'){
          $pdf->SetFont('Arial', '', 10);
          $pdf->Cell(335, 10, 'Periode '.$waktuAwal.' s/d '.$waktuAkhir, 0, 1, 'C');
     }

     $pdf->Ln();

     $pdf->SetFont('Arial', 'B', 12);
     $pdf->Cell(15, 15, 'No.', 1, 0, 'C');
     $pdf->Cell(60, 15, 'Nama Tabungan', 1, 0, 'L');
     $pdf->Cell(35, 15, 'No. Transaksi', 1, 0, 'C');
     $pdf->Cell(30, 15, 'Nominal', 1, 0, 'R');
     $pdf->Cell(30, 15, 'Action', 1, 0, 'L');
     $pdf->Cell(40, 15, 'Jenis Biaya', 1, 0, 'L');
     $pdf->Cell(50, 15, 'Nama Siswa', 1, 0, 'L');
     $pdf->Cell(30, 15, 'Admin', 1, 0, 'L');
     $pdf->Cell(45, 15, 'Waktu', 1, 0, 'L');
     $pdf->Ln();

     $pdf->SetFont('Arial', '', 11);
     $pdf->SetWidths([15, 60, 35, 30, 30, 40, 50, 30, 45]);
     $pdf->SetAligns(['C', 'L', 'C', 'R', 'L', 'L', 'L', 'L']);

     if($kelas !== '' && $kelas !== 'null'){
          $this->db->where('idKelas', $kelas);
     }
     if($admin !== '' && $admin !== 'null'){
          $this->db->where('admin', $admin);
     }
     if($waktuAwal !== '' && $waktuAkhir !== '' && $waktuAwal !== 'null' && $waktuAkhir !== 'null'){
          $this->db->where('waktuTransaksi >=', $waktuAwal.' 00:00:00');
          $this->db->where('waktuTransaksi <=', $waktuAkhir.' 23:59:59');
     }
     if($actionTransaksi !== '' && $actionTransaksi !== 'null'){
          $this->db->where('action', $actionTransaksi);
     }
     if($statusReverse !== '' && $statusReverse !== 'null'){
          $this->db->where('statusReverse', $statusReverse);
     }
     if($jenisBiaya !== '' && $jenisBiaya !== 'null'){
          $this->db->where('jenisBiaya', $jenisBiaya);
     }
     
     $listTransaksiGlobal   =    $this->db->get('view_transaksi')->result_array();

     foreach($listTransaksiGlobal as $indexData => $data){
          if($data['statusReverse'] === 'pending' || $data['statusReverse'] === 'reverse'){
               $keteranganReverse  =    "\nTransaksi direverse (".strtoupper($data['statusReverse']).")";
          }else{
               $keteranganReverse  =    '';
          }

          $pdf->Row([
               ($indexData+1).'.', 
               $data['namaTabungan']."\n No. Tab. ".$data['nomorTabungan'].$keteranganReverse, 
               $data['nomorTransaksi'], 
               'Rp. '.number_format($data['nominal']), 
               $data['action'], 
               $data['namaJenisBiaya'], 
               $data['siswaPemilikTabungan'], 
               'admin-'.$data['admin'], 
               $data['waktuTransaksi']
          ]);
     }

     $pdf->Output();
?>