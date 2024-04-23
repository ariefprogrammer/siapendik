<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Master extends CI_Controller
{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function data_pengguna()
    {
    	//here
    	$data['title'] = 'Data Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengguna'] = $this->db->query("SELECT user.id, user.name, user.email, role FROM user INNER JOIN user_role ON user_role.id=user.role_id")->result_array();
        $data['role'] = $this->db->query("SELECT * FROM user_role")->result_array();
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_pengguna', $data);
            $this->load->view('templates/footer');
        }else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => htmlspecialchars($this->input->post('role_id', true)),
                'is_active' => 1,
                'date_created' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', 'Berhasil menambah pengguna!');
            redirect('master/data_pengguna/');
        }

    }
    public function update_data_pengguna($id_pengguna)
    {        
        $data['title'] = 'Data Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengguna'] = $this->db->query("SELECT user.id, user.name, user.email, role FROM user INNER JOIN user_role ON user_role.id=user.role_id")->result_array();
        $data['role'] = $this->db->query("SELECT * FROM user_role")->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_pengguna', $data);
            $this->load->view('templates/footer');
        }else {
            $email = $this->input->post('email', true);
            $dataa = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'role_id' => htmlspecialchars($this->input->post('role_id', true)),
                'is_active' => 1,
            ];

            $this->db->where('id', $id_pengguna);
            $this->db->update('user', $dataa);

            $this->session->set_flashdata('message', 'Berhasil merubah pengguna!');
            redirect('master/data_pengguna/');
        }

    }
    
    public function delete_pengguna($id)
    {
        //here
        $id_pengguna = htmlspecialchars($id);
        $this->db->query("DELETE FROM user WHERE id = $id_pengguna");
        $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        redirect('master/data_pengguna/');
    }
    
    public function data_siswa()
    {
    	//here
    	$data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->db->query("SELECT * FROM tbl_siswa 
            INNER JOIN tbl_saldo ON tbl_saldo.id_siswa = tbl_siswa.id_siswa 
            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
            WHERE is_active = 1 ORDER BY tbl_siswa.id_siswa DESC")->result_array();
        $data['kelas'] = $this->db->query("SELECT * FROM tbl_kelas")->result_array();
        $last_id = $this->db->query("SELECT id_siswa FROM tbl_siswa ORDER BY id_siswa DESC LIMIT 1")->row_array();
        if (isset($last_id)) {
            $id_new = $last_id['id_siswa']+1;
        }else {
            $id_new = 1;
        }
        
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('no_whatsapp', 'Telp Siswa', 'required');
        $this->form_validation->set_rules('nama_wali', 'Wali', 'required');
        $this->form_validation->set_rules('wa_wali', 'Telp Wali', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_siswa', $data);
            $this->load->view('templates/footer');
        }else {
            $data = [
                'id_siswa' => $id_new,
                'nisn' => htmlspecialchars($this->input->post('nisn', true)),
                'nama_siswa' => htmlspecialchars($this->input->post('nama_siswa', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)),
                'no_whatsapp' => htmlspecialchars($this->input->post('no_whatsapp', true)),
                'nama_wali' => htmlspecialchars($this->input->post('nama_wali', true)),
                'wa_wali' => htmlspecialchars($this->input->post('wa_wali', true)),
                'is_active' => 1,
            ];
            $this->db->insert('tbl_siswa', $data);
            $this->db->query("INSERT INTO tbl_saldo VALUES(NULL, $id_new, 0)");
            $this->session->set_flashdata('message', 'Berhasil menambah siswa!');
            redirect('master/data_siswa/');
        }

    }

    public function update_data_siswa($id)
    {
    	//here        
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('no_whatsapp', 'Telp Siswa', 'required');
        $this->form_validation->set_rules('nama_wali', 'Wali', 'required');
        $this->form_validation->set_rules('wa_wali', 'Telp Wali', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_siswa', $data);
            $this->load->view('templates/footer');
        }else {
            $nisn = htmlspecialchars($this->input->post('nisn', true));
            $nama_siswa = htmlspecialchars($this->input->post('nama_siswa', true));
            $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
            $id_kelas = htmlspecialchars($this->input->post('id_kelas', true));
            $no_whatsapp = htmlspecialchars($this->input->post('no_whatsapp', true));
            $nama_wali = htmlspecialchars($this->input->post('nama_wali', true));
            $wa_wali = htmlspecialchars($this->input->post('wa_wali', true));
            
            $this->db->query("UPDATE tbl_siswa SET nisn=$nisn, nama_siswa = '$nama_siswa', jenis_kelamin  = '$jenis_kelamin', id_kelas = $id_kelas, no_whatsapp = '$no_whatsapp', nama_wali = '$nama_wali', wa_wali = '$wa_wali' WHERE id_siswa = $id ");
            $this->session->set_flashdata('message', 'Berhasil merubah siswa!');
            redirect('master/data_siswa/');
        }

    }

    public function delete_siswa($id)
    {
        //here
        $id_siswa = htmlspecialchars($id);
        $this->db->query("UPDATE tbl_siswa SET is_active = 0 WHERE id_siswa = $id_siswa");
        $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        redirect('master/data_siswa/');
    }

    public function data_kelas()
    {
    	//here
    	$data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->db->query("SELECT * FROM tbl_kelas")->result_array();
        
        $this->form_validation->set_rules('kelas', 'Nama Kelas', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_kelas', $data);
            $this->load->view('templates/footer');
        }else {
            $data = [
                'id_kelas' => NULL,
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
                'nominal_spp' => htmlspecialchars($this->input->post('nominal_spp', true)),
            ];
            $this->db->insert('tbl_kelas', $data);
            $this->session->set_flashdata('message', 'Berhasil menambah kelas!');
            redirect('master/data_kelas/');
        }

    }

    public function update_data_kelas($id_kelas)
    {
    	//here
    	$data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->db->query("SELECT * FROM tbl_kelas")->result_array();
        
        $this->form_validation->set_rules('kelas', 'Nama Kelas', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_kelas', $data);
            $this->load->view('templates/footer');
        }else {
            $data = [
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
                'nominal_spp' => htmlspecialchars($this->input->post('nominal_spp', true)),
            ];
            $this->db->where('id_kelas', $id_kelas);
            $this->db->update('tbl_kelas', $data);
            $this->session->set_flashdata('message', 'Berhasil merubah kelas!');
            redirect('master/data_kelas/');
        }

    }

    public function delete_kelas($id)
    {
        //here
        $id_kelas = htmlspecialchars($id);
        $this->db->query("DELETE FROM tbl_kelas WHERE id_kelas = $id_kelas");
        $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        redirect('master/data_kelas/');
    }

    public function data_event()
    {
    	//here
    	$data['title'] = 'Data Event';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['event'] = $this->db->query("SELECT * FROM tbl_jenis_event")->result_array();
        
        $this->form_validation->set_rules('nama_jenis_event', 'Nama Event', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_event', $data);
            $this->load->view('templates/footer');
        }else {
            $data = [
                'id_jenis_event' => NULL,
                'nama_jenis_event' => htmlspecialchars($this->input->post('nama_jenis_event', true)),
                'is_active' => 1,
                'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            ];
            $this->db->insert('tbl_jenis_event', $data);
            $this->session->set_flashdata('message', 'Berhasil menambah event!');
            redirect('master/data_event/');
        }

    }

    public function update_data_event($id_jenis_event)
    {
    	//here
    	$data['title'] = 'Data Event';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('nama_jenis_event', 'Nama Event', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_event', $data);
            $this->load->view('templates/footer');
        }else {
            $data = [
                'nama_jenis_event' => htmlspecialchars($this->input->post('nama_jenis_event', true)),
                'is_active' => htmlspecialchars($this->input->post('is_active', true)),
                'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            ];
            $this->db->where('id_jenis_event', $id_jenis_event);
            $this->db->update('tbl_jenis_event', $data);
            $this->session->set_flashdata('message', 'Berhasil merubah event!');
            redirect('master/data_event/');
        }

    }

    public function delete_event($id)
    {
        //here
        $id = htmlspecialchars($id);
        $this->db->query("DELETE FROM tbl_jenis_event WHERE id_jenis_event = $id");
        $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        redirect('master/data_event/');
    }

    public function buatdata()
    {
    	//here
    	$data['title'] = 'Buat data pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['event'] = $this->db->query("SELECT * FROM tbl_jenis_event")->result_array();
        $data['kelas'] = $this->db->query("SELECT * FROM tbl_kelas")->result_array();
        
        $this->form_validation->set_rules('bulan_tagihan', 'Bulan tagihan', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/data_pembayaran', $data);
            $this->load->view('templates/footer');
        }else {
            $id_kelas = $this->input->post('id_kelas', true);
            $data = [
                'bulan_tagihan' => htmlspecialchars($this->input->post('bulan_tagihan', true)),
                'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)),
                'siswa' => $this->db->query("SELECT * FROM tbl_siswa WHERE id_kelas = $id_kelas")->result_array(),
            ];
            $i = 0;
            foreach ($data as $key => $value) {
                $id_transaksi = 'SPP'.date('YmdHis').$i;
                $id_siswa = $data['siswa'][$i]['id_siswa'];
                $nominal_transaksi = 0;
                $userdata = $this->session->userdata();
                $id_user = $userdata['id'];
                $bulan_tagihan = $data['bulan_tagihan']."-00";
                $status_spp = 'Belum lunas';
                $this->db->query("INSERT INTO tbl_spp SET id_spp = '$id_transaksi', 
                                id_siswa = $id_siswa, bulan_tagihan = '$bulan_tagihan', 
                                status_spp = '$status_spp'");

                // echo $data['bulan_tagihan'];
                // echo '<br>';
                // echo $data['siswa'][$i]['nama_siswa'];
                // echo '<br>';
                $i=$i+1;
            }
            // $this->db->insert('tbl_jenis_event', $data);
            $this->session->set_flashdata('message', 'Berhasil membuat data pembayaran!');
            redirect('master/buatdata/');
        }

    }

    public function detail_siswa($id_siswa)
    {
    	//here
    	$data['title'] = 'Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->db->query("SELECT * FROM tbl_siswa 
                                            INNER JOIN tbl_saldo ON tbl_saldo.id_siswa = tbl_siswa.id_siswa 
                                            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                                            WHERE tbl_siswa.is_active = 1 AND tbl_siswa.id_siswa = $id_siswa
                                            ")->row_array();
        $data['kelas'] = $this->db->query("SELECT * FROM tbl_kelas")->result_array();
        $data['tabungan'] = $this->db->query("SELECT * FROM tbl_riwayat_tabungan 
                                                INNER JOIN user ON user.id = tbl_riwayat_tabungan.id_user
                                                WHERE tbl_riwayat_tabungan.id_siswa=$id_siswa 
                                                ORDER BY id_riwayat_transaksi DESC")->result_array();
        $data['spp'] = $this->db->query("SELECT * FROM tbl_spp
                                                INNER JOIN user ON user.id = tbl_spp.id_user
                                                WHERE tbl_spp.id_siswa = $id_siswa
                                                ORDER BY id_spp DESC
                                            ")->result_array();
            $data['rincianspp'] = $this->db->query("SELECT *, SUM(nominal_transaksi) as terbayar FROM `tbl_spp` 
                                                INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa 
                                                INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                                                WHERE tbl_spp.id_siswa = $id_siswa GROUP BY bulan_tagihan;")->result_array();
        $data['generalspp'] = $this->db->query("SELECT * FROM `tbl_spp` 
                                            WHERE id_siswa = $id_siswa
                                            GROUP BY bulan_tagihan")->result_array();
        $data['event'] = $this->db->query("SELECT * FROM tbl_event
                                            INNER JOIN user ON user.id = tbl_event.id_user
                                            INNER JOIN tbl_jenis_event ON tbl_event.id_jenis_event = tbl_jenis_event.id_jenis_event
                                            WHERE tbl_event.id_siswa = $id_siswa
                                            ORDER BY id_event DESC
                                        ")->result_array();
            $data['rincianevent'] = $this->db->query("SELECT *, SUM(nominal_transaksi) as jumlah FROM `tbl_event` 
                                            INNER JOIN tbl_jenis_event ON tbl_jenis_event.id_jenis_event = tbl_event.id_jenis_event
                                            WHERE id_siswa = 4 GROUP BY tbl_event.id_jenis_event;")->result_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/detail_data_siswa', $data);
        $this->load->view('templates/footer');

    }

}