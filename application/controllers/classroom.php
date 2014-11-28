<?php

class Classroom extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
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
            'submenu_items' => $submenu_items,
            'menu_item_selected' => 'classroom'
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
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->access_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->access_delete($args[2]);
                else if ($subaction == 'new')
                    $this->acces_new();
                else
                    $this->access();
            }
            else if ($subaction == 'new')
                $this->access_new();
            else
                $this->access();
        }

        else if ($action == 'typeaccess')
        {
            if (func_num_args() >= 3)
            {
                $args = func_get_args();
                if ($subaction == 'edit')
                    $this->typeaccess_edit($args[2]);
                else if ($subaction == 'delete')
                    $this->typeaccess_delete($args[2]);
                else if ($subaction == 'new')
                    $this->typeacces_new();
                else
                    $this->typeaccess();
            }
            else if ($subaction == 'new')
                $this->typeaccess_new();
            else
                $this->typeaccess();
        }

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

        $accesses = $this->access_model->accesslist();
        $data = array(
            'subtitle' => 'Učebne',
            'search' => $search,
            'rooms' => $rooms,
            'accesses' => $accesses,
            'can_create' => ($this->user_model->privileges(login_data('id')) == 0 ? false : true)
        );
        $this->load->view('classroom_rooms_view', $data);
    }

    public function room_delete($roomID)
    {
        $this->room_model->room_delete($roomID);
        redirect('classroom/rooms/?search=' . $this->input->get('search'), 'refresh');
    }

    public function room_edit($roomID)
    {
        $search = $this->input->get('search');
        $room = $this->room_model->room_get($roomID);
        if ($room == false)
            redirect('classroom/rooms/?search=' . $search, 'refresh');

        $data = array(
            'subtitle' => 'Upraviť učebňu',
            'search' => $search,
            'room' => $room,
            'accesses' => $this->access_model->accesslist(),
            'rooms' => $this->room_model->rooms_for($roomID)
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('side', 'Kridlo', 'trim');
            $this->form_validation->set_rules('room_no', 'Cislo ucebne', 'trim');
            $this->form_validation->set_rules('capacity', 'Kapacita ucebne', 'trim');

            if ($this->form_validation->run() != false)
            {
                $room = $this->input->post(NULL);
                $this->room_model->room_edit($roomID, $room);
                redirect('classroom/rooms/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('classroom_rooms_edit_view', $data);
    }

    public function room_new()
    {
        $data = array(
            'subtitle' => 'Pridať učebňu',
            'search' => $this->input->get('search'),
            'accesses' => $this->access_model->accesslist_is_null()
        );

        if ($this->input->post('new_request'))
        {

            $this->form_validation->set_rules('side', 'Kridlo', 'trim');
            $this->form_validation->set_rules('room_no', 'Cislo ucebne', 'trim');
            $this->form_validation->set_rules('capacity', 'Kapacita ucebne', 'trim');

            if ($this->form_validation->run() != false)
            {
                $this->room_model->room_add($this->input->post(NULL));
                redirect('classroom/rooms/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('classroom_rooms_new_view', $data);
    }

    public function access()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');

        if ($search == false)
            $access = $this->access_model->accesslist();
        else
        {
            $this->form_validation->run();
            $access = $this->access_model->accesslist($search);
        }

        $typeaccesses = $this->typeaccess_model->typeaccesslist();
        $data = array(
            'subtitle' => 'Príslušenstvo',
            'search' => $search,
            'accesss' => $access,
            'typeaccesses' => $typeaccesses,
            'can_create' => ($this->user_model->privileges(login_data('id')) <= 1 ? false : true)
        );

        $this->load->view('classroom_access_view', $data);
    }

    public function access_delete($accessID)
    {
        $this->access_model->access_delete($accessID);
        redirect('classroom/access/?search=' . $this->input->get('search'), 'refresh');
    }

    public function access_edit($accessID)
    {
        $search = $this->input->get('search');
        $access = $this->access_model->access_get($accessID);
        if ($access == false)
            redirect('classroom/access/?search=' . $search, 'refresh');

        $data = array(
            'subtitle' => 'Upraviť príslušenstvo',
            'search' => $search,
            'access' => $access,
            'typeaccesses' => $this->typeaccess_model->typeaccesslist()
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('access_type', 'Typ prislusenstva', 'trim');
            $this->form_validation->set_rules('access_serial_no', 'Seriove cislo prislusenstva', 'trim');

            if ($this->form_validation->run() != false)
            {
                $access = $this->input->post(NULL);
                $this->access_model->access_edit($accessID, $access);
                redirect('classroom/access/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('classroom_access_edit_view', $data);
    }

    public function access_new()
    {
        $data = array(
            'subtitle' => 'Pridať príslušenstvo',
            'search' => $this->input->get('search'),
            'typeaccesses' => $this->typeaccess_model->typeaccesslist()
        );

        if ($this->input->post('new_request'))
        {
            $this->form_validation->set_rules('access_type', 'Typ prislusenstva', 'trim');
            $this->form_validation->set_rules('access_serial_no', 'Seriove cislo', 'trim');
            $this->form_validation->set_rules('access_classroom', 'Cislo ucebne', 'trim');

            if ($this->form_validation->run() != false)
            {
                $this->access_model->access_add($this->input->post(NULL));
                redirect('classroom/access/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('classroom_access_new_view', $data);
    }

    public function typeaccess()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');

        if ($search == false)
            $typeaccess = $this->typeaccess_model->typeaccesslist();
        else
        {
            $this->form_validation->run();
            $typeaccess = $this->typeaccess_model->typeaccesslist($search);
        }

        $data = array(
            'subtitle' => 'Typ príslušenstva',
            'search' => $search,
            'typeaccesses' => $typeaccess,
            'can_create' => ($this->user_model->privileges(login_data('id')) <= 1 ? false : true)
        );

        $this->load->view('classroom_typeaccess_view', $data);
    }

    public function typeaccess_delete($typeaccessID)
    {
        $this->typeaccess_model->typeaccess_delete($typeaccessID);
        redirect('classroom/typeaccess/?search=' . $this->input->get('search'), 'refresh');
    }

    public function typeaccess_edit($typeaccessID)
    {
        $search = $this->input->get('search');
        $typeaccess = $this->typeaccess_model->typeaccess_get($typeaccessID);
        if ($typeaccess == false)
            redirect('classroom/typeaccess/?search=' . $search, 'refresh');

        $data = array(
            'subtitle' => 'Upraviť príslušenstvo',
            'search' => $search,
            'typeaccess' => $typeaccess
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('typeaccess_name', 'Nazov typu prislusenstva', 'trim');

            if ($this->form_validation->run() != false)
            {
                $typeaccess = $this->input->post(NULL);
                $this->typeaccess_model->typeaccess_edit($typeaccessID, $typeaccess);
                redirect('classroom/typeaccess/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('classroom_typeaccess_edit_view', $data);
    }

    public function typeaccess_new()
    {
        $data = array(
            'subtitle' => 'Pridať príslušenstvo',
            'search' => $this->input->get('search')
        );

        if ($this->input->post('new_request'))
        {
            $this->form_validation->set_rules('typeaccess_name', 'Nazov typu prislusenstva', 'trim');

            if ($this->form_validation->run() != false)
            {
                $this->typeaccess_model->typeaccess_add($this->input->post(NULL));
                redirect('classroom/typeaccess/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('classroom_typeaccess_new_view', $data);
    }
}

?>
