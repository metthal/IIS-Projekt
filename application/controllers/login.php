<?php

class Login extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Login'
        );

        $this->load->view('header', $data);
        $this->load->view('footer');
    }
}

?>
