<?php

class Permintaan_model extends CI_Model {

private $table_name = 'kategori_permintaan';

function __construct() {
	parent::__construct();
}

function dpa_kategori($id_sub_unit)
{
	$this->db->select('a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, b.nama_kategori');
    $this->db->from('DPA_per_bulan a');
    $this->db->join('kategori_permintaan b', 'a.id_kategori = b.id_kategori');
    $this->db->where('a.status_validasi', 'belum');
    $this->db->where('a.id_sub_unit', $id_sub_unit);
    $this->db->order_by('a.bulan, a.tahun', 'DESC');
	return $this->db->get();
}
    
function all_kategori_permintaan($status)
{
    $this->db->select('*');
    $this->db->from('kategori_permintaan');
    $this->db->where('status_aktifasi', $status);
    return $this->db->get();
}
    
function simpan_dpa_baru($data)
{
    $this->db->insert('DPA_per_bulan', $data);
    return $this->db->insert_id();
}
    
function get_all_permintaan($id_DPA)
{
    $this->db->select('*');
    $this->db->from('permintaan');
    $this->db->where('id_DPA', $id_DPA);
    
    return $this->db->get();
}
    
    function get_dpa($id_DPA)
    {
        $this->db->select('a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, b.nama_kategori');
        $this->db->from('DPA_per_bulan a');
        $this->db->join('kategori_permintaan b', 'a.id_kategori = b.id_kategori');
        $this->db->where('a.id_DPA', $id_DPA);
        
        return $this->db->get();
    }

    function simpan_permintaan($data)
    {
        $this->db->insert('permintaan', $data);
        return $this->db->insert_id();
    }
    
    function get_sub_unit_ajukan()
    {
        $this->db->select('a.id_sub_unit, b.nama_sub_unit, a.bulan, a.tahun');
        $this->db->from('DPA_per_bulan a');
        $this->db->join('sub_unit b', 'a.id_sub_unit = b.id_sub_unit');
        $this->db->where('a.status_validasi', 'diajukan');
        $this->db->group_by('a.id_sub_unit, a.bulan, a.tahun');
        
        return $this->db->get();
    }
    
    function get_permintaan_asli($status_validasi)
    {
        $this->db->select('a.id_sub_unit, b.nama_sub_unit, a.bulan, a.tahun, a.status_validasi');
        $this->db->from('DPA_per_bulan a');
        $this->db->join('sub_unit b', 'a.id_sub_unit = b.id_sub_unit');
        
        if($_SESSION['level'] == '3')
        {
            $this->db->join('sub_unit c', 'c.id_sub_unit = a.id_sub_unit');
            $this->db->where('c.id_user', $_SESSION['id_user']);
        }
        
        if($status_validasi == 'diajukan_sudah' AND $_SESSION['level'] == '3')
        {
            $this->db->group_start();
             $this->db->where('a.status_validasi', 'sudah');
             $this->db->or_where('a.status_validasi', 'diajukan');
            $this->db->group_end();
        }
        else
        {
        $this->db->where('a.status_validasi', 'sudah');
        }
        $this->db->group_by('a.id_sub_unit, a.bulan, a.tahun');
        $this->db->order_by('a.bulan, a.tahun', 'DESC');
        
        return $this->db->get();
    }
    
    function get_kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_permintaan');
        
        return $this->db->get();
    }
    
    function simpan_kategori_baru($data)
    {
        $this->db->insert('kategori_permintaan', $data);
        return $this->db->insert_id();
    }
    
    function simpan_akun_baru($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
    
    function simpan_unit_baru($data)
    {
        $this->db->insert('sub_unit', $data);
        return $this->db->insert_id();
    }
    
    function get_akun_pengguna($username, $password, $level_pengguna)
    {
        if($level_pengguna == '1')
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $this->db->where('level', $level_pengguna);
        }
        else 
        {
            $this->db->select('a.username, a.nama_user, a.level as level_pengguna, a.password, a.id_user, b.id_sub_unit, b.nama_sub_unit, b.id_user, b.status_aktif, b.level as level_cabang');
            $this->db->from('user a');
            $this->db->join('sub_unit b', 'a.id_user = b.id_user');
            $this->db->where('a.username', $username);
            $this->db->where('a.password', $password);
            $this->db->where('a.level', $level_pengguna);
        }
        
        return $this->db->get();
    }
    
    function get_kategori_by_id($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('kategori_permintaan');
        $this->db->where('id_kategori', $id_kategori);
        
        return $this->db->get();
    }
    
    function get_all_akun()
    {
        $this->db->select('*');
        $this->db->from('user');
        
        return $this->db->get();
    }
    
    function get_all_kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_permintaan');
        
        return $this->db->get();
    }
    
    function get_dpa_bulan_ini()
    {
        $bulan = date('n');
        $tahun = date('Y');
        
        $this->db->select("SUM(DPA) AS jumlah");
        $this->db->from('DPA_per_bulan');
        $this->db->where('bulan', $bulan);
        $this->db->where('bulan', $tahun);
        
        return $this->db->get();
    }
    
    function get_akun_by_ids()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $_SESSION['id_user']);
        
        return $this->db->get();
    }
}
