<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuItem
{
    public $name;
    public $link;

    public function __construct($name, $link)
    {
        $this->name = $name;
        $this->link = $link;
    }
}

class Menu
{
    protected $menus;

    public function __construct()
    {
        $this->menus['menu_main'] = array(
            // Student privileges
            array(
                new MenuItem('Novinky', 'home'),
                new MenuItem('Rozvrh', 'home'),
                new MenuItem('Profil', 'home'),
                new MenuItem('Odhlásiť', 'logout')
            ),
            // Professor privileges
            array(
                new MenuItem('Novinky', 'home'),
                new MenuItem('Rozvrh', 'home'),
                new MenuItem('Akcie', 'home'),
                new MenuItem('Profil', 'home'),
                new MenuItem('Odhlásiť', 'logout')
            ),
            // Admin privileges
            array(
                new MenuItem('Novinky', 'home'),
                new MenuItem('Rozvrh', 'home'),
                new MenuItem('Akcie', 'home'),
                new MenuItem('Administrácia', 'admin'),
                new MenuItem('Profil', 'home'),
                new MenuItem('Odhlásiť', 'logout')
            )
        );

        $this->menus['menu_admin'] = array(
            // Student privileges
            array(),
            // Professor privileges
            array(),
            // Admin privileges
            array(
                new MenuItem('Užívatelia', 'admin/users'),
                new MenuItem('Obnova', 'admin/reset'),
            )
        );
    }

    public function load($menu_name, $privileges)
    {
        if ($privileges > 2)
            return false;

        if (!array_key_exists($menu_name, $this->menus))
            return false;

        return $this->menus[$menu_name][$privileges];
    }
}

?>
