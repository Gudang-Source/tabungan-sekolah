<?php
     ini_set('display_errors', 1);

     $this->db->select('nama, alamat, nis, namaKelas');
     $this->db->where('idSiswa', $idSiswa);
     $detailSiswa   =   $this->db->get('view_siswa')->row();

     $this->db->where('idSiswaPemilikTabungan', $idSiswa);
     if(strlen($waktuAwal) >= 1 && strlen($waktuAkhir) >= 1){
          $this->db->where('waktuTransaksi >=', $waktuAwal.' 00:00:00');
          $this->db->where('waktuTransaksi <=', $waktuAkhir.' 23:59:59');
     }
     $listTransaksiTabungan   =    $this->db->get('view_transaksi')->result_array();
     
     $this->db->select('nominal, action');
     $this->db->where('idSiswaPemilikTabungan', $idSiswa);
     $this->db->where('statusReverse !=', 'reverse');
     $debitKredit    =    $this->db->get('view_transaksi')->result_array();
     
     $totalSaldo    =    0;
     foreach($debitKredit as $dK){
          $totalSaldo    +=   ($dK['action'] === 'keluar')? $dK['nominal']*-1 : $dK['nominal'];
     }

     include   APPPATH.'libraries/FPDF/MultiCell.php';

     $pdf      =    new PDF_MC_Table('L');

     $pdf->AddPage('L', 'Legal');
     $pdf->setPaperSizeWhenPageBreak('Legal');

     $pdf->SetFont('Arial', 'B', 20);
     $pdf->Cell(335, 10, 'Riwayat Transaksi', 0, 1, 'C');
     $pdf->SetFont('Arial', '', 12);
     $pdf->Ln();

     $pdf->SetWidths([50, 10, 275]);
     $pdf->SetAligns(['L', 'C', 'L']);
     
     $pdf->Cell(50, 7, 'NIS', 0, 0, 'L');
     $pdf->Cell(10, 7, ':', 0, 0, 'C');
     $pdf->Cell(275, 7, $detailSiswa->nis, 0, 0, 'L');
     $pdf->Ln();

     $pdf->Cell(50, 7, 'Nama', 0, 0, 'L');
     $pdf->Cell(10, 7, ':', 0, 0, 'C');
     $pdf->Cell(275, 7, $detailSiswa->nama, 0, 0, 'L');
     $pdf->Ln();

     $pdf->Cell(50, 7, 'Kelas', 0, 0, 'L');
     $pdf->Cell(10, 7, ':', 0, 0, 'C');
     $pdf->Cell(275, 7, $detailSiswa->namaKelas, 0, 0, 'L');
     $pdf->Ln();

     $pdf->Cell(50, 7, 'Alamat', 0, 0, 'L');
     $pdf->Cell(10, 7, ':', 0, 0, 'C');
     $pdf->Cell(275, 7, $detailSiswa->alamat, 0, 0, 'L');
     $pdf->Ln();

     $pdf->Cell(50, 7, 'Saldo Akhir', 0, 0, 'L');
     $pdf->Cell(10, 7, ':', 0, 0, 'L');
     $pdf->Cell(275, 7, 'Rp. '.number_format($totalSaldo).' ,- (Terhitung Dari Awal Menabung sampai Sekarang)', 0, 0, 'L');
     $pdf->Ln();

     $pdf->Ln();

     $pdf->SetFont('Arial', 'B', 14);
     $pdf->Cell(10, 15, 'No.', 1, 0, 'C');
     $pdf->Cell(45, 15, 'Nomor Transaksi', 1, 0, 'L');
     $pdf->Cell(60, 15, 'Keterangan', 1, 0, 'L');
     $pdf->Cell(50, 15, 'Jenis Biaya', 1, 0, 'L');
     $pdf->Cell(25, 15, 'Debit', 1, 0, 'R');
     $pdf->Cell(25, 15, 'Kredit', 1, 0, 'R');
     $pdf->Cell(30, 15, 'Saldo Akhir', 1, 0, 'R');
     $pdf->Cell(30, 15, 'Admin', 1, 0, 'L');
     $pdf->Cell(60, 15, 'Waktu', 1, 0, 'L');
     $pdf->Ln();

     $pdf->SetFont('Arial', '', 12);

     $saldoAkhir    =    0;

     foreach($listTransaksiTabungan as $indexData => $data){
          if($data['statusReverse'] === 'reverse'){
               $isReversed    =    true;
          }else{
               $isReversed    =    false;
          }

          $pdf->SetWidths([10, 45, 60, 50, 25, 25, 30, 30, 60]);
          $pdf->SetAligns(['C', 'L', 'L', 'L', 'R', 'R', 'R', 'L', 'L']);

          $pdf->Row([
               $indexData+1, 
               $data['nomorTransaksi'], 
               $data['keterangan'],
               $data['namaJenisBiaya'],
               'Rp. '.number_format(($data['action'] === 'keluar')? $data['nominal'] : 0), 
               'Rp. '.number_format(($data['action'] === 'masuk')? $data['nominal'] : 0),
               'Rp. '.number_format(($data['action'] === 'keluar')? $saldoAkhir = $saldoAkhir + $data['nominal'] * -1 : $saldoAkhir = $saldoAkhir + $data['nominal']),
               'admin-'.$data['admin'],
               $data['waktuTransaksi']
          ]);

          if($isReversed){
               $pdf->SetWidths([10, 155, 25, 25, 30, 30, 60]);
               $pdf->SetAligns(['C', 'L', 'R', 'R', 'R', 'L', 'L']);

               $pdf->Row([
                    '-', 
                    $data['nomorTransaksi']."\n Status Reverse : ".$data['statusReverse']."\n Keterangan : ".$data['keteranganReverse'], 
                    'Rp. '.number_format(($data['action'] === 'masuk')? $data['nominal'] : 0), 
                    'Rp. '.number_format(($data['action'] === 'keluar')? $data['nominal'] : 0),
                    'Rp. '.number_format(($data['action'] === 'masuk')? $saldoAkhir = $saldoAkhir + $data['nominal'] * -1 : $saldoAkhir = $saldoAkhir + $data['nominal']),
                    'admin-'.$data['admin'],
                    $data['waktuTransaksi']
               ]);
          }
     }
     
     // $pdf->SetFont('Arial', 'B', 14);
     // $pdf->Cell(245, 15, 'Total', 1, 0, 'C');
     // $pdf->Cell(90, 15, 'Rp. '.number_format($saldoAkhir), 1, 0, 'C');

     $pdf->Output();
?>