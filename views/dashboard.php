<?php include __DIR__ . "/navBar.php" ?>

<div class="btn-group float-right" role="group" aria-label="...">
    <form action="#" method="get">
      <a style='margin: 5px;' class='btn btn-default btn-primary' href='addonmodules.php?module=ticketManager'> All </a>

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
        <th scope="col">subject</th>
        <th scope="col">Name</th>
        <th scope="col">Department</th>
        <th scope="col">Created At</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($tickets as $ticket) {
        $command = 'GetTicket';
        $postData = array(
            'ticketid' => $ticket->id,
        );
        $results = localAPI($command, $postData);

        echo "
     <tr>
        <th scope='row'>$ticket->id</th>
        <td>$ticket->ticket_id</td>
        <td>$ticket->status</td>
        <td>$results[subject]</td>
        <td>$results[name]</td>
        <td>$results[deptname]</td>
        <td>$ticket->created_at</td>
    </tr>
        ";
    }
    ?>


    </tbody>
</table>
