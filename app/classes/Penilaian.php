<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Penilaian
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
        $penilaian = [];
        $kode_pengguna = $_SESSION['nip'];
        $total_kriteria = $this->_db->other_query("SELECT count(kode_kriteria) as total FROM kriteria", 1)->total;
        $alternatif = $this->_db->other_query("SELECT * FROM alternatif", 2);
        foreach ($alternatif as $row) {
            $total_penilaian = $this->_db->other_query("SELECT count(id) as total FROM penilaian WHERE kode_pengguna = {$kode_pengguna} AND kode_alternatif = '$row[kode_alternatif]'")->total;
            if($total_penilaian == $total_kriteria) {
                $penilaian[] = [
                    'kode_alternatif' => $row['kode_alternatif'],
                    'nama_alternatif' => $row['nama_alternatif'],
                    'status' => 1
                ];
            }else{
                $penilaian[] = [
                    'kode_alternatif' => $row['kode_alternatif'],
                    'nama_alternatif' => $row['nama_alternatif'],
                    'status' => 0
                ];
            }
        }
        $data['penilaian'] = $penilaian;
        view('layouts/_head');
        view('penilaian/index', $data);
        view('layouts/_foot');
    }

    public function tambah_penilaian($kode)
    {
        $data['alternatif'] = $this->_db->other_query("SELECT * FROM alternatif WHERE kode_alternatif = '$kode'");
        $data_kriteria = [];
        $kriteria = $this->_db->other_query("SELECT * FROM kriteria", 2);
        foreach($kriteria as $key => $row) {
            $opsi = $this->_db->other_query("SELECT * FROM opsi WHERE kode_kriteria = '$row[kode_kriteria]'", 2);
            $data_kriteria[] = [
                'kode_kriteria' => $row['kode_kriteria'],
                'nama_kriteria' => $row['nama_kriteria'],
                'opsi' => $opsi
            ];
        }
        $data['kriteria'] = $data_kriteria;
        view('layouts/_head');
        view('penilaian/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_penilaian()
    {
        $kode_pengguna = $_SESSION['nip'];
        $kode_alternatif = $_POST['kode_alternatif'];
        $kode_kriteria = $_POST['kode_kriteria'];
        $total = 0;
        $i = 1;
        foreach ($kode_kriteria as $row) :
            $data[] = [
                'kode_alternatif' => $kode_alternatif,
                'kode_kriteria' => $row,
                'nilai' => $_POST['jawaban_' . $i]
            ];
            $total += $_POST['jawaban_' . $i++];
        endforeach;
        foreach ($data as $value) {
            // insert to t_kuesioner
            $insert = $this->_db->insert("
                INSERT INTO penilaian (kode_pengguna, kode_alternatif, kode_kriteria, nilai)
                VALUES ('$kode_pengguna', '$value[kode_alternatif]', '$value[kode_kriteria]', '$value[nilai]')
            ");
        }

        $res['status'] = 1;
        $res['msg'] = "Penilaian berhasil ditambahkan";
        $res['page'] = "penilaian";

        echo json_encode($res);
    }
    public function ubah_penilaian($kode)
    {
        $kode_pengguna = $_SESSION['nip'];
        $data['alternatif'] = $this->_db->other_query("SELECT * FROM alternatif WHERE kode_alternatif = '$kode'");
        $penilaian = $this->_db->other_query("SELECT * FROM penilaian WHERE kode_pengguna = '$kode_pengguna' AND kode_alternatif = '$kode'", 2);
        $data_kriteria = [];
        $kriteria = $this->_db->other_query("SELECT * FROM kriteria", 2);
        foreach($kriteria as $key => $row) {
            $opsi = $this->_db->other_query("SELECT * FROM opsi WHERE kode_kriteria = '$row[kode_kriteria]'", 2);
            // cek opsi
            foreach ($opsi as $key_opsi => $value) {
                $opsi_penilaian = $this->_db->other_query("SELECT nilai FROM penilaian WHERE kode_pengguna = '$kode_pengguna' AND kode_alternatif = '$kode' AND kode_kriteria = '$row[kode_kriteria]'")->nilai;
                if($opsi_penilaian == $value['nilai']) {
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                $opsi[$key_opsi]['checked'] = $checked;
            }
            $data_kriteria[] = [
                'kode_kriteria' => $row['kode_kriteria'],
                'nama_kriteria' => $row['nama_kriteria'],
                'opsi' => $opsi
            ];
        }
        $data['kriteria'] = $data_kriteria;
        $data['penilaian'] = $penilaian;
        view('layouts/_head');
        view('penilaian/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_penilaian()
    {
        $kode_pengguna = $_SESSION['nip'];
        $kode_alternatif = $_POST['kode_alternatif'];
        $kode_kriteria = $_POST['kode_kriteria'];
        $total = 0;
        $i = 1;
        foreach ($kode_kriteria as $row) :
            $nilai = $_POST['jawaban_' . $i];
            $this->_db->edit("UPDATE penilaian SET nilai = '$nilai' WHERE kode_pengguna = '$kode_pengguna' AND kode_alternatif = '$kode_alternatif' AND kode_kriteria = '$row'");
            $total += $_POST['jawaban_' . $i++];
        endforeach;
       
        $res['status'] = 1;
        $res['msg'] = "penilaian berhasil diubah";
        $res['page'] = "penilaian";

        echo json_encode($res);
    }
}
