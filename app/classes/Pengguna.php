<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Pengguna
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
        $data['pengguna'] = $this->_db->other_query("SELECT pengguna.kode_pengguna, pengguna.nama_lengkap, `role`.`role` FROM pengguna JOIN `role` ON pengguna.role = `role`.id", 2);
        view('layouts/_head');
        view('pengguna/index', $data);
        view('layouts/_foot');
    }

    public function tambah_pengguna()
    {
        $data['role'] = $this->_db->other_query('SELECT id, `role` FROM role', 2);
        view('layouts/_head');
        view('pengguna/tambah_data', $data);
        view('layouts/_foot');
    }
    public function proses_tambah_pengguna()
    {
        $input         = post();
        $kode_pengguna = $input['kode_pengguna'];
        $nama_lengkap  = $input['nama_lengkap'];
        $role          = $input['role'];
        $password      = password_hash($input['password'], PASSWORD_DEFAULT);
        $validasi_nip  = $this->_db->get("SELECT kode_pengguna FROM pengguna WHERE kode_pengguna = '$kode_pengguna'");

        if ($validasi_nip == NULL) {
            $insert = $this->_db->insert("INSERT INTO pengguna(kode_pengguna, nama_lengkap, `password`, `role`) values ('$kode_pengguna', '$nama_lengkap', '$password', '$role')");
            if ($insert) {
                $res['status'] = 1;
                $res['msg'] = "Data Pengguna berhasil ditambahkan";
                $res['page'] = "Pengguna";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data Pengguna gagal ditambahkan";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengguna gagal ditambahkan. NIP sudah digunakan";
        }

        echo json_encode($res);
    }
    public function ubah_pengguna($kode_pengguna)
    {
        $data['role'] = $this->_db->other_query('SELECT id, `role` FROM role', 2);
        $data['pengguna'] = $this->_db->other_query("SELECT * FROM pengguna WHERE kode_pengguna = '$kode_pengguna'");
        view('layouts/_head');
        view('pengguna/ubah_data', $data);
        view('layouts/_foot');
    }
    public function proses_ubah_pengguna()
    {
        $input         = post();
        $kode_pengguna = $input['kode_pengguna'];
        $nama_lengkap  = $input['nama_lengkap'];
        $role          = $input['role'];
        $password      = $input['password'];
        $password_hash = password_hash($input['password'], PASSWORD_DEFAULT);
        $validasi_nip  = $this->_db->get("SELECT kode_pengguna FROM pengguna WHERE kode_pengguna = '$kode_pengguna' AND kode_pengguna != '$kode_pengguna'");
        if($validasi_nip == NULL){
            if ($password == NULL || $password == '') {
                $update = $this->_db->edit("UPDATE pengguna SET nama_lengkap = '$nama_lengkap', `role` = '$role' WHERE kode_pengguna = '$kode_pengguna'");
            } else {
                $update = $this->_db->edit("UPDATE pengguna SET nama_lengkap = '$nama_lengkap', `role` = '$role', `password` = '$password_hash' WHERE kode_pengguna = '$kode_pengguna'");
            }
            if ($update) {
                $res['status'] = 1;
                $res['msg'] = "Data berhasil diubah";
                $res['page'] = "Pengguna";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data gagal diubah";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengguna gagal diubah. NIP sudah digunakan";
        }
        echo json_encode($res);
    }
    public function hapus_pengguna()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('pengguna', 'kode_pengguna', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "Pengguna";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
