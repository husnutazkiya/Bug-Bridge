<?php

class Checklist_model extends CI_Model
{    
    public function hapus_checklist($id)
    {
        $this->db->delete('checklist', ['id' => $id]);
    }
    public function getChecklistById($id)
    {
        return $this->db->get_where('checklist', ['id' => $id])->row_array();
    }

    public function getChecklistData($nip) {
        $this->db->select("*");
        $this->db->from("checklist as c"); 
        $this->db->where("c.nip", $nip); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getAllChecklistData()
    {
        $this->db->select('checklist.*, tb_user.username');
        $this->db->from('checklist');
        $this->db->join('tb_user', 'checklist.nip = tb_user.nip', 'left');
        $result = $this->db->get();
    
        if (!$result) {
            echo $this->db->error();
            log_message('error', 'Database Error: ' . $this->db->error());
        }
    
        return $result->result_array();
    }
    

    


    public function add_checklist($data)
    {
        // Tambahkan data checklist dari controller ke dalam tabel
        return $this->db->insert('checklist', $data);
    }

    public function update_checklist($id, $nip, $dataToUpdate)
    {
    $this->db->where('id', $id);
    $this->db->where('nip', $nip);
    return $this->db->update('checklist', $dataToUpdate);
    }
    public function getChecklistExport($nip) {
        $this->db->select("*");
        $this->db->from("checklist"); // Sesuaikan dengan nama tabel checklist Anda
        $this->db->where("nip", $nip); // Sesuaikan dengan nama kolom NIP pada tabel checklist
        $query = $this->db->get();
        return $query->result();
    }
    // In your Checklist_model

}

