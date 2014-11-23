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
        $menu_items = $this->menu->load($privileges);

        $data = array(
            'title' => 'Home',
            'menu_items' => $menu_items
        );
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('footer');
    }
}

?>
