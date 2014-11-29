<?php

class Event_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function eventlist($filter = '')
    {
        $query = 'SELECT a.*, u.login AS uzivatel, p.nazov_predmetu AS predmet FROM Akcia a
                INNER JOIN Uzivatel u ON a.uzivatel_ID = u.uzivatel_ID
                LEFT JOIN Predmet p ON a.predmet_ID = p.predmet_ID
                WHERE a.nazov LIKE "' . $filter . '%"';

        return $this->db->query($query)->result();
    }

    public function add($event_data)
    {
        $insert_data = array(
            'nazov' => $event_data['name'],
            'zaznam' => $event_data['record'],
            'stream' => $event_data['stream'],
            'trvanie' => $event_data['duration'],
            'datum_konania' => $event_data['schedule_date'],
            'datum_rezervacie' => $event_data['book_date'],
            'predmet_ID' => $event_data['subject'],
            'uzivatel_ID' => $event_data['user']
        );

        $this->db->insert('Akcia', $insert_data);

        $this->db->select('akcia_ID');
        $this->db->from('Akcia');
        $this->db->where('nazov', $event_data['name']);
        $this->db->where('zaznam', $event_data['record']);
        $this->db->where('stream', $event_data['stream']);
        $this->db->where('trvanie', $event_data['duration']);
        $this->db->where('datum_konania', $event_data['schedule_date']);
        $this->db->where('datum_rezervacie', $event_data['book_date']);
        $this->db->where('predmet_ID', $event_data['subject']);
        $this->db->where('uzivatel_ID', $event_data['user']);
        $result = $this->db->get()->result();
        $id = $result[0]->akcia_ID;

        foreach ($event_data['rooms'] as &$room)
        {
            $insert_data = array(
                'akcia_ID' => $id,
                'ucebna_ID' => $room
            );

            $this->db->insert('Konanie_akcie', $insert_data);
        }
    }

    public function get($eventID)
    {
        $this->db->select('*');
        $this->db->from('Akcia');
        $this->db->where('akcia_ID', $eventID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $event = $query->result();
            return $event[0];
        }

        return false;
    }

    public function edit($eventID, $event_data)
    {
        $update_data = array(
            'nazov' => $event_data['name'],
            'zaznam' => $event_data['record'],
            'stream' => $event_data['stream'],
            'trvanie' => $event_data['duration'],
            'datum_konania' => $event_data['schedule_date'],
            'predmet_ID' => $event_data['subject'],
            'uzivatel_ID' => $event_data['user']
        );

        $this->db->where('akcia_ID', $eventID);
        $this->db->update('Akcia', $update_data);

        $this->db->where('akcia_ID', $eventID);
        $this->db->delete('Konanie_akcie');

        foreach ($event_data['rooms'] as &$room)
        {
            $insert_data = array(
                'akcia_ID' => $eventID,
                'ucebna_ID' => $room
            );

            $this->db->insert('Konanie_akcie', $insert_data);
        }
    }

    public function delete($eventID)
    {
        $this->db->where('akcia_ID', $eventID);
        $this->db->delete('Akcia');
    }

    public function schedules_for($eventID)
    {
        $this->db->select('*');
        $this->db->from('Konanie_akcie');
        $this->db->where('akcia_ID', $eventID);

        return $this->db->get()->result();
    }

    public function schedule_in_classroom($eventID, $roomID)
    {
        $this->db->select('*');
        $this->db->from('Konanie_akcie');
        $this->db->where('akcia_ID', $eventID);
        $this->db->where('ucebna_ID', $roomID);

        $query = $this->db->get();
        if ($query->num_rows() == 0)
            return false;

        return true;
    }

    public function reset()
    {
        $this->db->empty_table('Akcia');
    }
}
