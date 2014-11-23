<?php

foreach ($menu_items as &$menu_item)
{
    echo '<a href="', $menu_item->link, '">', $menu_item->name, '</a><br>', PHP_EOL;
}

?>
