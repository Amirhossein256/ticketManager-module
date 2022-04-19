<?php include __DIR__ . "/navBar.php" ?>

<div class="row">
    <div class="col-lg-6">
        <div class="input-group">
            <input id="addNewBtn" type="text" class="form-control" placeholder="Add New Tag...">
            <span class="input-group-btn">
        <button id="addNew" class="btn btn-default" type="button">Add</button>
      </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Tag Name</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>

    </tr>
    </thead>
    <tbody>
    <?php

    foreach ($tags as $tag) {
        echo "
     <tr id='menu'>
        <td>$tag->id</td>
        <td>$tag->tag</td>
        <td>$tag->created_at</td>
        <td><a class='btn btn-danger delete' onclick='deleteItem($tag->id)' deleted='$tag->id'> delete </a></td>

    </tr>
        ";
    }
    ?>

    </tbody>
</table>

<script>
    $('#addNew').click(function (e) {
        e.preventDefault()
        var value = $('#addNewBtn').val();
        $.ajax({
            url: "addonmodules.php?module=ticketManager",
            cache: false,
            type: "POST",
            data: {
                newTag: value
            },
        })
        $('#addNewBtn').val(null);
        location.reload();
    })

    function deleteItem(id) {
        $.ajax({
            url: "addonmodules.php?module=ticketManager",
            cache: false,
            type: "POST",
            data: {
                deleted: id
            },
        })
        location.reload();
    }
</script>