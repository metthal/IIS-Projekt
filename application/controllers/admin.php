<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($action = 'users', $subaction = '')
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
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->user_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->user_delete($args[2]);
                else
                    $this->users();
            }
            else
                $this->users();
        }
        else if ($action == 'reset')
            $this->reset();

        $this->load->view('footer');
    }

    public function users()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $users = $this->user_model->userlist();
        else
        {
            $this->form_validation->run();
            $users = $this->user_model->userlist($search);
        }

        $data = array(
            'search' => $search,
            'users' => $users
        );
        $this->load->view('admin_users_view', $data);
    }

    public function user_edit($userID)
    {
        $search = $this->input->get('search');
        $user = $this->user_model->get($userID);
        if ($user == false)
            redirect('admin/users/?search=' . $search, 'refresh');

        $data = array(
            'search' => $search,
            'user' => $user
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('login', 'Login', 'trim');
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('surname', 'Surname', 'trim');
            $this->form_validation->set_rules('mail', 'Mail', 'trim|callback_edit_check');

            if ($this->form_validation->run() != false)
            {
                $user = $this->input->post(NULL);
                $this->user_model->edit($userID, $user);
                redirect('admin/users/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('admin_user_edit_view', $data);
    }

    public function edit_check($dummy)
    {
        $edit_data = $this->input->post(NULL);

        if ($edit_data['login'] == '')
        {
            $this->form_validation->set_message('edit_check', 'Prihlasovacie meno nemôže byť prázdne');
            return false;
        }

        if ($edit_data['name'] == '')
        {
            $this->form_validation->set_message('edit_check', 'Meno nemôže byť prázdne');
            return false;
        }

        if ($edit_data['surname'] == '')
        {
            $this->form_validation->set_message('edit_check', 'Priezvisko nemôže byť prázdne');
            return false;
        }

        if ($edit_data['mail'] == '')
        {
            $this->form_validation->set_message('edit_check', 'E-mail nemôže byť prázdny');
            return false;
        }

        $this->load->helper('email');
        if (!valid_email($edit_data['mail']))
        {
            $this->form_validation->set_message('edit_check', 'Zadaný e-mail nie je v platnom formáte');
            return false;
        }

        if (!$this->user_model->check_login($edit_data['id'], $edit_data['login']))
        {
            $this->form_validation->set_message('edit_check', 'Zadané prihlasovacie meno už je obsadené');
            return false;
        }

        if (!$this->user_model->check_mail($edit_data['id'], $edit_data['mail']))
        {
            $this->form_validation->set_message('edit_check', 'Zadaný e-mail už je obsadený');
            return false;
        }

        return true;
    }

    public function user_delete($userID)
    {
        $this->user_model->delete($userID);
        redirect('admin/users/?search=' . $this->input->get('search'), 'refresh');
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
