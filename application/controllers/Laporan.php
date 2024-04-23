<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Laporan extends CI_Controller
{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }
    
    // public function setor()
    // {
    // 	//here
    // 	$data['title'] = 'Laporan Setor';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('laporan/setor', $data);
    //     $this->load->view('templates/footer');

    // }

    // private function hasil_setor()
    // {
    // 	//here
    // 	$data['title'] = 'Transaksi Setor';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $date_start = htmlspecialchars($this->input->post('date_start', true));
    //     $date_finish = htmlspecialchars($this->input->post('date_finish', true));
    //     $data['hasil_setor'] = $this->db->query("SELECT * FROM tbl_riwayat_tabungan INNER JOIN tbl_jenis_transaksi ON tbl_jenis_transaksi.id_jenis_transaksi = tbl_riwayat_tabungan.id_jenis_transaksi INNER JOIN user ON user.id = tbl_riwayat_tabungan.id_user INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_riwayat_tabungan.id_siswa WHERE tanggal_riwayat_tabungan >= '$date_start' AND tanggal_riwayat_tabungan <= '$date_finish' ORDER BY id_riwayat_tabungan DESC")->result_array();
        
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('laporan/hasil_setor', $data);
    //     $this->load->view('templates/footer');

    // }

    public function tabungan()
    {
    	//here
    	$data['title'] = 'Laporan Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/tabungan', $data);
        $this->load->view('templates/footer');

    }

    public function hasil_transaksi()
    {
    	//here
    	$data['title'] = 'Laporan Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $date_start = htmlspecialchars($this->input->post('date_start', true));
        $date_finish = htmlspecialchars($this->input->post('date_finish', true));
        $data['date_start'] = htmlspecialchars($this->input->post('date_start', true));
        $data['date_finish'] = htmlspecialchars($this->input->post('date_finish', true));
        $jenis = htmlspecialchars($this->input->post('jenis', true));
        if ($jenis == 0) {
            $data['hasil_transaksi'] = $this->db->query("SELECT * FROM tbl_riwayat_tabungan INNER JOIN tbl_jenis_transaksi ON tbl_jenis_transaksi.id_jenis_transaksi = tbl_riwayat_tabungan.id_jenis_transaksi INNER JOIN user ON user.id = tbl_riwayat_tabungan.id_user INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_riwayat_tabungan.id_siswa WHERE tanggal_riwayat_transaksi >= '$date_start' AND tanggal_riwayat_transaksi <= '$date_finish' ORDER BY id_riwayat_transaksi DESC")->result_array();
        }else{
            $data['hasil_transaksi'] = $this->db->query("SELECT * FROM tbl_riwayat_tabungan INNER JOIN tbl_jenis_transaksi ON tbl_jenis_transaksi.id_jenis_transaksi = tbl_riwayat_tabungan.id_jenis_transaksi INNER JOIN user ON user.id = tbl_riwayat_tabungan.id_user INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_riwayat_tabungan.id_siswa WHERE tanggal_riwayat_transaksi >= '$date_start' AND tanggal_riwayat_transaksi <= '$date_finish' AND tbl_riwayat_tabungan.id_jenis_transaksi = $jenis ORDER BY id_riwayat_transaksi DESC")->result_array();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/hasil_transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function spp()
    {
    	//here
    	$data['title'] = 'Laporan SPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/spp', $data);
        $this->load->view('templates/footer');

    }

    public function hasil_spp()
    {
    	//here
    	$data['title'] = 'Laporan SPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $bulan_tagihan = htmlspecialchars($this->input->post('bulan_tagihan', true));
        $data['bulan_tagihan'] = htmlspecialchars($this->input->post('bulan_tagihan', true));
        $t = $bulan_tagihan."-00";

        $data['hasil_transaksi'] = $this->db->query("SELECT * FROM tbl_spp 
                                                INNER JOIN user ON user.id = tbl_spp.id_user 
                                                INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa 
                                                WHERE bulan_tagihan = '$t'")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/hasil_spp', $data);
        $this->load->view('templates/footer');
    }

    public function hasil_spp_status()
    {
    	//here
    	$data['title'] = 'Laporan SPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $bulan_tagihan = htmlspecialchars($this->input->post('bulan_tagihan', true));
        $data['bulan_tagihan'] = htmlspecialchars($this->input->post('bulan_tagihan', true));
        $t = $bulan_tagihan."-00";

        $data['hasil_transaksi'] = $this->db->query("SELECT *, SUM(nominal_transaksi) as jumlah FROM `tbl_spp` 
        INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa
        INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
        WHERE bulan_tagihan = '$t'
        GROUP BY bulan_tagihan, tbl_spp.id_siswa ORDER BY bulan_tagihan ASC;")->result_array();
        $data['siswa_kosong'] = $this->db->query("SELECT * FROM tbl_siswa 
            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
            WHERE id_siswa NOT IN (SELECT id_siswa FROM `tbl_spp` WHERE bulan_tagihan = '$t');")->result_array();
        $data['bulan_tagihan'] = $t;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/hasil_spp_status', $data);
        $this->load->view('templates/footer');
    }

    public function event()
    {
    	//here
    	$data['title'] = 'Laporan Event';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenis'] = $this->db->query("SELECT * FROM tbl_jenis_event")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/event', $data);
        $this->load->view('templates/footer');
    }

    public function hasil_event()
    {
    	//here
    	$data['title'] = 'Laporan Event';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_jenis_event = htmlspecialchars($this->input->post('id_jenis_event', true));

        if ($id_jenis_event == '0') {
            $data['hasil_transaksi'] = $this->db->query("SELECT * FROM tbl_event 
                                    INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_event.id_siswa 
                                    INNER JOIN user ON user.id = tbl_event.id_user 
                                    INNER JOIN tbl_jenis_event ON tbl_jenis_event.id_jenis_event = tbl_event.id_jenis_event")->result_array();
            $data['nama_jenis_event'] = "Semua";
        }else{
            $a = $this->db->query("SELECT * FROM tbl_jenis_event WHERE id_jenis_event = $id_jenis_event")->row_array();
            $data['nama_jenis_event'] = $a['nama_jenis_event'];
            $data['hasil_transaksi'] = $this->db->query("SELECT * FROM tbl_event 
                                    INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_event.id_siswa 
                                    INNER JOIN user ON user.id = tbl_event.id_user 
                                    INNER JOIN tbl_jenis_event ON tbl_jenis_event.id_jenis_event = tbl_event.id_jenis_event
                                    WHERE tbl_event.id_jenis_event = $id_jenis_event")->result_array();
            // $data['hasil_transaksi'] = $this->db->query("SELECT * FROM tbl_riwayat_tabungan INNER JOIN tbl_jenis_transaksi ON tbl_jenis_transaksi.id_jenis_transaksi = tbl_riwayat_tabungan.id_jenis_transaksi INNER JOIN user ON user.id = tbl_riwayat_tabungan.id_user INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_riwayat_tabungan.id_siswa WHERE tanggal_riwayat_transaksi >= '$date_start' AND tanggal_riwayat_transaksi <= '$date_finish' AND tbl_riwayat_tabungan.id_jenis_transaksi = $jenis ORDER BY id_riwayat_transaksi DESC")->result_array();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/hasil_event', $data);
        $this->load->view('templates/footer');
    }
    
    public function data_siswa()
    {
    	//here
    	$data['title'] = 'Laporan Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->db->query("SELECT * FROM tbl_siswa 
                                            INNER JOIN tbl_saldo ON tbl_saldo.id_siswa = tbl_siswa.id_siswa 
                                            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                                            WHERE tbl_siswa.is_active = 1 ORDER BY tbl_siswa.id_siswa DESC
                                            ")->result_array();
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
            $this->load->view('laporan/laporan_data_siswa', $data);
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
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambah siswa!</div>');
            redirect('master/data_siswa/');
        }

    }

    public function detail_siswax($id_siswa)
    {
    	//here
    	$data['title'] = 'Laporan Data Siswa';
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
        $this->load->view('laporan/detail_data_siswa', $data);
        $this->load->view('templates/footer');

    }

    public function laporan_keuangan()
    {
    	//here
    	$data['title'] = 'Laporan Keuangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporan_keuangan', $data);
        $this->load->view('templates/footer');

    }

    public function hasil_laporan_keuangan()
    {
    	//here
    	$data['title'] = 'Laporan Keuangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $date_start = htmlspecialchars($this->input->post('date_start', true));
        $date_finish = htmlspecialchars($this->input->post('date_finish', true));
        $data['date_start'] = htmlspecialchars($this->input->post('date_start', true));
        $data['date_finish'] = htmlspecialchars($this->input->post('date_finish', true));
        $data['rekap_keuangan_masuk'] = $this->db->query("SELECT *, (SELECT SUM(nominal_transaksi)) nominal_masuk FROM `tbl_riwayat_tabungan` WHERE tanggal_riwayat_transaksi >= '$date_start' AND tanggal_riwayat_transaksi <= '$date_finish' AND id_jenis_transaksi = 1")->row_array();
        $data['rekap_keuangan_keluar'] = $this->db->query("SELECT *, (SELECT SUM(nominal_transaksi)) nominal_keluar FROM `tbl_riwayat_tabungan` WHERE tanggal_riwayat_transaksi >= '$date_start' AND tanggal_riwayat_transaksi <= '$date_finish' AND id_jenis_transaksi = 2")->row_array();
        $data['sisa_saldo'] = $data['rekap_keuangan_masuk']['nominal_masuk'] - $data['rekap_keuangan_keluar']['nominal_keluar'];
        $data['rekap_all'] = $this->db->query("SELECT *, (SELECT SUM(nominal_transaksi)) nominal FROM `tbl_riwayat_tabungan` INNER JOIN tbl_jenis_transaksi ON tbl_jenis_transaksi.id_jenis_transaksi = tbl_riwayat_tabungan.id_jenis_transaksi WHERE tbl_riwayat_tabungan.tanggal_riwayat_transaksi >= '$date_start' AND tanggal_riwayat_transaksi <= '$date_finish' GROUP BY tbl_riwayat_tabungan.id_jenis_transaksi, tbl_riwayat_tabungan.tanggal_riwayat_transaksi ORDER BY tanggal_riwayat_transaksi ASC;")->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/hasil_laporan_keuangan', $data);
        $this->load->view('templates/footer');
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
        $this->load->view('laporan/detail_data_siswa', $data);
        $this->load->view('templates/footer');

    }

}