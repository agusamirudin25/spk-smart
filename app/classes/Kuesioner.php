<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Kuesioner
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
        $data['kuesioner'] = $this->_db->other_query("SELECT * FROM v_kuesioner", 2);
        view('layouts/_head');
        view('kuesioner/index', $data);
        view('layouts/_foot');
    }

    public function tambah_kuesioner($kode)
    {
        $data['guru']       = $this->_db->other_query("SELECT * FROM t_guru WHERE kode_alternatif = '$kode'");
        $data['kompetensi'] = $this->_db->other_query("SELECT * FROM t_kompetensi", 2);
        $data['options'] = $this->_db->other_query("SELECT * FROM t_opsi", 2);
        view('layouts/_head');
        view('kuesioner/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_kuesioner()
    {
        $kode_alternatif = $_POST['kode_alternatif'];
        $kode_kompetensi = $_POST['kode_kompetensi'];
        $count = count($kode_kompetensi);
        $total = 0;
        $i = 1;
        foreach ($kode_kompetensi as $row) :
            $data[] = [
                'kode_alternatif' => $kode_alternatif,
                'kode_kompetensi' => $row,
                'nilai' => $_POST['jawaban_' . $i]
            ];
            $total += $_POST['jawaban_' . $i++];
        endforeach;
        foreach ($data as $value) {
            // insert to t_kuesioner
            $insert = $this->_db->insert("
                INSERT INTO t_kuesioner (kode_alternatif, kode_kompetensi, nilai)
                VALUES ('$value[kode_alternatif]', '$value[kode_kompetensi]', '$value[nilai]')
            ");
        }
        $cek = $this->_db->other_query("SELECT * FROM t_penilaian WHERE kode_alternatif = '$kode_alternatif' AND kode_kriteria = 'K2'");
        $avg = round((float) $total / $count, 2);
        if ($cek) {
            $update = $this->_db->edit("
                UPDATE t_penilaian SET nilai = '$avg' WHERE kode_alternatif = '$kode_alternatif' AND kode_kriteria = 'K2'
            ");
        } else {
            $insert = $this->_db->insert("
                INSERT INTO t_penilaian (kode_alternatif, kode_kriteria, nilai)
                VALUES ('$kode_alternatif', 'K2', '$avg')
            ");
        }

        $res['status'] = 1;
        $res['msg'] = "Data Kuesioner berhasil ditambahkan";
        $res['page'] = "Kuesioner";

        echo json_encode($res);
    }
    public function ubah_kuesioner($kode)
    {
        $data['guru']       = $this->_db->other_query("SELECT * FROM t_guru WHERE kode_alternatif = '$kode'");
        $data['kompetensi'] = $this->_db->other_query("SELECT * FROM v_kompetensi WHERE kode_alternatif = '$kode'", 2);
        $data['options'] = $this->_db->other_query("SELECT * FROM t_opsi", 2);
        view('layouts/_head');
        view('kuesioner/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_kuesioner()
    {
        $kode_alternatif = $_POST['kode_alternatif'];
        $kode_kompetensi = $_POST['kode_kompetensi'];
        $count = count($kode_kompetensi);
        $total = 0;
        $i = 1;
        foreach ($kode_kompetensi as $row) :
            $nilai = $_POST['jawaban_' . $i];
            $this->_db->edit("UPDATE t_kuesioner SET nilai = '$nilai' WHERE kode_alternatif = '$kode_alternatif' AND kode_kompetensi = '$row'");
            $total += $_POST['jawaban_' . $i++];
        endforeach;
       
        $cek = $this->_db->other_query("SELECT * FROM t_penilaian WHERE kode_alternatif = '$kode_alternatif' AND kode_kriteria = 'K2'");
        $avg = round((float) $total / $count, 2);
        if ($cek) {
            $update = $this->_db->edit("
                UPDATE t_penilaian SET nilai = '$avg' WHERE kode_alternatif = '$kode_alternatif' AND kode_kriteria = 'K2'
            ");
        } else {
            $insert = $this->_db->insert("
                INSERT INTO t_penilaian (kode_alternatif, kode_kriteria, nilai)
                VALUES ('$kode_alternatif', 'K2', '$avg')
            ");
        }

        $res['status'] = 1;
        $res['msg'] = "Data kuesioner berhasil diubah";
        $res['page'] = "kuesioner";

        echo json_encode($res);
    }
    public function hapus_kompetensi()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('t_kompetensi', 'kode_kompetensi', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "kompetensi";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
