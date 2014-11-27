<div id="submenu_wrapper">
<ul id="submenu">
<?php

foreach ($submenu_items as &$menu_item)
{
    echo '<li><a href="', site_url() . $menu_item->link, '">', $menu_item->name, '</a></li>', PHP_EOL;
}

?>
</ul>
</div>
