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
        $this->menus = array(
            // Student privileges
            array(
                new MenuItem('Rozvrh', 'home'),
                new MenuItem('Profil', 'home'),
                new MenuItem('Odhlásiť', 'logout')
            ),
            // Professor privileges
            array(
                new MenuItem('Rozvrh', 'home'),
                new MenuItem('Akcie', 'home'),
                new MenuItem('Profil', 'home'),
                new MenuItem('Odhlásiť', 'logout')
            ),
            // Admin privileges
            array(
                new MenuItem('Rozvrh', 'home'),
                new MenuItem('Akcie', 'home'),
                new MenuItem('Administrácia', 'home'),
                new MenuItem('Profil', 'home'),
                new MenuItem('Odhlásiť', 'logout')
            )
        );
    }

    public function load($privileges)
    {
        if ($privileges > 2)
            return false;

        return $this->menus[$privileges];
    }
}

?>
