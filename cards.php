<?php
/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 11/2/2015
 * Time: 12:51 PM
 */

$conn = getConnection();

$series = (isset($series) && $series != "" && !is_null($series) ? $series : null);
$status = (isset($status) && $status != "" && !is_null($status) ? $status : null);
$number = (isset($number) && $number != "" && !is_null($number) ? $number : null);
$issue = (isset($issue) && $issue != "" && !is_null($issue) ? $issue : null);
$exp = (isset($exp) && $exp != "" && !is_null($exp) ? $exp : null);

$data = getCardList($series, $status, $number, $issue, $exp);
?>


<table id="cards_table" cellspacing="5" cellpadding="3">
    <thead>
    <tr>
        <th>Number</th>
        <th>Series</th>
        <th>Issue date</th>
        <th>Expiration date</th>
        <th>Status</th>
        <th></th>
        <th></th>
        <th class="wide"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($data as $row){
        $row_html = "";
        $row_html = getRowHtml($row);
        echo $row_html;
    }
    ?>
    </tbody>
</table>

<script type="text/javascript">

    jQuery.noConflict();
    jQuery(function ($) {
        $(document).ready(function () {
            $('.toggle').on('click', function () {
                var id = $(this).closest('tr').attr('id');
                //console.log("id = " + id);
                toggleCard(id);
            })

            $('.delete').on('click', function () {
                var id = $(this).closest('tr').attr('id');
                //console.log("id = " + id);
                deleteCard(id);
            })
        });


        function deleteCard(id) {
            $.ajax({
                type: 'POST',
                url: 'card_operations.php',
                data: {
                    'id': id,
                    'action': 'delete'
                },
                success: function (msg) {
                    $("#" + id).remove();
                    //alert("card deleted!");
                }
            });
        }

        function toggleCard(id) {
            var status = $("#" + id + " .status");
            var new_status_id = 1;
            //console.log(status.html());
            if (status.html() == "active") {
                new_status_id = 2;
            }

            //console.log("new_status = " + new_status_id);

            $.ajax({
                type: 'POST',
                url: 'card_operations.php',
                data: {
                    'id': id,
                    'action': 'toggle',
                    'value': new_status_id
                },
                success: function (msg) {
                    status.html(status.html() == "active" ? "inactive" : "active");
                }
            });
        }
    });

</script>