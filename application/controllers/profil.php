<?php

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index($action = 'change_passwd', $subaction = '')
    {
        if (!check_login())
            redirect('login', 'refresh');

        $privileges = $this->user_model->privileges(login_data('id'));

        $menu_items = $this->menu->load('menu_main', $privileges);
        $submenu_items = $this->menu->load('menu_profil', $privileges);

        $data = array(
            'title' => 'Profil',
            'subtitle' => 'Zmena hesla',
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
        $view_data = array(
            'subtitle' => 'Zmena hesla'
        );

        if($this->input->post('change_passwd_request'))
        {
            $this->form_validation->set_rules('confirm_passwd', 'Potvrdenie heslo', 'callback_check_change_passwd');
            $this->form_validation->run();

            $old_passwd = $this->input->post('old_passwd');
            $new_passwd = $this->input->post('new_passwd');

            $data = array(
                'old_passwd' => $old_passwd,
                'new_passwd' => $new_passwd
            );

            if($this->form_validation->run() != false)
            {
                $this->user_model->change_passwd(login_data('id'),$data);
            }

        }
        $this->load->view('profil_change_passwd_view',$view_data);
    }

    public function check_change_passwd()
    {
        $data = $this->input->post(NULL);

        if ($data['old_passwd'] == '')
        {
            $this->form_validation->set_message('check_change_passwd', 'Staré heslo nemôže byť prázdne!');
            return false;
        }

        if ($data['new_passwd'] == '')
        {
            $this->form_validation->set_message('check_change_passwd', 'Nové heslo nemôže byť prázdne!');
            return false;
        }

        if ($data['confirm_passwd'] == '')
        {
            $this->form_validation->set_message('check_change_passwd', 'Prosím vyplňte aj potvrdenie hesla!');
            return false;
        }

        if (!$this->user_model->check_passwd(login_data('id'),$data['old_passwd']))
        {
            $this->form_validation->set_message('check_change_passwd', 'Staré heslo nieje správne!');
            return false;
        }

        if($data['new_passwd'] != $data['confirm_passwd'])
        {
            $this->form_validation->set_message('check_change_passwd', 'Heslá niesú rovnaké!');
            return false;
        }

        return true;
    }

    public function change_email()
    {
        $view_data = array(
            'subtitle' => 'Zmena e-mailu'
        );

        if($this->input->post('change_email_request'))
        {
            $this->form_validation->set_rules('mail', 'E-mail', 'callback_check_change_email');
            $this->form_validation->run();

            $confirm_passwd = $this->input->post('confirm_passwd');
            $mail = $this->input->post('mail');

            $data = array(
                'confirm_passwd' => $confirm_passwd,
                'mail' => $mail
            );

            if($this->form_validation->run() != false)
            {
                $user = $this->user_model->get(login_data('id'));
                $this->user_model->change_email($user->uzivatel_ID,$mail);
            }
        }
        $this->load->view('profil_change_email_view',$view_data);
    }

    public function check_change_email()
    {

        $data = $this->input->post(NULL);

        if ($data['confirm_passwd'] == '')
        {
            $this->form_validation->set_message('check_change_email', 'Heslo nemôže byť prázdne!');
            return false;
        }

        if (!$this->user_model->check_passwd(login_data('id'),$data['confirm_passwd']))
        {
            $this->form_validation->set_message('check_change_email', 'Heslo nieje správne!');
            return false;
        }

        if ($data['mail'] == '')
        {
            $this->form_validation->set_message('check_change_email', 'E-mail nemôže byť prázdny!');
            return false;
        }

        $this->load->helper('email');
        if (!valid_email($data['mail']))
        {
            $this->form_validation->set_message('check_change_email', 'Zadaný e-mail nie je v platnom formáte!');
            return false;
        }

        if (!$this->user_model->check_mail(login_data('id'), $data['mail']))
        {
             $this->form_validation->set_message('check_change_email', 'Zadaný e-mail už je obsadený!');
             return false;
        }

        return true;
    }
}

?>
