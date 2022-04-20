<?php


use Illuminate\Database\Capsule\Manager as Capsule;
use Rap2hpoutre\FastExcel\FastExcel;

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
            'description' => 'Activate successfully enjoy Use :)'
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
    $baseUrl = 'http://127.0.0.1/whmcs';

    include __DIR__ . '/lib/functions.php';
    include __DIR__ . '/vendor/autoload.php';

    ajaxHandler();
    addNewTag();
    fileImportHandler();


    $tags = Capsule::table('mod_tags')
        ->get();
    $tickets = filterHandler();

    if ($_GET['excel']) {
        (new FastExcel(collect($tickets)->toArray()['data']))->export(__DIR__ . '/storage/file.xlsx');
        header('Location: ' . $baseUrl . '/modules/addons/ticketManager/storage/file.xlsx');
    }

    if ($_GET['pdf']) {

        $tickets = getAllTickets();

        ob_start();
        include __DIR__ . '/views/pdfTemplate.php';
        $output = ob_get_contents();
        ob_end_clean();

        $mpdf = new mPDF('ar-s', 'A4');
        $mpdf->SetDirectionality('rtl');
        $mpdf->WriteHTML($output);

        header('Content-Type: application/pdf');
        echo $mpdf->Output();

        die();
    }

    if ($_GET['action'] == "add") {

        include __DIR__ . "/views/addNewTag.php";
    } else {

        include __DIR__ . "/views/dashboard.php";
    }
}

