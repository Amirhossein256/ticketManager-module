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

<ul id='menu'>
    <?php
    foreach ($tags as $tag) {
        echo "<li>$tag->tag</li>";
    }
    ?>
</ul>

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
        $("#menu").append("<li>" + value + "</li>");
    })
</script>