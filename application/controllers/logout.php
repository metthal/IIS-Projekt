<?php

class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!check_login())
            redirect('login', 'refresh');

        perform_logout();
        redirect('login', 'refresh');
    }
}

?>
