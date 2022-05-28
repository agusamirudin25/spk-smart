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
        $kode_pengguna = $_SESSION['nip'];
        $query = "SELECT
            alternatif.kode_alternatif as kd_alternatif,
            alternatif.nama_alternatif,
            ( SELECT p.nilai FROM penilaian p WHERE p.kode_pengguna = '$kode_pengguna' AND p.kode_alternatif = kd_alternatif AND p.kode_kriteria = 'K1' ) AS K1,
            ( SELECT p.nilai FROM penilaian p WHERE p.kode_pengguna = '$kode_pengguna' AND p.kode_alternatif = kd_alternatif AND p.kode_kriteria = 'K2' ) AS K2,
            ( SELECT p.nilai FROM penilaian p WHERE p.kode_pengguna = '$kode_pengguna' AND p.kode_alternatif = kd_alternatif AND p.kode_kriteria = 'K3' ) AS K3,
            ( SELECT p.nilai FROM penilaian p WHERE p.kode_pengguna = '$kode_pengguna' AND p.kode_alternatif = kd_alternatif AND p.kode_kriteria = 'K4' ) AS K4,
            ( SELECT p.nilai FROM penilaian p WHERE p.kode_pengguna = '$kode_pengguna' AND p.kode_alternatif = kd_alternatif AND p.kode_kriteria = 'K5' ) AS K5 
        FROM
            alternatif
            LEFT JOIN penilaian ON penilaian.kode_alternatif = alternatif.kode_alternatif
            LEFT JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria
            GROUP BY kd_alternatif";
        $penilaian = $this->_db->other_query($query, 2);
        $tempData = [];
        $status_tombol = true;
        foreach ($penilaian as $key => $value) {
            if ($value['K1'] == NULL || $value['K2'] == NULL || $value['K3'] == NULL || $value['K4'] == NULL || $value['K5'] == NULL) {
                $tempData[] = [
                    'kode'   => $value['kd_alternatif'],
                    'nama'   => $value['nama_alternatif'],
                    'K1'     => (int)$value['K1'],
                    'K2'     => (float)$value['K2'],
                    'K3'     => (int)$value['K3'],
                    'K4'     => (int)$value['K4'],
                    'K5'     => (int)$value['K5'],
                    'status' => 0
                ];
                $status_tombol = false;
            } else {
                $tempData[] = [
                    'kode' => $value['kd_alternatif'],
                    'nama' => $value['nama_alternatif'],
                    'K1' => (int)$value['K1'],
                    'K2' => (float)$value['K2'],
                    'K3' => (int)$value['K3'],
                    'K4' => (int)$value['K4'],
                    'K5' => (int)$value['K5'],
                    'status' => 1
                ];
                $status_tombol = true;
            }
        }
        $data['penilaian'] = $tempData;
        $data['status_tombol'] = $status_tombol;
        view('layouts/_head');
        view('keputusan/index', $data);
        view('layouts/_foot');
    }

    public function buat_keputusan()
    {
        $waktuAwal = microtime(true);
        $kode_pengguna = $_SESSION['nip'];
        $kriteria = $this->_db->getAll('kriteria');
        $alternatif = $this->_db->getAll('alternatif');

        //ambil total bobot kriteria
        $totalBobot = $this->_db->other_query("SELECT sum(bobot) as total FROM kriteria")->total;
        foreach ($kriteria as $key => $row) {
            //ambil nilai bobot dari setiap kriteria
            $bobot = $this->_db->other_query("SELECT bobot FROM kriteria WHERE kode_kriteria = '$row[kode_kriteria]'")->bobot;
            $nilaiNormalisasi[$row['kode_kriteria']]['nilai'] = (float)$bobot / (float)$totalBobot;
            $nilaiNormalisasi[$row['kode_kriteria']]['kode'] = $row['kode_kriteria'];
            $nilaiNormalisasi[$row['kode_kriteria']]['kriteria'] = $row['nama_kriteria'];
            $nilaiNormalisasi[$row['kode_kriteria']]['bobot'] = $row['bobot'];
        }
        $data['normalisasi'] = $nilaiNormalisasi;

        //MENGHITUNG NILAI UTILITY
        foreach ($alternatif as $a) {
            foreach ($kriteria as $k) {
                //ambil nilai cout
                $cout = $this->_db->other_query("SELECT * FROM penilaian WHERE kode_alternatif = '$a[kode_alternatif]' AND kode_kriteria = '$k[kode_kriteria]'");

                //ambil nilai cmax
                $cmax = $this->_db->other_query("SELECT max(nilai) as max FROM penilaian WHERE kode_kriteria = '$k[kode_kriteria]'")->max;
                //ambil nilai cmin
                $cmin = $this->_db->other_query("SELECT min(nilai) as min FROM penilaian WHERE kode_kriteria = '$k[kode_kriteria]'")->min;

                if ($k['tipe'] == 'benefit') {
                    $nilaiUtility[$a['kode_alternatif']]['kode' . $k['kode_kriteria']] = $k['kode_kriteria'];
                    $nilaiUtility[$a['kode_alternatif']]['nilai' . $k['kode_kriteria']] = ((float)$cout->nilai - (float)$cmin) / ((float)$cmax - (float)$cmin);
                } else {
                    $nilaiUtility[$a['kode_alternatif']]['kode' . $k['kode_kriteria']] = $k['kode_kriteria'];
                    $nilaiUtility[$a['kode_alternatif']]['nilai' . $k['kode_kriteria']] = ((float)$cmax - (float)$cout->nilai) / ((float)$cmax - $cmin);
                }
            }
        }
        $data['nilai_utility'] = $nilaiUtility;

        //MENGHITUNG NILAI AKHIR
        foreach ($alternatif as $alter) {
            $temp = 0;
            foreach ($kriteria as $kriter) {
                $temp += ($nilaiUtility[$alter['kode_alternatif']]['nilai' . $kriter['kode_kriteria']] * $nilaiNormalisasi[$kriter['kode_kriteria']]['nilai']);
            }
            $nilaiAkhir[$alter['kode_alternatif']]['nilai'] = $temp;
            $nilaiAkhir[$alter['kode_alternatif']]['kode'] = $alter['kode_alternatif'];
        }
        rsort($nilaiAkhir);
        $data['nilai_akhir'] = $nilaiAkhir;

        $kode_alternatif_keputusan = $nilaiAkhir[0]['kode'];
        $nilai_keputusan = $nilaiAkhir[0]['nilai'];
        $data['keputusan'] = $this->_db->other_query("SELECT * FROM alternatif WHERE kode_alternatif = '$kode_alternatif_keputusan'");

        // cek apakah sudah ada keputusan table hasil
        $cek = $this->_db->other_query("SELECT nilai FROM hasil WHERE kode_pengguna = '$kode_pengguna'")->nilai;
        if($cek){
            $this->_db->edit("UPDATE hasil SET kode_alternatif = '$kode_alternatif_keputusan', nilai = '$nilai_keputusan' WHERE kode_pengguna = '$kode_pengguna'");
        }else{
            $this->_db->insert("INSERT INTO hasil (kode_pengguna, kode_alternatif, nilai) VALUES ('$kode_pengguna', '$kode_alternatif_keputusan', '$nilai_keputusan')");
        }

        //Inisialisasi waktu akhir
        $waktuAkhir = microtime(true);
		$waktuTempuh = $waktuAkhir - $waktuAwal;
		$data['waktu'] = $waktuTempuh;
        $data['kriteria'] = $kriteria;
        $data['alternatif'] = $alternatif;

        view('layouts/_head');
        view('keputusan/hasil', $data);
        view('layouts/_foot');
    }
}
