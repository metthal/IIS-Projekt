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

    public function room_get($roomID)
    {
        $this->db->select('*');
        $this->db->from('Ucebna');
        $this->db->where('ucebna_ID', $roomID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $room = $query->result();
            return $room[0];
        }
        return false;
    }

    public function roomlist($filter = '')
    {
        $this->db->select('ucebna_ID, kridlo, cislo_ucebne');
        $this->db->from('Ucebna');
        $this->db->where('cislo_ucebne LIKE "' . $filter . '%"');

        return $this->db->get()->result();
    }

    public function room_add($room_data)
    {
        $insert_data = array(
            'cislo_ucebne' => $room_data['room_no'],
            'kridlo' => $room_data['side']
        );

        $this->db->insert('Ucebna', $insert_data);
    }
    public function room_delete($roomID)
    {
        $this->db->where('ucebna_ID', $roomID);
        $this->db->delete('Ucebna');
    }

    public function room_edit($roomID,$room_data)
    {
        $insert_data = array(
            'cislo_ucebne' => $room_data['room_no'],
            'kridlo' => $room_data['side']
        );

        $this->db->where('ucebna_ID', $roomID);
        $this->db->update('Ucebna', $insert_data);
    }
}
