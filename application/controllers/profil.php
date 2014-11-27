<?php

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($action = 'change_email', $subaction = '')
    {
        if (!check_login())
            redirect('login', 'refresh');

        $privileges = $this->user_model->privileges(login_data('id'));

        $menu_items = $this->menu->load('menu_main', $privileges);
        $submenu_items = $this->menu->load('menu_profil', $privileges);

        $data = array(
            'title' => 'Profil',
            'menu_items' => $menu_items,
            'submenu_items' => $submenu_items,
            'menu_item_selected' => 'profil'
        );

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('submenu', $data);

        if ($action == 'change_passwd')
            $this->change_passwd();
        else if ($action == 'change_email')
            $this->change_email();

        $this->load->view('footer');
    }

    public function change_passwd()
    {
        if($this->input->post('change_passwd_request'))
        {
            $this->form_validation->set_rules('old_passwd', 'Staré heslo', 'trim|required');
            $this->form_validation->set_rules('new_passwd', 'Nové heslo', 'required|callback_change_passwd_request');
            $this->form_validation->run();

            $old_passwd = $this->input->post('old_passwd');
            $new_passwd = $this->input->post('new_passwd');

            $data = array(
                'old_passwd' => $old_passwd,
                'new_passwd' => $new_passwd
            );

            if($this->input->post('new_passwd') == $this->input->post('confirm_passwd'))
            {
                $this->user_model->change_passwd(login_data('id'),$data);
            }
            else
                $this->form_validation->set_message('change_passwd', 'Nove heslo nieje zhodne!');

        }
        $this->load->view('profil_change_passwd_view');
    }

    public function change_email()
    {
        if($this->input->post('change_email_request'))
        {
            $this->form_validation->set_rules('confirm_passwd', 'Heslo', 'trim|required');
            $this->form_validation->set_rules('email', 'E-mail', 'required|callback_change_email_request');

            $this->form_validation->run();

            $user = $this->user_model->get(login_data('id'));

            $passwd = $this->input->post('confirm_passwd');
            $email = $this->input->post('email');

            if ($user->heslo == $passwd)
            {
                $this->user_model->change_email($user->uzivatel_ID,$email);
            }
            else
                $this->form_validation->set_message('change_email', 'Zle heslo');
        }
        $this->load->view('profil_change_email_view');
    }
}

?>
