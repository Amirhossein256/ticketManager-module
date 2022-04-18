<?php include __DIR__ . "/navBar.php"?>

<div class="btn-group float-right" role="group" aria-label="...">
    <form action="#" method="get">
        <?php
        foreach ($tags as $tag) {
            echo "<a style='margin: 5px;' class='btn btn-default btn-danger' href='addonmodules.php?module=ticketManager&filter={$tag->tag}'> {$tag->tag} </a>";
        }
        ?>

    </form>
</div>
<?php
//var_dump($tickets);
//die();
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Ticket Id</th>
        <th scope="col">Status</th>
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
        <td>$ticket->created_at</td>
    </tr>
        ";
    }
    ?>


    </tbody>
</table>
