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

    public function typeaccess_name($typeaccessID)
    {
        $this->db->select('nazov_typu');
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

    public function typeaccess_get_nametype($serial_no)
    {
        $this->db->select('typ_ID');
        $this->db->from('Prislusenstvo');
        $this->db->where('seriove_cislo', $serial_no);
        $this->db->limit(1);
        $query = $this->db->get();
        $access_type = $query->result();

        $this->db->from('Typ_prislusenstva');
        $this->db->where('typ_prislusenstva_ID', $access_type[0]->typ_ID);
        $query = $this->db->get();
        $name_type = $query->result();
        return $name_type[0]->nazov_typu;
    }

    public function typeaccess_get_type_count($name_type)
    {
        $this->db->select('typ_prislusenstva_ID');
        $this->db->from('Typ_prislusenstva');
        $this->db->like('nazov_typu', $name_type);
        $query = $this->db->get();
        $type = $query->result();

        $this->db->from('Prislusenstvo');
        $this->db->where('typ_ID', $type[0]->typ_prislusenstva_ID);
        $query = $this->db->get();
        return $this->db->count_all_results();
    }

}
