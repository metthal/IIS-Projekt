<?php

class Room_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function reset()
    {

        $this->db->empty_table('Typ_prislusenstva');
        $this->db->empty_table('Prislusenstvo');
        $this->db->empty_table('Konanie_akcie');
        $this->db->empty_table('Ucebna');
    }
}
