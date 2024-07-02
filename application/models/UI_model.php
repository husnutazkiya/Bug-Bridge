<?php

class UI_model extends CI_Model
{    
    public function hapus_checklist($id)
    {
        $this->db->delete('t_ui-ux', ['id' => $id]);
    }
    public function getBugUIByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('t_ui-ux');
        $this->db->where('t_ui-ux.kode',$kode);
        $query = $this->db->get();
        return $query->result();
    }

    public function getBugListReadyByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('t_ui-ux');
        $this->db->where('status', 'Ready to test');
        $this->db->where('kode', $kode);
        $query = $this->db->get();
        return $query->result();
    }

    public function getbuglistopenByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('t_ui-ux');
        $this->db->where('status', 'Open');
        $this->db->where('kode', $kode);
        $query = $this->db->get();
        return $query->result();  
    }

    public function getbuglistcloseByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('t_ui-ux');
        $this->db->where('status', 'Close');
        $this->db->where('kode', $kode);
        $query = $this->db->get();
        return $query->result();  
    }

    public function add_buglist($data)
    {
        return $this->db->insert('t_ui-ux', $data);
    }

    // Your model function
    public function update_checklist($id, $nip, $dataToUpdate){
    try {
        // Enable Query Builder logging
        $this->db->save_queries = TRUE;

        $this->db->where('id', $id);
        $this->db->where('nip', $nip);
        $result = $this->db->update('checklist', $dataToUpdate);

        // Display the last executed query
        $lastQuery = end($this->db->queries);
        echo "Last Query: " . $lastQuery;

        if (!$result) {
            // Display the error message
            echo "Update Error: " . $this->db->error();
        }

        return $result;
    } catch (Exception $e) {
        // Catch any other exceptions
        echo "Exception: " . $e->getMessage();
        return false;
    }
}

    public function getChecklistExport($nip) {
        $this->db->select("*");
        $this->db->from("checklist"); // Sesuaikan dengan nama tabel checklist Anda
        $this->db->where("nip", $nip); // Sesuaikan dengan nama kolom NIP pada tabel checklist
        $query = $this->db->get();
        return $query->result();
    }

}

