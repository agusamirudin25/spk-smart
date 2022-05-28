<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Keputusan
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
        $data['guru'] = $this->_db->getAll('t_guru');
        $penilaian = $this->_db->getAll('v_penilaian');
        $tempData = [];
        foreach ($penilaian as $key => $value) {
            if ($value['K1'] == NULL || $value['K2'] == NULL || $value['K3'] == NULL || $value['K4'] == NULL || $value['K5'] == NULL) {
                $tempData[] = [
                    'kode'   => $value['kd_alternatif'],
                    'nama'   => $value['nama_lengkap'],
                    'K1'     => (int)$value['K1'],
                    'K2'     => (float)$value['K2'],
                    'K3'     => (int)$value['K3'],
                    'K4'     => (int)$value['K4'],
                    'K5'     => (int)$value['K5'],
                    'status' => 0
                ];
            } else {
                $tempData[] = [
                    'kode' => $value['kd_alternatif'],
                    'nama' => $value['nama_lengkap'],
                    'K1' => (int)$value['K1'],
                    'K2' => (float)$value['K2'],
                    'K3' => (int)$value['K3'],
                    'K4' => (int)$value['K4'],
                    'K5' => (int)$value['K5'],
                    'status' => 1
                ];
            }
        }
        $data['penilaian'] = $tempData;
        view('layouts/_head');
        view('keputusan/index', $data);
        view('layouts/_foot');
    }

    public function tambah_penilaian($kode_alternatif)
    {
        $data['guru'] = $this->_db->other_query("SELECT * FROM t_guru WHERE kode_alternatif = '$kode_alternatif'");
        $data['kriteria'] = $this->_db->getAll('t_kriteria');
        $nilai = $this->_db->other_query("SELECT * FROM t_penilaian WHERE kode_alternatif = '$kode_alternatif'", 2);
        $tempNilai = [];
        foreach ($nilai as $key => $value) {
            $tempNilai[$value['kode_kriteria']] = (float) $value['nilai'];
        }
        $data['nilai'] = $tempNilai;
        $data['arrKriteria'] = [
            'K2', 'K3', 'K4'
        ];
        view('layouts/_head');
        view('keputusan/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_penilaian()
    {
        $nilai = $_POST['nilai'];
        $kd_kriteria = $_POST['kd_kriteria'];
        $kode_alternatif = $_POST['kode_alternatif'];
        $i = 0;
        foreach ($nilai as $row) :
            // insert t_penilaian
            $kode_kriteria = $kd_kriteria[$i++];
            $this->_db->insert("INSERT INTO t_penilaian (kode_alternatif, kode_kriteria, nilai, `status`) VALUES ('$kode_alternatif', '$kode_kriteria', '$row', 1)");
        endforeach;

        $res['status'] = 1;
        $res['msg'] = "Data Penilaian berhasil ditambahkan";
        $res['page'] = "keputusan";

        echo json_encode($res);
    }
    public function ubah_penilaian($kode)
    {
        $data['keputusan'] = $this->_db->other_query("SELECT * FROM v_penilaian WHERE kd_alternatif = '$kode'");
        $data['kriteria'] = $this->_db->other_query("SELECT * FROM t_kriteria", 2);
        $data['arrKriteria'] = [
            'K2', 'K3', 'K4'
        ];
        view('layouts/_head');
        view('keputusan/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_penilaian()
    {
        $nilai = $_POST['nilai'];
        $kd_kriteria = $_POST['kd_kriteria'];
        $kode_alternatif = $_POST['kode_alternatif'];
        $i = 0;
        foreach ($nilai as $row) :
            // insert t_penilaian
            $kode_kriteria = $kd_kriteria[$i++];
            $this->_db->edit("UPDATE t_penilaian SET nilai = '$row' WHERE kode_alternatif = '$kode_alternatif' AND kode_kriteria = '$kode_kriteria'");
        endforeach;

        $res['status'] = 1;
        $res['msg'] = "Data Penilaian berhasil diubah";
        $res['page'] = "keputusan";

        echo json_encode($res);
    }
    public function hapus_penilaian()
    {
        $input = post();
        $id = $input['id'];
        $this->_db->insert("DELETE FROM t_penilaian WHERE kode_alternatif = '$id' AND kode_kriteria != 'K2'");
        $res['status'] = 1;
        $res['msg'] = "Data berhasil dihapus";
        $res['page'] = "Keputusan";
        echo json_encode($res);
    }

    public function buat_keputusan()
    {
        $waktuAwal = microtime(true);
        $penilaian = $this->_db->getAll('v_penilaian');
        $kriteria = $this->_db->getAll('t_kriteria');

        $nilai_max = [];
        $nilai_min = [];
        // PROSES NORMALISASI
        foreach ($penilaian as $key_penilaian => $value_penilaian) {
            foreach ($kriteria as $key => $row) {
                $nilai_max = $this->_db->other_query("SELECT MAX({$row['kode_kriteria']}) AS max FROM v_penilaian")->max;
                $nilai_min = $this->_db->other_query("SELECT MIN({$row['kode_kriteria']}) AS min FROM v_penilaian")->min;
                // pretty($row['tipe'] == 'benefit' ? ($value_penilaian[$row['kode_kriteria']] . '/' . $nilai_max) : ($nilai_min . '/' . $value_penilaian[$row['kode_kriteria']]), 0);
                $normalisasi[$value_penilaian['kd_alternatif']][$row['kode_kriteria']] = $row['tipe'] == 'benefit' ? ($value_penilaian[$row['kode_kriteria']] / $nilai_max) : ($nilai_min / $value_penilaian[$row['kode_kriteria']]);
            }
        }

        // menentukan bobot kriteria
        $totalBobot = $this->_db->other_query("SELECT SUM(bobot) AS total FROM t_kriteria")->total;
        foreach ($kriteria as $key => $row) {
            $bobot[$row['kode_kriteria']] = $row['bobot'] / $totalBobot;
        }
        // hasil perangkingan
        foreach ($normalisasi as $key => $row) {
            $hasil[$key] = 0;
            foreach ($row as $key_perankingan => $row_perankingan) {
                $hasil[$key] += $row_perankingan * $bobot[$key_perankingan];
            }
        }
        // insert hasil to t_hasil
        foreach ($hasil as $key => $row) {
            // cek data
            $cek = $this->_db->other_query("SELECT * FROM t_hasil WHERE kode_alternatif = '$key'");
            if ($cek) {
                $this->_db->edit("UPDATE t_hasil SET hasil = '$row' WHERE kode_alternatif = '$key'");
            } else {
                $this->_db->insert("INSERT INTO t_hasil (kode_alternatif, hasil) VALUES ('$key', '$row')");
            }
        }
        arsort($hasil);
        $hasil_saw = [];
        foreach ($hasil as $key => $hasilAkhir) {
            $nama_lengkap = $this->_db->other_query("SELECT * FROM t_guru WHERE kode_alternatif = '$key'");
            $hasil_saw[] = [
                'kode' => $key,
                'nama_lengkap' => $nama_lengkap->nama_lengkap,
                'nilai' => $hasilAkhir,
                'persen' => round($hasilAkhir * 100, 2) . '%'
            ];
        }
        $waktuAkhir = microtime(true);
        //waktu eksekusi mabac
        $waktuTempuh = $waktuAkhir - $waktuAwal;

        $data['hasil'] = $hasil_saw;
        // pretty($data['hasil'], 1);
        $data['waktu'] = $waktuTempuh;
        view('layouts/_head');
        view('keputusan/hasil', $data);
        view('layouts/_foot');
    }
}
