<?php

class Timetable extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!check_login())
            redirect('login', 'refresh');

        $data = array(
            'title' => 'Rozvrh',
            'menu_items' => $this->menu->load('menu_main', $this->user_model->privileges(login_data('id'))),
            'rooms' => $this->room_model->roomlist()
        );

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('timetable_view', $data);
        $this->load->view('footer');
    }

    public function get($roomID)
    {
        if (!check_login())
            return;

        $events = $this->room_model->schedules_for($roomID);
        $data = array(
            'events' => $events
        );

        $this->load->view('timetable_get_view', $data);
    }
}
