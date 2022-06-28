<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Laporan
{
    protected $_db;
    public function __construct()
    {
        $this->_db = new Database();
        if (!isset($_SESSION['nip'])) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $hasil = $this->_db->other_query("SELECT hasil.*, pengguna.kode_pengguna, pengguna.nama_lengkap, alternatif.nama_alternatif FROM hasil JOIN pengguna ON hasil.kode_pengguna = pengguna.kode_pengguna JOIN alternatif ON hasil.kode_alternatif = alternatif.kode_alternatif", 2);
        $data['hasil'] = $hasil;
        view('layouts/_head');
        view('laporan', $data);
        view('layouts/_foot');
    }

    public function generate()
    {
        $hasil = $this->_db->other_query("SELECT hasil.*, pengguna.kode_pengguna, pengguna.nama_lengkap, alternatif.nama_alternatif FROM hasil JOIN pengguna ON hasil.kode_pengguna = pengguna.kode_pengguna JOIN alternatif ON hasil.kode_alternatif = alternatif.kode_alternatif", 2);
        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->Image('assets/logo.jpg',10,10,-100);
        //Arial bold 15
        $pdf->SetFont('Arial','B',15);
        //pindah ke posisi ke tengah untuk membuat judul
        $pdf->Cell(80);
        //judul
        $pdf->Cell(50,10,'YAYASAN CAHAYA INSAN BARAKOH',0,1,'C');
        $pdf->Cell(210,0,'SMP ISLAM AL  BAYYINAH',0,0,'C');
        //pindah baris
        $pdf->Ln(20);

        $pdf->SetFont('Arial','',10);
        $pdf->cell(210,-28  ,'Kp.Karang anyar Rt.02/05 Desa Kedung',0,1,'C');
        $pdf->cell(210,38  ,'Kec.Kedungwaringin, Kab. Bekasi, Provinsi Jawa Barat, 17540',0,0,'C');
        //buat garis horisontal
        $pdf->Line(10,35,200,35);
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->setY(60);
        $pdf->Cell(200, 10, 'LAPORAN HASIL KEPUTUSAN EKSTRAKURIKULER SISWA', 0, 1, 'C');

        $pdf->setXY(12, 75);
        $pdf->SetFont('Times', '', 12);
        $pdf->MultiCell(188, 6, '     Berikut hasil keputusan penentuan ekstrakurikuler siswa menggunakan metode Simple Multi-Attribute Rating Technique. Hasil keputusan ini dapat digunakan sebagai bahan evaluasi dari penyelenggaraan ekstrakurikuler di sekolah. Hasil keputusan sebagai berikut: ', 0);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(35, 3, " ", 0, 1, "L");


        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(45, 10, 'NIS', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Nama Lengkap', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Ekstrakurikuler', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nilai', 1, 1, 'C');
        foreach ($hasil as $key => $row) {
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10, 10, $key + 1, 1, 0, 'C');
            $pdf->Cell(45, 10, $row['kode_pengguna'], 1, 0, 'L');
            $pdf->Cell(50, 10, $row['nama_lengkap'], 1, 0, 'L');
            $pdf->Cell(45, 10, $row['nama_alternatif'], 1, 0, 'C');
            $pdf->Cell(40, 10, round($row['nilai'] * 100, 2)  . '%', 1, 1, 'C');
        }
        $pdf->Ln();

        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(156);
        $pdf->MultiCell(30,4,'Kepala BK',0,'C');

        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(180);
        $pdf->MultiCell(19.5,25,'',0,'R');

        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(148);
        $pdf->MultiCell(50,4, "Yayan Supriatna, S,Pd",0,'C');

        $pdf->Ln();                
        $pdf->Output();
    }
}
