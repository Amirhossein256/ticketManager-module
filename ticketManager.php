<?php

use Illuminate\Database\Capsule\Manager as Capsule;

function ticketManager_config()
{
    return [
        // Display name for your module
        'name' => 'ticker Manager module',
        // Description displayed within the admin interface
        'description' => 'This module provides an example WHMCS Addon Module'
            . ' which can be used as a basis for building a custom addon module.',
        // Module author name
        'author' => 'amirhossein',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0',
    ];

}

function ticketManager_activate()
{
    include __DIR__ . '/lib/functions.php';

    try {
        createTableTicketManager();
        createTableTags();
        return [
            'status' => 'success',
            'description' => 'moddooole shoma ba movafaghiat faal shod XD enjoy Use :)'
        ];
    } catch (\Exception $e) {
        return [
            'status' => "error",
            'description' => 'Unable to create mod_ticketManager: ' . $e->getMessage(),
        ];
    }
}


function ticketManager_deActivate()
{

}

function ticketManager_output($vars)
{

    if (isset($_POST['ticketId']) and !empty($_POST['status'])) {
        try {
            Capsule::table('mod_ticketManager')->updateOrInsert([
                'ticket_id' => $_POST['ticketId'],
            ],
                [
                    'status' => $_POST['status'],
                    'created_at' => \Carbon\Carbon::now()
                ]);
            echo json_encode(['ok']);
            http_response_code(200);
            die();
        } catch (\Throwable $e) {
            echo json_encode(['errors' => $e->getMessage()]);
            http_response_code(422);
            die();
        }
    }

    if (isset($_POST['newTag']) and !empty($_POST['newTag'])) {
        Capsule::table('mod_tags')->insert([
            'tag' => trim($_POST['newTag']),
            'created_at' => \Carbon\Carbon::now()
        ]);
        echo json_encode(['ok']);
        http_response_code(200);
        die();
    }

    $tags = Capsule::table('mod_tags')
        ->get();
    $tickets = Capsule::table('mod_ticketManager')
        ->get();

    if ($_GET['action'] == "add") {

        include __DIR__ . "/views/addNewTag.php";
    } else {

        include __DIR__ . "/views/dashboard.php";
    }
}