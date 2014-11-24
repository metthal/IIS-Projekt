<?php

class Classroom extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($action = 'rooms', $subaction = '')
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

        if ($action == 'rooms')
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->room_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->room_delete($args[2]);
                else if ($subaction == 'new')
                    $this->room_new();
                else
                    $this->rooms();
            }
            else if ($subaction == 'new')
                $this->room_new();
            else
                $this->rooms();
        }
        else if ($action == 'access')
            $this->access();

        $this->load->view('footer');
    }

    public function rooms()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $rooms = $this->room_model->roomlist();
        else
        {
            $this->form_validation->run();
            $rooms = $this->room_model->roomlist($search);
        }

        $data = array(
            'search' => $search,
            'rooms' => $rooms,
            'can_create' => ($this->user_model->privileges(login_data('id')) == 0 ? false : true)
        );
        $this->load->view('classroom_rooms_view', $data);
    }
}

?>
