<?php

class Typeaccess_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function typeaccesslist($filter = '')
    {
        $this->db->select('typ_prislusenstva_ID, nazov_typu');
        $this->db->from('Typ_prislusenstva');
        $this->db->where('nazov_typu LIKE "' . $filter . '%"');

        return $this->db->get()->result();
    }

    public function typeaccess_get($typeaccessID)
    {
        $this->db->select('*');
        $this->db->from('Typ_prislusenstva');
        $this->db->where('typ_prislusenstva_ID', $typeaccessID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $typeaccess = $query->result();
            return $typeaccess[0];
        }
        return false;
    }

    public function typeaccess_add($typeaccess_data)
    {
        $insert_data = array(
            'nazov_typu' => $typeaccess_data['typeaccess_name'],
        );

        $this->db->insert('Typ_prislusenstva', $insert_data);
    }
    public function typeaccess_delete($typeaccessID)
    {
        $this->db->where('typ_prislusenstva_ID', $typeaccessID);
        $this->db->delete('Typ_prislusenstva');
    }

    public function typeaccess_edit($typeaccessID,$typeaccess_data)
    {
        $insert_data = array(
            'nazov_typu' => $typeaccess_data['typeaccess_name']
        );
        $this->db->where('typ_prislusenstva_ID', $typeaccessID);
        $this->db->update('Typ_prislusenstva', $insert_data);
    }
}
