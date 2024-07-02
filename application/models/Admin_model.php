<?php

class Admin_model extends CI_Model
{

    public function getAllbuglist()
    {
        $query = $this->db->get('t_buglist');
        return $query->result();
    }


    public function getBugListReadyByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('t_buglist');
        $this->db->where('status', 'Ready to test');
        $this->db->where('kode', $kode);
        $query = $this->db->get();
        return $query->result();
    }
    

    public function getbuglistopenByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('t_buglist');
        $this->db->where('status', 'Open');
        $this->db->where('kode', $kode);
        $query = $this->db->get();
        return $query->result();  
    }

    public function getbuglistcloseByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('t_buglist');
        $this->db->where('status', 'Close');
        $this->db->where('kode', $kode);
        $query = $this->db->get();
        return $query->result();  
    }

    public function getAllRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    public function hapusDataRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
    }

    public function editDataRole()
    {
        $data = [
            "role" => $this->input->post('role', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
    }

    public function addUser()
    {
        $base_url = base_url();
        $data = [
            "name" => $this->input->post('name', true),
            "username" => $this->input->post('username', true),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            "jabatan" => $this->input->post('jabatan', true),
            "kode" => $this->input->post('kode', true),
            "role_id" => $this->input->post('role', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->insert('tb_user', $data);
    }

    // public function getLogbookByUserId($user_nip)
    // {
    //     $result = $this->db->select('tb_logbook.*, tb_user.username')
    //         ->from('tb_logbook')
    //         ->join('tb_user', 'tb_user.nip = tb_logbook.nip')
    //         ->where('tb_logbook.nip', $user_nip)
    //         ->get()
    //         ->result();
    //     if (empty($result)) {
    //         echo '<script>';
    //         echo 'alert("Logbook masih kosong");';
    //         echo 'window.location.href = "./user";';
    //         echo '</script>';
    //     }
    //     return $result;
        // $this->db->select('tb_logbook.*, tb_user.username');
        // $this->db->from('tb_logbook');
        // $this->db->join('tb_user', 'tb_user.nip = tb_logbook.nip');
        // $this->db->where('tb_logbook.nip', $user_id);
        // return $this->db->get()->result();
    // }

    public function __construct()
    {
        parent::__construct();
        // Load model dan lain-lain sesuai kebutuhan
    }

    // public function update_status($logbook_id, $new_status) {
    //     // Lakukan perubahan status sesuai dengan tindakan yang diberikan
    //     // Misalnya, Anda dapat menyimpan perubahan status ini ke database jika diperlukan.
    //     // Atau Anda dapat mengatur status di memori sementara.

    //     // Redirect kembali ke halaman data user setelah perubahan status
    //     redirect('admin/datauser');
    // }

    public function hapusUser($id)
    {
        $data['gambar'] = $this->db->get_where('tb_user', ['id' => $id])->row_array();
        $image = $data['gambar']['qr_code'];
        unlink(FCPATH . 'assets/qrcode/' . $image);
        $this->db->delete('tb_user', ['id' => $id]);
    }

    public function addUnit()
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "unit" => $this->input->post('unit', true),
        ];
        $this->db->where('id_unit', $this->input->post('id_unit'));
        $this->db->insert('tb_unit', $data);
    }

    public function hapusUnit($id_unit)
    {
        $this->db->delete('tb_unit', ['id_unit' => $id_unit]);
    }

    public function searchChecklist($keyword)
    {
        if(!$keyword){
            return null;
        }
        $this->db->like('layanan', $keyword);
        $this->db->or_like('nip', $keyword);
        $query = $this->db->get('tb_logbook');
        return $query->result();
    }

    // public function searchChecklist($searchQuery)
    // {
    //     $this->db->like('layanan', $searchQuery);
    //     $this->db->where('nip', $nip);
    
    //     $query = $this->db->get('tb_logbook');
    
    //     return $query->result_array();
    // }
}
