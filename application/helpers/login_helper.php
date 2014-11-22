<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('check_login'))
{
    function check_login()
    {
        $CI =& get_instance();
        $login_data = $CI->session->userdata('login_data');
        if ($login_data == false) // not logged in
            return false;

        $result = $CI->user_model->login($login_data['username'], $login_data['password']);
        if ($result == false) // user not found in DB, log out
        {
            $CI->session->unset_userdata('login_data');
            return false;
        }

        if ($result[0]->uzivatel_ID != $login_data['id']) // ID mismatch, log out
        {
            $CI->session->unset_userdata('login_data');
            return false;
        }

        $last_action = $CI->session->userdata('last_action');
        if ($last_action == false) // cannot get last action timestamp, can this ever happen?
        {
            $CI->session->set_userdata('last_action', now());
            return false;
        }

        if ($last_action + 900 < now()) // log out after 15 minutes of inactivity
        {
            $CI->session->unset_userdata('login_data');
            return false;
        }

        $CI->session->set_userdata('last_action', now());
        return true;
    }
}

if (!function_exists('perform_login'))
{
    function perform_login($user_data)
    {
        $CI =& get_instance();
        $login_data = array(
            'id' => $user_data->uzivatel_ID,
            'username' => $user_data->login,
            'password' => $user_data->heslo,
        );
        $CI->session->set_userdata('login_data', $login_data);
        $CI->session->set_userdata('last_action', now());
    }
}
