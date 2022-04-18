<?php
$id = $vars['ticketid'];
?>
<form>
    <div class="alert alert-info">
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
                <label class="mr-sm-2" for="inlineFormCustomSelect">وضعیت مشتری</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">

                    <option> انتخاب کنید ...</option>
                    <?php
                    $selected = null;
                    foreach ($tags as $tag) {
                        if ($ticket->status == $tag->tag) {
                            $selected = "selected";
                        }
                        echo "<option value='$tag->tag' $selected> $tag->tag </option> ";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</form>

<script>

    $('#inlineFormCustomSelect').change(function () {
        $.ajax({
            url: "addonmodules.php?module=ticketManager",
            cache: false,
            type: "POST",
            data: {
                ticketId: <?php
                echo $id;
                ?>,
                status: $("#inlineFormCustomSelect").val()
            },
        });
    })
</script>