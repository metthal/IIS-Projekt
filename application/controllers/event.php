<?php

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($action = 'action', $subaction = '')
    {
        if (!check_login())
            redirect('login', 'refresh');

        $privileges = $this->user_model->privileges(login_data('id'));
        $menu_items = $this->menu->load('menu_main', $privileges);
        $submenu_items = $this->menu->load('menu_classroom', $privileges);

        $data = array(
            'title' => 'Učebne',
            'menu_items' => $menu_items,
            'submenu_items' => $submenu_items
        );

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('submenu', $data);

        if ($action == 'action')
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->action_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->action_delete($args[2]);
                else if ($subaction == 'new')
                    $this->action_new();
                else
                    $this->actions();
            }
            else if ($subaction == 'new')
                $this->action_new();
            else
                $this->actions();
        }
        else if ($action == 'list')
            $this->eventlist();

        $this->load->view('footer');
    }

    public function actions()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $rooms = $this->action_model->actionlist();
        else
        {
            $this->form_validation->run();
            $rooms = $this->action_model->actionlist($search);
        }

        $data = array(
            'search' => $search,
            'actions' => $actions,
            'can_create' => ($this->user_model->privileges(login_data('id')) == 0 ? false : true)
        );
        $this->load->view('event_actions_view', $data);
    }
}

?>
