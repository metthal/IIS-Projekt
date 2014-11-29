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

    public function reset()
    {
        $this->db->delete('Uzivatel', array('prava' => '0'));
        $this->db->delete('Uzivatel', array('prava' => '1'));
    }

    public function get($userID)
    {
        $this->db->select('*');
        $this->db->from('Uzivatel');
        $this->db->where('uzivatel_ID', $userID);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $user = $query->result();
            return $user[0];
        }

        return false;
    }

    public function userlist($filter = '')
    {
        $this->db->select('uzivatel_ID, login, meno, priezvisko, mail, tel_cislo');
        $this->db->from('Uzivatel');
        $this->db->where('login LIKE "' . $filter . '%"');

        return $this->db->get()->result();
    }

    public function add($user_data)
    {
        $insert_data = array(
            'login' => $user_data['login'],
            'heslo' => $user_data['password'],
            'meno' => $user_data['name'],
            'priezvisko' => $user_data['surname'],
            'mail' => $user_data['mail'],
            'prava' => $user_data['privileges']
        );

        if (array_key_exists('phone_number', $user_data))
            $insert_data['tel_cislo'] = $user_data['phone_number'];

        $this->db->insert('Uzivatel', $insert_data);
    }

    public function delete($userID)
    {
        $this->db->where('uzivatel_ID', $userID);
        $this->db->delete('Uzivatel');
    }

    public function edit($userID, $user_data)
    {
        $update_data = array(
            'login' => $user_data['login'],
            'meno' => $user_data['name'],
            'priezvisko' => $user_data['surname'],
            'mail' => $user_data['mail'],
            'tel_cislo' => $user_data['phone_number'],
            'prava' => $user_data['privileges']
        );

        $this->db->where('uzivatel_ID', $userID);
        $this->db->update('Uzivatel', $update_data);
    }

    public function check_login($id, $login)
    {
        $this->db->select('uzivatel_ID');
        $this->db->from('Uzivatel');
        $this->db->where('uzivatel_ID !=', $id);
        $this->db->where('login', $login);

        $query = $this->db->get();
        return ($query->num_rows() == 0);
    }

    public function check_passwd($id, $pass)
    {
        $this->db->select('uzivatel_ID');
        $this->db->from('Uzivatel');
        $this->db->where('uzivatel_ID ', $id);
        $this->db->where('heslo', $pass);

        $query = $this->db->get();
        return ($query->num_rows() == 1);
    }

    public function check_mail($id, $mail)
    {
        $this->db->select('uzivatel_ID');
        $this->db->from('Uzivatel');
        $this->db->where('uzivatel_ID !=', $id);
        $this->db->where('mail', $mail);

        $query = $this->db->get();
        return ($query->num_rows() == 0);
    }
    public function change_passwd($id, $user_data)
    {
        $this->db->select('Uzivatel_ID,heslo');
        $this->db->from('Uzivatel');
        $this->db->where('uzivatel_ID', $id);
        $this->db->limit(1);

        $query = $this->db->get();
        $user = $query->result();

        if( $user_data['old_passwd'] == $user[0]->heslo )
        {
            $this->db->where('uzivatel_ID', $id);
            $this->db->update('Uzivatel',array('heslo' => $user_data['new_passwd']));
        }
    }

    public function change_email($id,$email)
    {
        $this->db->select('Uzivatel_ID,mail');
        $this->db->from('Uzivatel');
        $this->db->where('uzivatel_ID', $id);
        $this->db->update('Uzivatel', array('mail' => $email));
    }
}
