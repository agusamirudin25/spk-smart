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
        $pdf->SetFont('Arial', 'B', 16);
        // $pdf->Image(FCPATH . 'assets/images/kop.png', -2, -3, 220);
        $pdf->setY(60);
        $pdf->Cell(200, 10, 'LAPORAN HASIL KEPUTUSAN EKSTRAKURIKULER SISWA', 0, 1, 'C');


        $pdf->setXY(21, 78);
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
        $pdf->Output();
    }
}
