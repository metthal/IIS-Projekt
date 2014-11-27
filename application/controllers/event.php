<?php

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index($subaction = '')
    {
        if (!check_login())
            redirect('login', 'refresh');

        $privileges = $this->user_model->privileges(login_data('id'));
        $menu_items = $this->menu->load('menu_main', $privileges);

        $data = array(
            'title' => 'Akcie',
            'menu_items' => $menu_items,
            'menu_item_selected' => 'event'
        );

        $this->load->view('header', $data);
        $this->load->view('menu', $data);

        if (func_num_args() >= 2)
        {
            $args = func_get_args();
            if ($subaction == 'edit')
                $this->event_edit($args[1]);
            else if ($subaction == 'delete')
                $this->event_delete($args[1]);
            else if ($subaction == 'new')
                $this->event_new();
            else
                $this->events();
        }
        else if ($subaction == 'new')
            $this->event_new();
        else
            $this->events();

        $this->load->view('footer');
    }

    public function events()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim');

        $search = $this->input->get('search');
        if ($search == false)
            $events = $this->event_model->eventlist();
        else
        {
            $this->form_validation->run();
            $events = $this->event_model->eventlist($search);
        }

        $data = array(
            'subtitle' => 'Akcie',
            'search' => $search,
            'events' => $events,
            'can_create' => ($this->user_model->privileges(login_data('id')) == 0 ? false : true)
        );

        $this->load->view('events_view', $data);
    }

    public function event_new()
    {
        $data = array(
            'subtitle' => 'Pridať akciu',
            'search' => $this->input->get('search'),
            'subjects' => $this->subject_model->subjectlist(),
            'rooms' => $this->room_model->roomlist()
        );

        if ($this->input->post('new_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('subject', 'Subject', 'trim');
            $this->form_validation->set_rules('date', 'Date', 'trim');
            $this->form_validation->set_rules('user', 'User', 'trim');
            $this->form_validation->set_rules('record', 'Record', 'trim');
            $this->form_validation->set_rules('stream', 'Stream', 'trim|callback_check_new_event');

            if ($this->form_validation->run() != false)
            {
                $new_data = $this->input->post(NULL) + array(
                    'schedule_date' => date('Y-m-d H:i', strtotime($this->input->post('date') . ' ' . $this->input->post('hour') . ':00')),
                    'book_date' => date('Y-m-d H:i:s')
                );
                $this->event_model->add($new_data);
                redirect('event/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('event_new_view', $data);
    }

    public function event_edit($eventID)
    {
        $search = $this->input->get('search');
        $event = $this->event_model->get($eventID);
        if ($event == false)
            redirect('admin/subject/?search=' . $search, 'refresh');

        $data = array(
            'subtitle' => 'Upraviť akciu',
            'search' => $search,
            'event' => $event,
            'subjects' => $this->subject_model->subjectlist(),
            'rooms' => $this->room_model->roomlist(),
            'schedules' => $this->event_model->schedules_for($eventID)
        );

        if ($this->input->post('edit_request'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim');
            $this->form_validation->set_rules('subject', 'Subject', 'trim');
            $this->form_validation->set_rules('date', 'Date', 'trim');
            $this->form_validation->set_rules('user', 'User', 'trim');
            $this->form_validation->set_rules('record', 'Record', 'trim');
            $this->form_validation->set_rules('stream', 'Stream', 'trim|callback_check_new_event');

            if ($this->form_validation->run() != false)
            {
                $event_data = $this->input->post(NULL) + array(
                    'schedule_date' => date('Y-m-d H:i', strtotime($this->input->post('date') . ' ' . $this->input->post('hour') . ':00')),
                );
                $this->event_model->edit($eventID, $event_data);
                redirect('event/?search=' . $this->input->get('search'), 'refresh');
            }
        }

        $this->load->view('event_edit_view', $data);
    }

    public function event_delete($eventID)
    {
        $this->event_model->delete($eventID);
        redirect('event/?search=' . $this->input->get('search'), 'refresh');
    }

    public function check_new_event($dummy)
    {
        $new_data = $this->input->post(NULL);

        if ($new_data['name'] == '')
        {
            $this->form_validation->set_message('check_new_event', 'Názov nemôže byť prázdny');
            return false;
        }

        if ($new_data['date'] == '')
        {
            $this->form_validation->set_message('check_new_event', 'Dátum konania nemôže byť prázdny');
            return false;
        }

        if (!preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $new_data['date']))
        {
            $this->form_validation->set_message('check_new_event', 'Dátum konania je v zlom formáte');
            return false;
        }

        if ($new_data['hour'] == '')
        {
            $this->form_validation->set_message('check_new_event', 'Hodina konania nemôže byť prázdna');
            return false;
        }

        if (!preg_match('/^\d{1,2}$/', $new_data['hour']))
        {
            $this->form_validation->set_message('check_new_event', 'Hodina konania je v zlom formáte');
            return false;
        }

        if ($new_data['duration'] == '')
        {
            $this->form_validation->set_message('check_new_event', 'Trvanie nemôže byť prázdne');
            return false;
        }

        if ($new_data['record'] == '')
        {
            $this->form_validation->set_message('check_new_event', 'Record');
            return false;
        }

        if ($new_data['stream'] == '')
        {
            $this->form_validation->set_message('check_new_event', 'Stream');
            return false;
        }

        if ($new_data['rooms'] == '')
        {
            $this->form_validation->set_message('check_new_event', 'Rooms');
            return false;
        }

        return true;
    }
}
