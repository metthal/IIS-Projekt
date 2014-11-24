<?php

class Class_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reset()
    {
        $this->db->empty_table('Predmet');
    }
}
