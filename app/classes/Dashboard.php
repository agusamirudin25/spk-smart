<?php

namespace App\Classes;
header('Access-Control-Allow-Origin:*');


class Dashboard
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
        $title = 'Sistem Pendukung Keputusan Penilaian Kinerja Guru';
        $data['title'] = $title;
        $data['total_pengguna'] = $this->_db->other_query("SELECT COUNT(*) AS total FROM t_pengguna", 1)->total;
        $data['total_alternatif'] = $this->_db->other_query("SELECT COUNT(*) AS total FROM t_guru", 1)->total;
        $data['total_kriteria'] = $this->_db->other_query("SELECT COUNT(*) AS total FROM t_kriteria", 1)->total;
        view('layouts/_head');
        view('dashboard', $data);
        view('layouts/_foot');
    }
}
