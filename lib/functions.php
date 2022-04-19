<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * @return void
 */
function createTableTags(): void
{
    if (!Capsule::Schema()->hasTable('mod_tags')) {
        Capsule::schema()
            ->create(
                'mod_tags',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->string('tag');
                    $table->dateTime('created_at');
                }
            );
    }
}

/**
 * @return void
 */
function createTableTicketManager(): void
{
    if (!Capsule::Schema()->hasTable('mod_ticketManager')) {
        Capsule::schema()
            ->create(
                'mod_ticketManager',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->integer('ticket_id');
                    $table->string('status', 64);
                    $table->dateTime('created_at');
                }
            );
    }
}

/**
 * @return void
 */
function ajaxHandler(): void
{
    if (isset($_POST['deleted']) and !empty($_POST['deleted'])) {
        Capsule::table('mod_tags')
        ->where('id', $_POST['deleted'])
        ->delete();

        echo json_encode(['ok']);
        http_response_code(200);
        die();
    }

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
}


function filterHandler()
{
    include __DIR__ . "/../vendor/autoload.php";

    if (isset($_GET['filter']) and !empty($_GET['filter'])) {
        $tickets = Capsule::table('mod_ticketManager')
            ->join('tbltickets', 'tbltickets.id', '=', 'mod_ticketManager.ticket_id')
            ->join('tblclients', 'tbltickets.userid', '=', 'tblclients.id')
            ->join('tblticketdepartments', 'tbltickets.did', '=', 'tblticketdepartments.id')
            ->select('mod_ticketManager.status',
                'mod_ticketManager.id',
                'mod_ticketManager.ticket_id',
                'mod_ticketManager.created_at',
                'tbltickets.title',
                'tbltickets.status as cstatus',
                'tblclients.firstname'
            )
            ->where('mod_ticketManager.status', $_GET['filter'])
            ->paginate(5, ['*'], 'page', $_GET['page']);

    } else {

            $tickets = Capsule::table('mod_ticketManager')
                ->join('tbltickets', 'tbltickets.id', '=', 'mod_ticketManager.ticket_id')
                ->join('tblclients', 'tbltickets.userid', '=', 'tblclients.id')
                ->join('tblticketdepartments', 'tbltickets.did', '=', 'tblticketdepartments.id')
                ->select('mod_ticketManager.status',
                    'mod_ticketManager.id',
                    'mod_ticketManager.ticket_id',
                    'mod_ticketManager.created_at',
                    'tbltickets.title',
                    'tbltickets.status as cstatus',
                    'tblclients.firstname'
                )
                ->paginate(5, ['*'], 'page', $_GET['page']);
    }
    return $tickets;
}


/**
 * @return void
 */
function addNewTag(): void
{
    if (isset($_POST['newTag']) and !empty($_POST['newTag'])) {
        Capsule::table('mod_tags')->insert([
            'tag' => trim($_POST['newTag']),
            'created_at' => \Carbon\Carbon::now()
        ]);
        echo json_encode(['ok']);
        http_response_code(200);
        die();
    }
}
