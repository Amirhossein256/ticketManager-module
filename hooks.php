<?php

use Illuminate\Database\Capsule\Manager as Capsule;


add_hook('AdminAreaViewTicketPage', 1, function ($vars) {

    $tags = Capsule::table('mod_tags')
        ->get();

    $ticket = Capsule::table('mod_ticketManager')
        ->where('ticket_id', $vars['ticketid'])
        ->first();
    ob_start();
    include __DIR__ . '/views/home.php';
    $output = ob_get_contents();
    ob_end_clean();

    return $output;

});
