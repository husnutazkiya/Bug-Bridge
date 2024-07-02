<?php

class Logbook_model extends CI_Model
{
    public function addBuglist($data){
        return $this->db->insert('t_buglist', $data);
    }

    public function hapus_buglist($id){
        $this->db->delete('t_buglist', ['id' => $id]);
    }
        
    public function getBugByKode($kode){
        $this->db->select('*');
        $this->db->from('t_buglist');
        $this->db->where('t_buglist.kode', $kode);
        $query = $this->db->get();
        return $query->result();
    }

    public function getBugtabel($kode){
        $this->db->select('*');
        $this->db->from('t_buglist');
        $this->db->where('t_buglist.kode', $kode);
        $this->db->where_in('t_buglist.status', ['Open', 'Ready to test']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getBugclosed($kode){
        $this->db->select('*');
        $this->db->from('t_buglist');
        $this->db->where('t_buglist.kode', $kode);
        $this->db->where_in('t_buglist.status', ['Closed']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getBuglistById($id) //update buglist
    {
        return $this->db->get_where('t_buglist', ['id' => $id])->row_array();
        return $query->result();
    }

    public function editBuglist($id, $data){
        $this->db->where('id', $id);
        $this->db->update('t_buglist', $data);
    }


    public function getdeveloper($kode){
        $query = $this->db
            ->select('id, name')
            ->where('kode', $kode)
            ->get('tb_user'); // Adjust table name to 'tb_user'

        return $query->result();
    }   
}