<?php include __DIR__ . "/navBar.php" ?>

<div class="btn-group float-right" role="group" aria-label="...">
    <form action="#" method="get">
        <a style='margin: 5px;' class='btn btn-default btn-primary' href='addonmodules.php?module=ticketManager'>
            All </a>
        <!-- Single button -->
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                Filter <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <?php
                foreach ($tags as $tag) {
                    echo "<li><a style='margin: 5px;' href='addonmodules.php?module=ticketManager&filter={$tag->tag}'> {$tag->tag}</a></li>";
                }
                ?>
            </ul>
        </div>
    </form>
</div>

<button class="btn btn-success" onclick="excel()"> Export Excel</button>
<button class="btn btn-warning" onclick="excel()"> Export Pdf</button>


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
        <th scope="col">Show</th>
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
        <td><a class='btn btn-success' href='supporttickets.php?action=view&id=$ticket->ticket_id'>show</a></td>
    </tr>
        ";
    }
    ?>


    </tbody>
</table>

<div class="row">
    <div class="col-lg-1">
        <form action="addonmodules.php?module=ticketManager" method="post" enctype="multipart/form-data">
            <div class="input-group">
               <input name="file" value="Import Exel" type="file" class="btn btn-default"/>
                <span class="input-group-btn">
        <button id="addNew" class="btn btn-primary" type="submit">Add</button>
      </span>
            </div><!-- /input-group -->
        </form>
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php
        $negativePage = $_GET["page"] - 1;
        $PositivePage = $_GET["page"] + 1;

        if (isset($_GET['filter'])) {
            echo "
         <li class='page-item'><a class='page-link' href='addonmodules.php?module=ticketManager&filter=$_GET[filter]&page=$negativePage'>Previous</a></li>
        <li class='page-item'><a class='page-link' href='addonmodules.php?module=ticketManager&filter=$_GET[filter]&page=$PositivePage'>Next</a></li>
            ";
        } else {
            echo "
         <li class='page-item'><a class='page-link' href='addonmodules.php?module=ticketManager&page=$negativePage'>Previous</a></li>
        <li class='page-item'><a class='page-link' href='addonmodules.php?module=ticketManager&page=$PositivePage'>Next</a></li>
            ";
        }
        ?>

    </ul>
</nav>
<script>
    function excel() {
        var thisLink = window.location.href;
        window.location = thisLink + '&excel=true';
    }
</script>