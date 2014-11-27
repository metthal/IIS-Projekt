<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!check_login())
            redirect('login', 'refresh');


        $privileges = $this->user_model->privileges(login_data('id'));
        $menu_items = $this->menu->load('menu_main', $privileges);

        $data = array(
            'title' => 'Home',
            'menu_items' => $menu_items,
            'menu_item_selected' => 'home'
        );
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('home_view', $data);
        $this->load->view('footer');
    }
}

?>
