<?php

class Access_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function accesslist($filter = '')
    {
        $this->db->select('prislusenstvo_ID, seriove_cislo, typ_ID, ucebna_ID');
        $this->db->from('Prislusenstvo');
        $this->db->where('seriove_cislo LIKE "' . $filter . '%"');

        return $this->db->get()->result();
    }

    public function accesslist_is_null($filter = '')
    {
        $this->db->select('prislusenstvo_ID, seriove_cislo, typ_ID, ucebna_ID');
        $this->db->from('Prislusenstvo');
        $this->db->where('seriove_cislo LIKE "' . $filter . '%"');
        $this->db->where('ucebna_ID',NULL);

        return $this->db->get()->result();
    }
    public function access_get($accessID)
    {
        $this->db->select('*');
        $this->db->from('Prislusenstvo');
        $this->db->where('prislusenstvo_ID', $accessID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $access = $query->result();
            return $access[0];
        }
        return false;
    }

    public function access_add($access_data)
    {
        $insert_data = array(
            'typ_ID' => $access_data['access_type'],
            'seriove_cislo' => $access_data['access_serial_no'],
            'ucebna_ID' => NULL
        );

        $this->db->insert('Prislusenstvo', $insert_data);
    }
    public function access_delete($accessID)
    {
        $this->db->where('prislusenstvo_ID', $accessID);
        $this->db->delete('Prislusenstvo');
    }

    public function access_edit($accessID,$access_data)
    {
        $insert_data = array(
            'typ_ID' => $access_data['access_type'],
            'seriove_cislo' => $access_data['access_serial_no'],
            'ucebna_ID' => NULL
        );

        $this->db->where('prislusenstvo_ID', $accessID);
        $this->db->update('Prislusenstvo', $insert_data);
    }

    public function typeaccesslist($filter = '')
    {
        $this->db->select('typ_prislusenstva_ID, nazov_typu');
        $this->db->from('Typ_prislusenstvo');
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
            return $access[0];
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
        $this->db->delete('Typ_prilusenstva');
    }

    public function typeaccess_edit($typeaccessID,$typeaccess_data)
    {
        $insert_data = array(
            'nazov_typu' => $typeaccess_data['typeaccess_name']
        );

        $this->db->where('typ_prislusenstva_ID', $typeaccessID);
        $this->db->insert('Typ_prislusenstva', $insert_data);
    }
}
