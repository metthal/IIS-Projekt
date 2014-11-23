<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($action = 'users')
    {
        if (!check_login())
            redirect('login', 'refresh');

        // only users with privileges 2 have access to this site
        $privileges = $this->user_model->privileges(login_data('id'));
        if ($privileges != 2)
            redirect('home', 'refresh');

        $menu_items = $this->menu->load('menu_main', $privileges);
        $submenu_items = $this->menu->load('menu_admin', $privileges);

        $data = array(
            'title' => 'Administrácia',
            'menu_items' => $menu_items,
            'submenu_items' => $submenu_items
        );

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('submenu', $data);

        if ($action == 'users')
            $this->users();
        else if ($action == 'reset')
            $this->reset();

        $this->load->view('footer');
    }

    public function users()
    {
    }

    public function reset()
    {
        if($this->input->post('reset_request'))
        {
            $this->form_validation->set_rules('reset_request', 'ResetRequest','integer');
            $this->form_validation->run();

            if ($this->input->post('reset_users'))
            {
                $this->user_model->reset();
            }
            if ($this->input->post('reset_actions'))
                $this->action_model->reset();

            if ($this->input->post('reset_rooms'))
            {
                $this->room_model->reset();
                $this->form_validation->set_message('reset_request', 'Reset!');
            }

            if($this->input->post('reset_db'))
            {
                $this->action_model->reset();
                $this->class_model->reset();
                $this->domain_model->reset();
                $this->grade_model->reset();
                $this->room_model->reset();
                $this->user_model->reset();
            }
        }
        $this->load->view('admin_reset_view');
    }
}

?>
