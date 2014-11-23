<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password)
    {
        $this->db->select('uzivatel_ID, login, heslo');
        $this->db->from('Uzivatel');
        $this->db->where('login', $username);
        $this->db->where('heslo', $password);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1)
            return $query->result();

        return false;
    }

    public function privileges($userID)
    {
        $this->db->select('prava');
        $this->db->from('Uzivatel');
        $this->db->where('uzivatel_ID', $userID);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $user = $query->result();
            return $user[0]->prava;
        }

        return false;
    }
}
