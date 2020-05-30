<?php
     ini_set('display_errors', 1);

     include   APPPATH.'libraries/FPDF/MultiCell.php';

     $pdf      =    new PDF_MC_Table('L');

     $pdf->AddPage('L', 'Legal');
     $pdf->setPaperSizeWhenPageBreak('Legal');

     $pdf->SetFont('Arial', 'B', 20);
     $pdf->Cell(335, 10, 'Data Siswa', 0, 1, 'C');
     $pdf->SetFont('Arial', '', 12);
     $pdf->Ln();

     $pdf->SetWidths([50, 10, 275]);
     $pdf->SetAligns(['L', 'C', 'L']);
     
     if($idKelas !== 'null' && $idKelas !== false){
          $this->db->where('idKelas', $idKelas);
          $detailKelas   =    $this->db->get('ts_kelas')->row();

          $pdf->Cell(50, 7, 'Kelas', 0, 0, 'L');
          $pdf->Cell(10, 7, ':', 0, 0, 'C');
          $pdf->Cell(275, 7, $detailKelas->namaKelas, 0, 0, 'L');
          $pdf->Ln();

          $this->db->where('kelas', $idKelas);
     }

     if($tahunAjaran !== 'null' && $tahunAjaran !== false){
          $pdf->Cell(50, 7, 'Tahun Ajaran', 0, 0, 'L');
          $pdf->Cell(10, 7, ':', 0, 0, 'C');
          $pdf->Cell(275, 7, $tahunAjaran, 0, 0, 'L');
          $pdf->Ln();

          $this->db->where('tahunAjaran', $tahunAjaran);
     }

     $dataSiswa     =    $this->db->get('view_siswa')->result_array();


     $pdf->Ln();

     $pdf->SetFont('Arial', 'B', 14);
     $pdf->Cell(10, 15, 'No.', 1, 0, 'C');
     $pdf->Cell(90, 15, 'Nama Siswa', 1, 0, 'L');
     $pdf->Cell(50, 15, 'No. HP', 1, 0, 'L');
     $pdf->Cell(35, 15, 'NIS', 1, 0, 'L');
     $pdf->Cell(40, 15, 'Kelas', 1, 0, 'L');
     $pdf->Cell(50, 15, 'Email', 1, 0, 'L');
     $pdf->Cell(60, 15, 'No. HP Ortu', 1, 0, 'L');
     $pdf->Ln();
     
     if(count($dataSiswa) >= 1){
          $pdf->SetFont('Arial', '', 12);
          $pdf->SetWidths([10, 90, 50, 35, 40, 50, 60]);
          $pdf->SetAligns(['C', 'L', 'L', 'L', 'L', 'L', 'L']);

          foreach($dataSiswa as $indexData => $data){
               $pdf->Row([
                    $indexData+1,
                    $data['nama']."\n".$data['alamat'],
                    $data['noHP'],
                    $data['nis'],
                    $data['namaKelas'],
                    $data['email'],
                    $data['noHPOrangTua']
               ]);
          }
     }else{
          $pdf->Cell('335', 15, 'Data Tidak Ditemukan !', 1, 0, 'C');
     }

     $pdf->Output();
?>