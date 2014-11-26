<?php

class Grade_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function gradelist($filter = '')
    {
        $query = 'SELECT r.*, o.nazov AS obor FROM Rocnik r
                INNER JOIN Obor o ON r.obor_ID = o.obor_ID
                WHERE r.nazov LIKE "' . $filter . '%"';

        return $this->db->query($query)->result();
    }

    public function add($grade_data)
    {
        $insert_data = array(
            'nazov' => $grade_data['name'],
            'zaciatok_stud' => $grade_data['start_date'],
            'obor_ID' => $grade_data['dep']
        );

        $this->db->insert('Rocnik', $insert_data);
    }

    public function get($gradeID)
    {
        $query = 'SELECT r.*, o.nazov AS obor FROM Rocnik r
                INNER JOIN Obor o ON r.obor_ID = o.obor_ID
                WHERE r.rocnik_ID = ' . $gradeID . ' LIMIT 1';
        $result = $this->db->query($query);
        if ($result->num_rows() == 1)
        {
            $grade = $result->result();
            return $grade[0];
        }

        return false;
    }

    public function edit($gradeID, $grade_data)
    {
        $update_data = array(
            'nazov' => $grade_data['name'],
            'zaciatok_stud' => $grade_data['start_date'],
            'obor_ID' => $grade_data['dep']
        );

        $this->db->where('rocnik_ID', $gradeID);
        $this->db->update('Rocnik', $update_data);
    }

    public function delete($gradeID)
    {
        $this->db->where('rocnik_ID', $gradeID);
        $this->db->delete('Rocnik');
    }

    public function reset()
    {
        $this->db->empty_table('Rocnik');
    }
}
