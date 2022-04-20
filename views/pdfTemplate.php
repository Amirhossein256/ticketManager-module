<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Ticket Id</th>
        <th scope="col">Client Status</th>
        <th scope="col">subject</th>
        <th scope="col">Name</th>
        <th scope="col">Ticket Status</th>
        <th scope="col">Created At</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach ($tickets as $ticket) {

        echo "
     <tr>
        <th scope='row'>$ticket->id</th>
        <td>$ticket->ticket_id</td>
        <td>$ticket->status</td>
        <td>$ticket->title</td>
        <td>$ticket->firstname</td>
        <td>$ticket->cstatus</td>
        <td>$ticket->created_at</td>
    </tr>
        ";
    }
    ?>


    </tbody>
</table>
