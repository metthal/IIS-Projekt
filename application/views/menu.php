<ul id="menu">
<?php

foreach ($menu_items as &$menu_item)
{
    echo '<li class="menu_item"><a ';
    if ($menu_item->link == $menu_item_selected)
        echo 'class="menu_item_selected" ';
    echo 'href="', site_url() . $menu_item->link, '">', $menu_item->name, '</a></li>', PHP_EOL;
}

?>
</ul>
</div>
