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
        $hasil = $this->_db->other_query("SELECT t_hasil.*, t_guru.nip, t_guru.nama_lengkap FROM t_hasil JOIN t_guru ON t_hasil.kode_alternatif = t_guru.kode_alternatif ORDER BY t_hasil.hasil DESC", 2);
        $data['hasil'] = $hasil;
        view('layouts/_head');
        view('laporan', $data);
        view('layouts/_foot');
    }

    public function generate()
    {
        $hasil = $this->_db->other_query("SELECT t_hasil.*, t_guru.nip, t_guru.nama_lengkap FROM t_hasil JOIN t_guru ON t_hasil.kode_alternatif = t_guru.kode_alternatif ORDER BY t_hasil.hasil DESC", 2);
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        // $pdf->Image(FCPATH . 'assets/images/kop.png', -2, -3, 220);
        $pdf->setY(60);
        $pdf->Cell(200, 10, 'LAPORAN HASIL PENILAIAN KINERJA GURU', 0, 1, 'C');


        $pdf->setXY(21, 78);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(45, 10, 'NIP', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Nama Lengkap', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Nilai', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Persentase', 1, 1, 'C');
        foreach ($hasil as $key => $row) {
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10, 10, $key + 1, 1, 0, 'C');
            $pdf->Cell(45, 10, $row['nip'], 1, 0, 'L');
            $pdf->Cell(50, 10, $row['nama_lengkap'], 1, 0, 'L');
            $pdf->Cell(45, 10, $row['hasil'], 1, 0, 'C');
            $pdf->Cell(40, 10, round($row['hasil'] * 100, 2)  . '%', 1, 1, 'C');
        }
        $pdf->Output();
    }
}
