<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index()
    {
        if (check_login())
            redirect('home', 'refresh');

        $data = array(
            'title' => 'Login'
        );

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_login_request');

        if ($this->input->post('login_request'))
        {
            if ($this->form_validation->run() == true)
                redirect('home', 'refresh');
        }

        $this->load->view('header', $data);
        $this->load->view('login_view');
        $this->load->view('footer');
    }

    public function login_request($password)
    {
        $username = $this->input->post('username');

        $result = $this->user_model->login($username, $password);
        if ($result == false)
        {
            $this->form_validation->set_message('login_request', 'Nesprávne užívateľské meno alebo heslo');
            return false;
        }

        perform_login($result[0]);
        return true;
    }
}

?>
