<?php

class Grade_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function gradelist($filter = '')
    {
        $this->db->select('*');
        $this->db->from('Rocnik');
        $this->db->where('nazov LIKE "' . $filter . '%"');

        return $this->db->get()->result();
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
        $this->db->select('*');
        $this->db->from('Rocnik');
        $this->db->where('rocnik_ID', $gradeID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $grade= $query->result();
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
