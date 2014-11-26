<?php

class Subject_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function subjectlist($filter = '')
    {
        $query = 'SELECT p.*, r.nazov AS rocnik, u.login AS garant FROM Predmet p
            INNER JOIN Rocnik r ON p.rocnik_ID = r.rocnik_ID
            INNER JOIN Uzivatel u ON p.garant_ID = u.uzivatel_ID
            WHERE p.nazov_predmetu LIKE "' . $filter . '%"';

        return $this->db->query($query)->result();
    }

    public function add($subject_data)
    {
        $insert_data = array(
            'nazov_predmetu' => $subject_data['name'],
            'kredity' => $subject_data['credits'],
            'garant_ID' => $subject_data['garant'],
            'rocnik_ID' => $subject_data['grade']
        );

        $this->db->insert('Predmet', $insert_data);
    }

    public function get($subjectID)
    {
        $query = 'SELECT p.*, r.nazov AS rocnik, u.login AS garant FROM Predmet p
            INNER JOIN Rocnik r ON p.rocnik_ID = r.rocnik_ID
            INNER JOIN Uzivatel u ON p.garant_ID = u.uzivatel_ID
            WHERE p.predmet_ID = ' . $subjectID . ' LIMIT 1';
        $result = $this->db->query($query);
        if ($result->num_rows() == 1)
        {
            $subject = $result->result();
            return $subject[0];
        }

        return false;
    }

    public function edit($subjectID, $subject_data)
    {
        $update_data = array(
            'nazov_predmetu' => $subject_data['name'],
            'kredity' => $subject_data['credits'],
            'garant_ID' => $subject_data['garant'],
            'rocnik_ID' => $subject_data['grade']
        );

        $this->db->where('predmet_ID', $subjectID);
        $this->db->update('Predmet', $update_data);
    }

    public function delete($subjectID)
    {
        $this->db->where('predmet_ID', $subjectID);
        $this->db->delete('Predmet');
    }

    public function reset()
    {
        $this->db->empty_table('Predmet');
    }
}
