<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Permintaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		#load library dan helper yang dibutuhkan
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','form'));
        $this->load->helper('download');
		$this->load->library('session');
        $this->load->library('upload');
        $this->load->library('pagination');
		$this->load->model('Permintaan_model','',TRUE);	
	}

		function index()
		{
            $data['total_akun'] = $this->Permintaan_model->get_all_akun()->num_rows();
            $data['total_kategori'] = $this->Permintaan_model->get_all_kategori()->num_rows();
            $data['permintaan_unvalidated'] = $this->Permintaan_model->get_sub_unit_ajukan()->num_rows();
            $data['DPA_bulan_ini'] = $this->Permintaan_model->get_dpa_bulan_ini()->result();
            

            $this->load->view('templates_permintaan/index', $data);
        }
        
        function manage_akun()
        {
            if($this->uri->segment(3) == 'sukses_mengupdate')
            {
                $data['message'] = 'Sukses Mengupdate Akun';
            }
           
            else {
                $data['message'] = '';
            }
            $data['data'] = $this->Permintaan_model->get_akun_by_ids()->result();
            $data['title'] = 'Manage Akun';
            
            $this->load->view('templates_permintaan/manage_akun', $data);
        }
        
        function update_manage_akun($id_user)
        {
            $nama_user = $this->input->post('nama_user');
            $username = $this->input->post('username');
            $password_baru = $this->input->post('password');
            $pass_baru = md5($password_baru);
            
            if($password_baru == ''){
            $data = array(
                'nama_user' => $nama_user,
                'username' => $username,
            );
            }else {
              $data = array(
                'nama_user' => $nama_user,
                'username' => $username,
                'password' => $pass_baru
            );  
            }
            $this->db->where('id_user', $id_user)->update('user', $data);
            
            redirect('Permintaan/manage_akun/sukses_mengupdate');
        }
        
        function buat_permintaan()
        {
            if($this->uri->segment(3) == 'sukses_menambahkan')
            {
                $data['message'] = 'Sukses Menambahkan Kategori Permintaan';
            }
            else if($this->uri->segment(3) == 'sukses_menghapus')
            {
                $data['message'] = 'Sukses Menghapus Kategori Permintaan';
            }
            else if($this->uri->segment(3) == 'sukses_mensubmit')
            {
                $data['message'] = 'Sukses Mensubmit Permintaan';
            }
            else {
                $data['message'] = '';
            }//GET id_sub_unit 
            $take_id_sub_unit = $this->db->where('id_user', $_SESSION['id_user'])
                ->get('sub_unit')
                ->row();
            
            $data['kategori'] = $this->Permintaan_model->dpa_kategori($take_id_sub_unit->id_sub_unit)->result();
            $data['all_kategori'] = $this->Permintaan_model->all_kategori_permintaan('on')->result();
            
            $this->load->view('templates_permintaan/kategori_permintaan', $data);
        }
        
        function tambah_kategori_permintaan()
        {
            $dpa_kategori = $this->input->post('dpa_kategori');
            $id_kategori_permintaan = $this->input->post('id_kategori_permintaan');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $id_user = $_SESSION['id_user'];
            
            //GET id_sub_unit 
            $take_id_sub_unit = $this->db->where('id_user', $id_user)
                ->get('sub_unit')
                ->row();
            
            foreach($dpa_kategori as $key => $dk)
            {
                //CEK SUDAH ADA ATAU BELUM DI TABEL DPA_per_bulan
                $cek = "SELECT * FROM DPA_per_bulan WHERE bulan = '$bulan' AND tahun = '$tahun' AND id_kategori = '$id_kategori_permintaan[$key]' AND id_sub_unit = (SELECT id_sub_unit FROM sub_unit WHERE id_user = '$id_user')";
                
                $cek_query = $this->db->query($cek)->num_rows();
                
                if($cek_query < 1)
                {
                    if($dk == '') { $dk = '0'; }
                    //INSERT
                    $data = array(
                        'id_sub_unit' => $take_id_sub_unit->id_sub_unit,
                        'DPA' => $dk,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'status_validasi' => 'belum',
                        'id_kategori' => $id_kategori_permintaan[$key]
                    
                    );
                    
                    $this->Permintaan_model->simpan_dpa_baru($data);
                }
            }
                 redirect('Permintaan/buat_permintaan/sukses_menambahkan');
        }
        
        function detail_permintaan($id_DPA, $message = NULL)
        {
            
            if($message == 'sukses_mengubah_nilai_DPA')
            {
                $data['message'] = "Sukses Mengubah Nilai DPA";
            }
            else if($message == 'sukses_menambahkan_detail_permintaan')
            {
                $data['message'] = "Sukses Menambahkan Detail Permintaan";
            }
            else if($message == 'sukses_menghapus_detail_permintaan')
            {
                $data['message'] = "Sukses Menghapus Detail Permintaan";
            }
            else
            {
                $data['message'] = '';
            }
            $data['permintaan'] = $this->Permintaan_model->get_all_permintaan($id_DPA)->result();
            $data['DPA'] = $this->Permintaan_model->get_dpa($id_DPA)->result();
            
            $this->load->view('templates_permintaan/detail_permintaan', $data);
        }
        
        function ubah_dpa($id_DPA)
        {
            $dpa = $this->input->post('dpa');
            
            $data = array(
                'DPA' => $dpa
            );
            
            $this->db->where('id_DPA', $id_DPA)->update('DPA_per_bulan', $data);
            
            redirect('Permintaan/detail_permintaan/'. $id_DPA. '/sukses_mengubah_nilai_DPA');die;
        }
        
        function tambah_permintaan($id_DPA)
        {
            $deskripsi = $this->input->post('deskripsi');
            $kuantitas = $this->input->post('kuantitas');
            $satuan = $this->input->post('satuan');
            $harga_satuan = $this->input->post('harga_satuan');
            $harga_total = $this->input->post('harga_total');
            
            $data = array(
                'permintaan' => $deskripsi,
                'kuantitas' => $kuantitas,
                'satuan' => $satuan,
                'harga_satuan' => $harga_satuan,
                'harga_total' => $harga_total,
                'id_DPA' => $id_DPA,
                'status_validasi' => 'belum',
                'tgl_permintaan' => date("Y-m-d")
            );
            
            var_dump($data);
            
            $this->Permintaan_model->simpan_permintaan($data);
            
            redirect('Permintaan/detail_permintaan/'. $id_DPA. '/sukses_menambahkan_detail_permintaan');
        }
        
        function hapus_permintaan($id_permintaan, $id_DPA)
        {
            $this->db->where('id_permintaan', $id_permintaan)->delete('permintaan');
            
            redirect('Permintaan/detail_permintaan/'. $id_DPA. '/sukses_menghapus_detail_permintaan');
        }
        
        function hapus_dpa_per_bulan($bulan, $tahun)
        {
              //GET id_sub_unit 
            $take_id_sub_unit = $this->db->where('id_user', $_SESSION['id_user'])
                ->get('sub_unit')
                ->row();
           
            $this->db->where('bulan', $bulan)->where('tahun', $tahun)->where('id_sub_unit', $take_id_sub_unit->id_sub_unit)->delete('DPA_per_bulan');
            
            redirect('Permintaan/buat_permintaan/sukses_menghapus');
        }
        
        function submit_permintaan($bulan, $tahun)
        {
               //GET id_sub_unit 
            $take_id_sub_unit = $this->db->where('id_user', $_SESSION['id_user'])
                ->get('sub_unit')
                ->row();
           
            $data = array(
                'status_validasi' => 'diajukan'
            );
            $this->db->where('bulan', $bulan)->where('tahun', $tahun)->where('id_sub_unit', $take_id_sub_unit->id_sub_unit)->update('DPA_per_bulan', $data);
            
            redirect('Permintaan/buat_permintaan/sukses_mensubmit');
        }
        
        function validasi_permintaan()
        {
            if($this->uri->segment(3) == 'sukses_memvalidasi')
            {
                $data['message'] = "Sukses Memvalidasi";
            }
            else if($this->uri->segment(3) == 'sukses_mengembalikan_laporan_permintaan')
            {
                $data['message'] = "Sukses Mengembalikan Laporan Permintaan Ke Sub Unit";
            }
            else
            {
                $data['message'] = '';
            }
            $data['data'] = $this->Permintaan_model->get_sub_unit_ajukan()->result();
            
            $this->load->view('templates_permintaan/validasi_permintaan', $data);
        }
        
        function edit_validasi_permintaan($id_sub_unit, $bulan, $tahun)
        {
            $data['message'] = ''; 
            
            $query = "Select a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, a.nama_kategori, b.id_permintaan, b.permintaan, b.tgl_permintaan, b.kuantitas, b.satuan, b.harga_satuan, b.harga_total, b.id_DPA, b.status_validasi FROM DPA_per_bulan_nama_kategori a LEFT JOIN permintaan b ON a.id_DPA = b.id_DPA AND a.status_validasi = 'diajukan' AND a.id_sub_unit = '$id_sub_unit' AND a.bulan = '$bulan' AND a.tahun = '$tahun' ORDER BY a.id_kategori ASC";

            $data['data'] = $this->db->query($query)->result();
            
            $queri = "Select a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, a.nama_kategori, b.id_permintaan, b.permintaan, b.tgl_permintaan, b.kuantitas, b.satuan, b.harga_satuan, b.harga_total, b.id_DPA, b.status_validasi FROM DPA_per_bulan_nama_kategori a LEFT JOIN permintaan b ON a.id_DPA = b.id_DPA AND a.status_validasi = 'diajukan' AND a.id_sub_unit = '$id_sub_unit' AND a.bulan = '$bulan' AND a.tahun = '$tahun' GROUP BY a.id_kategori ORDER BY a.id_kategori ASC";
            
             $data['kategori'] = $this->db->query($queri)->result();
            
            $data['id_sub_unit'] = $id_sub_unit;
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            
//            var_dump($data['data']);die;
            
            
            $this->load->view('templates_permintaan/edit_validasi_permintaan', $data);
        }
        
        function update_validasi_permintaan($id_sub_unit, $bulan, $tahun)
        {
            $tolak = $this->input->post('tolak');
            
            $data = array(
                'status_validasi' => 'sudah'
            );
            
            $this->db->where('id_sub_unit', $id_sub_unit)->where('bulan', $bulan)->where('tahun', $tahun)->update('DPA_per_bulan', $data);
            
             $datum = array(
                'status_validasi' => 'ditolak'
            );
        
            foreach($tolak as $key => $t)
            {
                var_dump($t);
                  $this->db->where('id_permintaan', $t)->update('permintaan', $datum);
            }
      
            redirect('Permintaan/validasi_permintaan/sukses_memvalidasi');
        }
        
        function permintaan_asli()
        {
            $data['data'] = $this->Permintaan_model->get_permintaan_asli('diajukan_sudah')->result();
            $data['title'] = 'Permintaan Asli';
            $data['status'] = 'asli';
            
            $this->load->view('templates_permintaan/permintaan_rekap', $data);
        }
        
        function detail_rekap_permintaan($status_validasi,$id_sub_unit, $bulan, $tahun, $checkout=null)
        {
            $sub_unit = $this->db->where('id_user', $_SESSION['id_user'])
                ->get('sub_unit')
                ->row();
            
            
            if($status_validasi == 'asli') {
            //GET DATA
             $query = "Select a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, a.nama_kategori, b.id_permintaan, b.permintaan, b.tgl_permintaan, b.kuantitas, b.satuan, b.harga_satuan, b.harga_total, b.id_DPA, b.status_validasi FROM DPA_per_bulan_nama_kategori a LEFT JOIN permintaan b ON a.id_DPA = b.id_DPA AND a.id_sub_unit = '$id_sub_unit' AND a.bulan = '$bulan' AND a.tahun = '$tahun' ORDER BY a.id_kategori ASC";

            $data['data'] = $this->db->query($query)->result();
            
            $queri = "Select a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, a.nama_kategori, b.id_permintaan, b.permintaan, b.tgl_permintaan, b.kuantitas, b.satuan, b.harga_satuan, b.harga_total, b.id_DPA, b.status_validasi FROM DPA_per_bulan_nama_kategori a LEFT JOIN permintaan b ON a.id_DPA = b.id_DPA AND a.status_validasi = 'sudah' AND a.id_sub_unit = '$id_sub_unit' AND a.bulan = '$bulan' AND a.tahun = '$tahun' GROUP BY a.id_kategori ORDER BY a.id_kategori ASC";
            
             $data['kategori'] = $this->db->query($queri)->result();
            }
            
            else {
                //GET DATA
             $query = "Select a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, a.nama_kategori, b.id_permintaan, b.permintaan, b.tgl_permintaan, b.kuantitas, b.satuan, b.harga_satuan, b.harga_total, b.id_DPA, b.status_validasi FROM DPA_per_bulan_nama_kategori a LEFT JOIN permintaan b ON a.id_DPA = b.id_DPA AND b.status_validasi = 'diterima' AND a.id_sub_unit = '$id_sub_unit' AND a.bulan = '$bulan' AND a.tahun = '$tahun' ORDER BY a.id_kategori ASC";

            $data['data'] = $this->db->query($query)->result();
            
            $queri = "Select a.id_DPA, a.id_sub_unit, a.DPA, a.bulan, a.tahun, a.status_validasi, a.id_kategori, a.nama_kategori, b.id_permintaan, b.permintaan, b.tgl_permintaan, b.kuantitas, b.satuan, b.harga_satuan, b.harga_total, b.id_DPA, b.status_validasi FROM DPA_per_bulan_nama_kategori a LEFT JOIN permintaan b ON a.id_DPA = b.id_DPA AND a.status_validasi = 'sudah' AND a.id_sub_unit = '$id_sub_unit' AND a.bulan = '$bulan' AND a.tahun = '$tahun' GROUP BY a.id_kategori ORDER BY a.id_kategori ASC";
            
             $data['kategori'] = $this->db->query($queri)->result();
                
            }
        
            $data['id_sub_unit'] = $id_sub_unit;
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['status'] = $status_validasi;
            
            if($checkout == 'print')
            {
               // Load all views as normal
		$this->load->view('templates_permintaan/print', $data);
		// Get output html
		$html = $this->output->get_output();
		
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("welcome.pdf");
            }
            else
            {
                $this->load->view('templates_permintaan/detail_rekap_permintaan', $data);
            }
        }
        
         function permintaan_divalidasi()
        {
            $data['data'] = $this->Permintaan_model->get_permintaan_asli('sudah')->result();
            $data['title'] = 'Permintaan Sudah Divalidasi';
            $data['status'] = 'diterima';
            
            $this->load->view('templates_permintaan/permintaan_rekap', $data);
        }
        
        function back_to_unit($id_sub_unit, $bulan, $tahun)
        {
            $data = array(
                'status_validasi' => 'belum'
            );
            
            $this->db->where('id_sub_unit', $id_sub_unit)->where('bulan', $bulan)->where('tahun', $tahun)->update('DPA_per_bulan', $data);
            
            redirect('Permintaan/validasi_permintaan/sukses_mengembalikan_laporan_permintaan');
        }
        
        function setting($jenis, $message = NULL)
        {
            if($message == 'sukses_menambahkan_kategori')
            {
                $data['message'] = 'Sukses Menambahkan Kategori Baru';
            }
            else if($message == 'sukses_menambahkan_user')
            {
                $data['message'] = "Sukses Menambahkan Pengguna Baru";
            }
            else if($message == 'sukses_menghapus_akun')
            {
                $data['message'] = "Sukses Menghapus Akun";
            }
            else if($message == 'sukses_menghapus_kategori')
            {
                $data['message'] = "Sukses Menghapus Kategori";
            }
             else if($message == 'sukses_mengupdate_kategori')
            {
                $data['message'] = "Sukses Mengupdate Kategori";
            }
            else
            {
                $data['message'] = '';
            }
            
            if($jenis == 'kategori') {
                $data['data'] = $this->Permintaan_model->get_kategori()->result();
                
                $data['title'] = 'Kategori DPA';
                $data['jenis'] = $jenis;
            }
            else {
                $query = "SELECT a.username, a.nama_user, a.level as level_pengguna, a.password, a.id_user, b.id_sub_unit, b.nama_sub_unit, b.id_user, b.status_aktif, b.level as level_cabang FROM user a LEFT JOIN sub_unit b ON a.id_user = b.id_user";
                
                $data['data'] = $this->db->query($query)->result();
                $data['title'] = 'Akun Pengguna';
                $data['jenis'] = $jenis;
            }
            
            
            $this->load->view('templates_permintaan/setting', $data);
        }
        
        function tambah_kategori()
        {
            $nama_kategori = $this->input->post('nama_kategori');
            
            $data = array(
                'nama_kategori' => $nama_kategori,
                'status_aktifasi' => 'on',
                'tgl_pembuatan' => date('Y-m-d')
            );
            
            $this->Permintaan_model->simpan_kategori_baru($data);
            
            redirect('Permintaan/setting/kategori/sukses_menambahkan_kategori');
        }
        
        function tambah_user()
        {
            $nama_user = $this->input->post('nama_user');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $pass = md5($password);
            $level_user = $this->input->post('level_user');
            $level_cabang = $this->input->post('level_cabang');
            $nama_sub_unit = $nama_user;
            
//            var_dump($nama_user, $username, $password, $pass, $level_user, $level_cabang, $nama_sub_unit);die;
            
            $data = array(
                'username' => $username,
                'password' => $pass,
                'nama_user' => $nama_user,
                'level' => $level_user
            );
            
            //SIMPAN DATA
            $this->Permintaan_model->simpan_akun_baru($data);
            
            //TARIK ID BARU BASED ON usernanem, password, nama_user, level
            $id_baru = $this->db->where('username', $username)
                ->where('password', $pass)
                ->where('level', $level_user)
                ->get('user')
                ->row();
            
            //SIMPAN DATA TO sub_unit
            $datum = array(
                'nama_sub_unit' => $nama_sub_unit,
                'id_user' => $id_baru->id_user,
                'status_aktif' => 'on',
                'level' => $level_cabang
            );
           
            $this->Permintaan_model->simpan_unit_baru($datum);
            
            redirect('Permintaan/setting/user/sukses_menambahkan_user');
        }
        
        function edit_akun($username, $password, $level_pengguna, $message = NULL)
        {
            if($message == 'sukses_mengupdate_akun')
            {
                $data['message'] = 'Sukses Mengupdate Akun';
            }
            else
            {
                $data['message'] = '';
            }
            $data['title'] = "Edit Akun";
            $data['level_pengguna'] = $level_pengguna;
            
            $data['data'] = $this->Permintaan_model->get_akun_pengguna($username, $password, $level_pengguna)->result();    
            
            $this->load->view('templates_permintaan/edit_akun', $data);
        }
        
        function update_akun($id_user, $username, $password, $level_pengguna)
        {
            $nama_user_baru = $this->input->post('nama_user');
            $username_baru = $this->input->post('username');
            $password_baru = $this->input->post('password');
            $pass_baru = md5($password_baru);
            $level_user_baru = $this->input->post('level_pengguna');
            $level_cabang_baru = $this->input->post('level_cabang');
            
          
            if($password_baru != '')
            {
                if($level_pengguna == '1') {
                $data = array(
                    'nama_user' => $nama_user,
                    'username' => $username_baru,
                    'password' => $pass_baru
                );
                    
                    $this->db->where('id_user', $id_user)->update('user', $data);
                }
                else {
                    $data = array(
                    'nama_user' => $nama_user_baru,
                    'username' => $username_baru,
                    'password' => $pass_baru,
                    'level' => $level_user_baru
                );
                    
                    $this->db->where('id_user', $id_user)->update('user', $data);
                    
                    
                    $datum = array(
                        'nama_sub_unit' => $nama_user_baru,
                        'level' => $level_cabang_baru
                    );
                    
                     $this->db->where('id_user', $id_user)->update('sub_unit', $datum);
                }
                
                redirect('Permintaan/edit_akun/'. $username_baru.'/'. $pass_baru .'/'. $level_user_baru.'/sukses_mengupdate_akun');
            }
            else {
                
                if($level_pengguna == '1') {
                $data = array(
                    'nama_user' => $nama_user_baru,
                    'username' => $username_baru
                    
                );
                    
                    $this->db->where('id_user', $id_user)->update('user', $data);
                }
                else {
                    $data = array(
                    'nama_user' => $nama_user_baru,
                    'username' => $username_baru,
                    'level' => $level_user_baru
                );
                    
                    $this->db->where('id_user', $id_user)->update('user', $data);
                    
                    
                    $datum = array(
                        'nama_sub_unit' => $nama_user_baru,
                        'level' => $level_cabang_baru
                    );
                    
                     $this->db->where('id_user', $id_user)->update('sub_unit', $datum);
                }
                
                redirect('Permintaan/edit_akun/'. $username_baru.'/'. $password .'/'. $level_user_baru.'/sukses_mengupdate_akun');
            }
        
        }
        
        function delete_akun($username, $password, $level_pengguna)
        {
            $this->db->where('username', $username)->where('password', $password)->where('level', $level_pengguna)->delete('user');
            
            redirect('Permintaan/setting/akun/sukses_menghapus_akun');
        }
        
        function delete_kategori($id_kategori)
        {
            $this->db->where('id_kategori', $id_kategori)->delete('kategori_permintaan');
            
            redirect('Permintaan/setting/kategori/sukses_menghapus_kategori');
        }
        
        function edit_kategori($id_kategori)
        {
            $data['data'] = $this->Permintaan_model->get_kategori_by_id($id_kategori)->result();
            $data['title'] = 'Edit Kategori';
            
            $this->load->view('templates_permintaan/edit_kategori', $data);
        }
        
        function update_kategori($id_kategori)
        {
            $nama_kategori = $this->input->post('nama_kategori');
            $biaya = $this->input->post('biaya');
            
            $data = array(
                'nama_kategori' => $nama_kategori,
                'biaya' => $biaya
            );
            
            $this->db->where('id_kategori', $id_kategori)->update('kategori_permintaan', $data);
            
            redirect('Permintaan/setting/kategori/sukses_mengupdate_kategori');
        }
}