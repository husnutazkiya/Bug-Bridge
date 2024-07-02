<?php

class User_model extends CI_Model
{
    public function getUnitbyNip()
    {
        $nip = $this->session->userdata('kode');
        $this->db->select('tb_user.kode,tb_unit.kode AS kode, tb_unit.unit');
        $this->db->from('tb_user', 'tb_unit');
        $this->db->join('tb_unit', 'tb_unit.kode=tb_user.kode');
        $this->db->where('tb_user.kode', $nip);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllUser()
    {
        $this->db->select('tb_user.*, tb_unit.kode AS kode, tb_unit.unit, user_role.role');
        $this->db->join('tb_unit', 'tb_user.kode = tb_unit.kode');
        $this->db->join('user_role', 'tb_user.role_id = user_role.id');
        $this->db->from('tb_user');
        $query = $this->db->get();
        return $query->result();
    }
}
