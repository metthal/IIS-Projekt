<ul>
<?php

foreach ($submenu_items as $menu_item)
{
    echo '<li style="display: inline;"><a href="', site_url() . $menu_item->link, '">', $menu_item->name, '</a></li>', PHP_EOL;
}

?>
</ul>
