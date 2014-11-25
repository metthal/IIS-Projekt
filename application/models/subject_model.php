<?php

class Subject_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function subjectlist($filter = '')
    {
        $this->db->select('*');
        $this->db->from('Predmet');
        $this->db->where('nazov_predmetu LIKE "' . $filter . '%"');

        return $this->db->get()->result();
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
        $this->db->select('*');
        $this->db->from('Predmet');
        $this->db->where('predmet_ID', $subjectID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $subject = $query->result();
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
