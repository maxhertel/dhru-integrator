<?php
/**
 * backend/config.php
 *
 * Author: pixelcave
 *
 * Backend pages configuration file
 *
 */

// **************************************************************************************************
// INCLUDED VIEWS
// **************************************************************************************************

$one->inc_side_overlay           = 'inc/backend/views/inc_side_overlay.php';
$one->inc_sidebar                = 'inc/backend/views/inc_sidebar.php';
$one->inc_header                 = 'inc/backend/views/inc_header.php';
$one->inc_footer                 = 'inc/backend/views/inc_footer.php';


// **************************************************************************************************
// MAIN CONTENT
// **************************************************************************************************

$one->l_m_content                = 'narrow';


// **************************************************************************************************
// MAIN MENU
// **************************************************************************************************

$one->main_nav                   = array(
    array(
        'name'  => 'Dashboard',
        'icon'  => 'si si-speedometer',
        'url'   => 'main.php'
    ),
	array(
        'name'  => 'Services',
        'icon'  => 'fab fa-hubspot',
        'url'   => 'services.php'
    ),
	array(
        'name'  => 'Orders',
        'icon'  => 'fa fa-cart-shopping',
        'url'   => 'orders.php'
    )
);
