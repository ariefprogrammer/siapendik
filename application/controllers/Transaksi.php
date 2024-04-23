<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Transaksi extends CI_Controller
{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }
    
    public function tabungan()
    {
    	//here
    	$data['title'] = 'Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenist'] = $this->db->query("SELECT * FROM tbl_jenis_transaksi")->result_array();
        $data['riwayat'] = $this->db->query("SELECT * FROM tbl_riwayat_tabungan INNER JOIN tbl_jenis_transaksi ON tbl_jenis_transaksi.id_jenis_transaksi = tbl_riwayat_tabungan.id_jenis_transaksi INNER JOIN user ON user.id = tbl_riwayat_tabungan.id_user INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_riwayat_tabungan.id_siswa ORDER BY id_riwayat_transaksi DESC")->result_array();
        // $data['siswa'] = $this->db->query("SELECT *, (SELECT saldo FROM tbl_saldo WHERE id_siswa=tbl_siswa.id_siswa) as saldo FROM tbl_siswa ORDER BY id_siswa DESC")->result_array();
        $data['siswa'] = $this->db->query("SELECT * FROM tbl_siswa INNER JOIN tbl_saldo ON tbl_saldo.id_siswa = tbl_siswa.id_siswa ORDER BY tbl_siswa.id_siswa DESC")->result_array();
        $userdata = $this->session->userdata();
        $id_transaksi = 'TB'.date('YmdHis');
        
        $this->form_validation->set_rules('id_siswa', 'Pilih Siswa', 'required');
        $this->form_validation->set_rules('nominal_transaksi', 'Nominal Transaksi', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/tabungan', $data);
            $this->load->view('templates/footer');
        }else {
            $id_siswa = $this->input->post('id_siswa');
            $saldo_awal = $this->db->query("SELECT * FROM tbl_saldo WHERE id_siswa=$id_siswa")->row_array();
            $fix_saldo_awal = $saldo_awal['saldo'];
            $nominal = $this->input->post('nominal_transaksi', true);
            if ($this->input->post('id_jenis_transaksi') == 1) {
                $fix_saldo_akhir = $fix_saldo_awal + $nominal;
                $data = [
                    'id_riwayat_transaksi' => $id_transaksi,
                    'tanggal_riwayat_transaksi' => date('Y-m-d'),
                    'id_siswa' => htmlspecialchars($this->input->post('id_siswa', true)),
                    'id_jenis_transaksi' => htmlspecialchars($this->input->post('id_jenis_transaksi', true)),
                    'nominal_transaksi' => htmlspecialchars($this->input->post('nominal_transaksi', true)),
                    'saldo_awal' => $fix_saldo_awal,
                    'saldo_akhir' => $fix_saldo_akhir,
                    'id_user' => $userdata['id'],
                ];
                $this->db->insert('tbl_riwayat_tabungan', $data);
                $this->db->query("UPDATE tbl_saldo SET saldo=$fix_saldo_akhir WHERE id_siswa = $id_siswa");
                $this->session->set_flashdata('message', 'Berhasil melakukan transaksi!');
                redirect('transaksi/confirmtabungan/'.$id_transaksi);
            }else {
                if ($nominal <= $fix_saldo_awal) {
                    $fix_saldo_akhir = $fix_saldo_awal - $nominal;
                    $data = [
                        'id_riwayat_transaksi' => $id_transaksi,
                        'tanggal_riwayat_transaksi' => date('Y-m-d'),
                        'id_siswa' => htmlspecialchars($this->input->post('id_siswa', true)),
                        'id_jenis_transaksi' => htmlspecialchars($this->input->post('id_jenis_transaksi', true)),
                        'nominal_transaksi' => htmlspecialchars($this->input->post('nominal_transaksi', true)),
                        'saldo_awal' => $fix_saldo_awal,
                        'saldo_akhir' => $fix_saldo_akhir,
                        'id_user' => $userdata['id'],
                    ];
                    $this->db->insert('tbl_riwayat_tabungan', $data);
                    $this->db->query("UPDATE tbl_saldo SET saldo=$fix_saldo_akhir WHERE id_siswa = $id_siswa");
                    $this->session->set_flashdata('message', 'Berhasil melakukan transaksi!');
                    redirect('transaksi/confirmtabungan/'.$id_transaksi);
                }else{
                    $this->session->set_flashdata('message', 'Saldo tidak cukup!');
                    redirect('transaksi/tabungan/');
                }
                
            }
            
        }

    }

    public function siswa()
    {
    	//here
    	$data['title'] = 'Siswa';
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
            $this->load->view('transaksi/data_siswa', $data);
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
                                            WHERE id_siswa = $id_siswa GROUP BY tbl_event.id_jenis_event;")->result_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/detail_data_siswa', $data);
        $this->load->view('templates/footer');

    }

    public function spp()
    {
    	//here
    	$data['title'] = 'Pembayaran SPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['riwayat'] = $this->db->query("SELECT * FROM tbl_spp INNER JOIN user ON user.id = tbl_spp.id_user INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa")->result_array();        
        $data['siswa'] = $this->db->query("SELECT * FROM tbl_siswa INNER JOIN tbl_saldo ON tbl_saldo.id_siswa = tbl_siswa.id_siswa ORDER BY tbl_siswa.id_siswa DESC")->result_array();
        $userdata = $this->session->userdata();
        $id_transaksi = 'SPP'.date('YmdHis');
        
        $this->form_validation->set_rules('id_siswa', 'Pilih Siswa', 'required');
        $this->form_validation->set_rules('id_sumber_dana', 'Sumber Dana', 'required');
        $this->form_validation->set_rules('nominal_transaksi', 'Nominal Transaksi', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/spp', $data);
            $this->load->view('templates/footer');
        }else {
            $id_siswa = htmlspecialchars($this->input->post('id_siswa', true));
            $id_sumber_dana = htmlspecialchars($this->input->post('id_sumber_dana', true));
            $nominal_transaksi = htmlspecialchars($this->input->post('nominal_transaksi', true));
            $bulan_tagihan = htmlspecialchars($this->input->post('bulan_tagihan', true));

            $total_bayar = $this->db->query("SELECT SUM(nominal_transaksi) as total FROM `tbl_spp` WHERE id_siswa='$id_siswa' AND bulan_tagihan LIKE '$bulan_tagihan%';")->row_array();
            $total_tagihan = $this->db->query("SELECT nominal_spp FROM tbl_siswa 
                                                INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                                                WHERE tbl_siswa.id_siswa = $id_siswa")->row_array();
            $totals = $total_tagihan['nominal_spp'];
            $total_bayarr = $total_bayar['total'] + $nominal_transaksi; 
            if ($total_bayarr >= $totals) {
                $status_spp = 'Lunas';
            }else{
                $status_spp = 'Belum Lunas';
            }

            if ($id_sumber_dana == 1) {
                $saldo_siswa = $this->db->query("SELECT * FROM tbl_saldo WHERE id_siswa=$id_siswa")->row_array();
                $saldo_fix = $saldo_siswa['saldo'];
                
                if ($saldo_fix >= $nominal_transaksi) {
                    $data = [
                        'id_spp' => $id_transaksi,
                        'tanggal_transaksi' => date('Y-m-d'),
                        'jam_transaksi' => date('H:i:s'),
                        'id_siswa' => $id_siswa,
                        'id_sumber_dana' => $id_sumber_dana,
                        'nominal_transaksi' => $nominal_transaksi,
                        'id_user' => $userdata['id'],
                        'bulan_tagihan' => "$bulan_tagihan"."-00",
                        'status_spp' => $status_spp,
                    ];
                    $this->db->insert('tbl_spp', $data);
                    $saldo_akhir = $saldo_fix - $nominal_transaksi;
                    $this->db->query("UPDATE tbl_saldo SET saldo=$saldo_akhir WHERE id_siswa=$id_siswa");
                    $this->db->query("UPDATE tbl_spp SET status_spp='$status_spp' WHERE id_siswa=$id_siswa AND bulan_tagihan LIKE '$bulan_tagihan%' ");
                    $this->session->set_flashdata('message', 'Berhasil membayar SPP dari tabungan!');
                    redirect('transaksi/confirmspp/'.$id_transaksi.'/'.$id_siswa);
                }elseif ($saldo_fix < $nominal_transaksi) {
                    $this->session->set_flashdata('message', 'Gagal membayar spp, Saldo tidak cukup!!!');
                    redirect('transaksi/spp/');
                }
                
            }else{
                $data = [
                        'id_spp' => $id_transaksi,
                        'tanggal_transaksi' => date('Y-m-d'),
                        'jam_transaksi' => date('H:i:s'),
                        'id_siswa' => $id_siswa,
                        'id_sumber_dana' => $id_sumber_dana,
                        'nominal_transaksi' => $nominal_transaksi,
                        'id_user' => $userdata['id'],
                        'bulan_tagihan' => "$bulan_tagihan"."-00",
                        'status_spp' => $status_spp,
                    ];
                    $this->db->insert('tbl_spp', $data);
                    $this->db->query("UPDATE tbl_spp SET status_spp='$status_spp' WHERE id_siswa=$id_siswa AND bulan_tagihan LIKE '$bulan_tagihan%' ");
                    $this->session->set_flashdata('message', 'Berhasil membayar SPP secara Tunai');
                    redirect('transaksi/confirmspp/'.$id_transaksi.'/'.$id_siswa);
            }
        }

    }

    public function event()
    {
    	//here
    	$data['title'] = 'Pembayaran Event';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['riwayat'] = $this->db->query("SELECT * FROM tbl_event INNER JOIN user ON user.id = tbl_event.id_user INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_event.id_siswa INNER JOIN tbl_jenis_event ON tbl_jenis_event.id_jenis_event = tbl_event.id_jenis_event")->result_array();        
        $data['siswa'] = $this->db->query("SELECT * FROM tbl_siswa INNER JOIN tbl_saldo ON tbl_saldo.id_siswa = tbl_siswa.id_siswa ORDER BY tbl_siswa.id_siswa DESC")->result_array();
        $data['event'] = $this->db->query("SELECT * FROM tbl_jenis_event WHERE is_active=1")->result_array();
        $userdata = $this->session->userdata();
        $id_transaksi = 'EV'.date('YmdHis');

        // cek kebawah ya broooo U
        $this->form_validation->set_rules('id_siswa', 'Pilih Siswa', 'required');
        // $this->form_validation->set_rules('id_jenis_pembayaran', 'Jenis pembayaran', 'required');
        $this->form_validation->set_rules('id_sumber_dana', 'Sumber Dana', 'required');
        $this->form_validation->set_rules('id_jenis_event', 'Nominal Transaksi', 'required');
        $this->form_validation->set_rules('nominal_transaksi', 'Nominal Transaksi', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/event', $data);
            $this->load->view('templates/footer');
        }else {
            $id_siswa = htmlspecialchars($this->input->post('id_siswa', true));
            $id_sumber_dana = htmlspecialchars($this->input->post('id_sumber_dana', true));
            $nominal_transaksi = htmlspecialchars($this->input->post('nominal_transaksi', true));
            $bulan_tagihan = htmlspecialchars($this->input->post('bulan_tagihan', true));
            $id_jenis_event = htmlspecialchars($this->input->post('id_jenis_event', true));

            if ($id_sumber_dana == 1) {
                $saldo_siswa = $this->db->query("SELECT * FROM tbl_saldo WHERE id_siswa=$id_siswa")->row_array();
                $saldo_fix = $saldo_siswa['saldo'];
                if ($saldo_fix >= $nominal_transaksi) {
                    $data = [
                        'id_event' => $id_transaksi,
                        'tgl_transaksi' => date('Y-m-d'),
                        'jam_transaksi' => date('H:i:s'),
                        'id_siswa' => $id_siswa,
                        'id_sumber_dana' => $id_sumber_dana,
                        'nominal_transaksi' => $nominal_transaksi,
                        'id_user' => $userdata['id'],
                        'bulan_tagihan' => "$bulan_tagihan"."-01",
                        'id_jenis_event' => $id_jenis_event,
                    ];
                    $this->db->insert('tbl_event', $data);
                    $saldo_akhir = $saldo_fix - $nominal_transaksi;
                    $this->db->query("UPDATE tbl_saldo SET saldo=$saldo_akhir WHERE id_siswa=$id_siswa");
                    $this->session->set_flashdata('message', 'Berhasil membayar event dari tabungan');
                    redirect('transaksi/confirmevent/'.$id_transaksi);
                }elseif ($saldo_fix < $nominal_transaksi) {
                    $this->session->set_flashdata('message', 'Gagal membayar spp, Saldo tidak cukup!!!');
                    redirect('transaksi/event/');
                }
                
            }else{
                $data = [
                        'id_event' => $id_transaksi,
                        'tgl_transaksi' => date('Y-m-d'),
                        'jam_transaksi' => date('H:i:s'),
                        'id_siswa' => $id_siswa,
                        'id_sumber_dana' => $id_sumber_dana,
                        'nominal_transaksi' => $nominal_transaksi,
                        'id_user' => $userdata['id'],
                        'bulan_tagihan' => "$bulan_tagihan"."-01",
                        'id_jenis_event' => $id_jenis_event,
                    ];
                    $this->db->insert('tbl_event', $data);
                    $this->session->set_flashdata('message', 'Berhasil membayar event dari Tunai');
                    redirect('transaksi/confirmevent/'.$id_transaksi);
            }
        }

    }

    public function confirmtabungan($id_transaksi){
        // here
        $data['detail_pembayaran'] = $this->db->query("SELECT * FROM tbl_riwayat_tabungan 
                                                INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_riwayat_tabungan.id_siswa 
                                                INNER JOIN tbl_jenis_transaksi ON tbl_jenis_transaksi.id_jenis_transaksi = tbl_riwayat_tabungan.id_jenis_transaksi
                                                WHERE id_riwayat_transaksi = '$id_transaksi'")->row_array();
        $this->load->view('transaksi/confirmtabungan', $data);
    }

    public function confirmspp($id_transaksi, $id_siswa){
        // here
        $data['detail_pembayaran'] = $this->db->query("SELECT * FROM tbl_spp 
                                                INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa 
                                                WHERE id_spp = '$id_transaksi'")->row_array();
        $detail_bayar = $this->db->query("SELECT * FROM tbl_spp 
                                                INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa 
                                                WHERE id_spp = '$id_transaksi'")->row_array();
        $id_siswa = $detail_bayar['id_siswa'];
        $bulan_tagihan = $detail_bayar['bulan_tagihan'];

        $data['total_bayar'] = $this->db->query("SELECT SUM(nominal_transaksi) as total FROM `tbl_spp` WHERE id_siswa='$id_siswa' AND bulan_tagihan LIKE '$bulan_tagihan%';")->row_array();
        $data['total_tagihan'] = $this->db->query("SELECT nominal_spp FROM tbl_siswa 
                                            INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
                                            WHERE tbl_siswa.id_siswa = $id_siswa")->row_array();
        $this->load->view('transaksi/confirmspp', $data);
    }

    public function confirmevent($id_transaksi){
        // here
        $data['detail_pembayaran'] = $this->db->query("SELECT * FROM tbl_event 
                                                INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_event.id_siswa 
                                                INNER JOIN tbl_jenis_event ON tbl_jenis_event.id_jenis_event = tbl_event.id_jenis_event
                                                WHERE id_event = '$id_transaksi'")->row_array();
        $this->load->view('transaksi/confirmevent', $data);
    }

}