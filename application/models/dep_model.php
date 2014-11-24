<?php

class Dep_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function deplist($filter = '')
    {
        $this->db->select('*');
        $this->db->from('Obor');
        $this->db->where('nazov LIKE "' . $filter . '%"');

        return $this->db->get()->result();
    }

    public function add($dep_data)
    {
        $insert_data = array(
            'nazov' => $dep_data['name'],
            'titul' => $dep_data['title']
        );

        $this->db->insert('Obor', $insert_data);
    }

    public function get($depID)
    {
        $this->db->select('*');
        $this->db->from('Obor');
        $this->db->where('obor_ID', $depID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $dep = $query->result();
            return $dep[0];
        }

        return false;
    }

    public function edit($depID, $dep_data)
    {
        $update_data = array(
            'nazov' => $dep_data['name'],
            'titul' => $dep_data['title']
        );

        $this->db->where('obor_ID', $depID);
        $this->db->update('Obor', $update_data);
    }

    public function delete($depID)
    {
        $this->db->where('obor_ID', $depID);
        $this->db->delete('Obor');
    }

    public function reset()
    {
        $this->db->empty_table('Obor');
    }
}
