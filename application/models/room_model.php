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
        $this->db->select('ucebna_ID, kridlo, cislo_ucebne,kapacita');
        $this->db->from('Ucebna');
        $this->db->where('cislo_ucebne LIKE "' . $filter . '%"');

        return $this->db->get()->result();
    }

    public function room_add($room_data)
    {
        $insert_data = array(
            'cislo_ucebne' => $room_data['room_no'],
            'kridlo' => $room_data['side'],
            'kapacita' => $room_data['capacity']
        );

        $this->db->insert('Ucebna', $insert_data);

        $this->db->from('Ucebna');
        $this->db->where('cislo_ucebne', $room_data['room_no']);
        $this->db->where('kridlo', $room_data['side']);
        $this->db->limit(1);
        $query = $this->db->get();
        $room = $query->result();

        $this->db->from('Prislusenstvo');
        foreach ($room_data['accesses'] as &$access)
        {
            $this->db->where('prislusenstvo_ID', $access);
            $this->db->update('Prislusenstvo', array('ucebna_ID' => $room[0]->ucebna_ID));
        }
    }
    public function room_delete($roomID)
    {
        $this->db->where('ucebna_ID', $roomID);
        $this->db->delete('Ucebna');

        $this->db->from('Prislusenstvo');
        $this->db->where('ucebna_ID', $roomID);
        $this->db->update('Prislusenstvo', array('ucebna_ID' =>NULL));

    }

    public function schedules_for($roomID)
    {
        $query = 'SELECT k.ucebna_ID, k.akcia_ID, a.nazov, a.datum_konania, a.trvanie FROM Konanie_akcie k
            INNER JOIN Akcia a ON k.akcia_ID = a.akcia_ID
            WHERE k.ucebna_ID =' . $roomID;

        return $this->db->query($query)->result();
    }

    public function room_edit($roomID, $room_data)
    {
        $insert_data = array(
            'cislo_ucebne' => $room_data['room_no'],
            'kridlo' => $room_data['side'],
            'kapacita' => $room_data['capacity']
        );

        $this->db->where('ucebna_ID', $roomID);
        $this->db->update('Ucebna', $insert_data);

        $this->db->from('Ucebna');
        $this->db->where('cislo_ucebne', $room_data['room_no']);
        $this->db->where('kridlo', $room_data['side']);
        $this->db->limit(1);
        $query = $this->db->get();
        $room = $query->result();

        $this->db->from('Prislusenstvo');
        foreach ($room_data['accesses'] as &$access)
        {
            $this->db->where('prislusenstvo_ID', $access);
            $this->db->update('Prislusenstvo', array('ucebna_ID' => $room[0]->ucebna_ID));
        }
    }
}
