<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $month = date('Y-m');
        // $month = '2024-03';
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->db->query("SELECT COUNT(id_siswa) as jumlah FROM tbl_siswa WHERE is_active =1")->row_array();
        $data['spp'] = $this->db->query("SELECT SUM(nominal_transaksi) as jumlah FROM tbl_spp WHERE tanggal_transaksi LIKE '$month%'")->row_array();
        $data['tabungan'] = $this->db->query("SELECT SUM(nominal_transaksi) as jumlah FROM tbl_riwayat_tabungan WHERE tanggal_riwayat_transaksi LIKE '$month%' AND id_jenis_transaksi = 1")->row_array();
        $data['event'] = $this->db->query("SELECT SUM(nominal_transaksi) as jumlah FROM tbl_event WHERE tgl_transaksi LIKE '$month%'")->row_array();
        $spptabungan = $this->db->query("SELECT COUNT(nominal_transaksi) as jumlah FROM tbl_spp WHERE tanggal_transaksi LIKE '$month%' AND id_sumber_dana = 1")->row_array();
        $eventtabungan = $this->db->query("SELECT COUNT(nominal_transaksi) as jumlah FROM tbl_event WHERE tgl_transaksi LIKE '$month%' AND id_sumber_dana = 1")->row_array();
        $data['jumlahtransaksitabungan'] = $spptabungan['jumlah'] + $eventtabungan['jumlah'];
        $data['jumlahtransaksispptabungan'] = $spptabungan['jumlah'];
        $spptunai = $this->db->query("SELECT COUNT(nominal_transaksi) as jumlah FROM tbl_spp WHERE tanggal_transaksi LIKE '$month%' AND id_sumber_dana = 2")->row_array();
        $eventtunai = $this->db->query("SELECT COUNT(nominal_transaksi) as jumlah FROM tbl_event WHERE tgl_transaksi LIKE '$month%' AND id_sumber_dana = 2")->row_array();
        $data['jumlahtransaksispptunai'] = $spptunai['jumlah'];
        $data['jumlahtransaksitunai'] = $spptunai['jumlah'] + $eventtunai['jumlah'];
        $data['transaksispp'] = $this->db->query("SELECT tanggal_transaksi, SUM(nominal_transaksi) as jumlah FROM tbl_spp WHERE tanggal_transaksi LIKE '$month%' GROUP BY tanggal_transaksi;")->result_array();
        $data['transaksievent'] = $this->db->query("SELECT tgl_transaksi, SUM(nominal_transaksi) as jumlah FROM tbl_event WHERE tgl_transaksi LIKE '$month%' GROUP BY tgl_transaksi;")->result_array();
        $data['list_spp_belum_lunas'] = $this->db->query("SELECT *, SUM(nominal_transaksi) as jumlah FROM `tbl_spp` 
                            INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa
                            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                            WHERE status_spp = 'Belum Lunas' AND bulan_tagihan LIKE '$month%' 
                            GROUP BY tbl_spp.id_siswa
                            ORDER BY tbl_siswa.id_kelas ASC;")->result_array();

        $data['list_spp_lunas'] = $this->db->query("SELECT *, SUM(nominal_transaksi) as jumlah FROM `tbl_spp` 
                            INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa
                            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                            WHERE status_spp = 'Lunas' AND bulan_tagihan LIKE '$month%' 
                            GROUP BY tbl_spp.id_siswa
                            ORDER BY tbl_siswa.id_kelas ASC;")->result_array();
        $data['spp_nol'] = $this->db->query("SELECT * FROM `tbl_siswa` 
                            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                            WHERE is_active = 1 AND id_siswa NOT IN
                            (SELECT id_siswa FROM tbl_spp WHERE bulan_tagihan LIKE '$month%')")->result_array();
            
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function allusers()
    {
        $data['title'] = 'All Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['allusers'] = $this->db->query("SELECT * FROM user")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/allusers', $data);
        $this->load->view('templates/footer');
    }

    public function userManagement($id)
    {
        $this->form_validation->set_rules('role_id', 'Role ID', 'required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update User';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['userbyid'] = $this->db->query("SELECT * FROM user WHERE id=".intval($id))->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/updateactivation', $data);
            $this->load->view('templates/footer');
        }else{
            $role_id = $this->input->post('role_id');
            $this->db->query("UPDATE user SET role_id=$role_id WHERE id=".intval($id));
            redirect('admin/allusers');
        }
    }

}
