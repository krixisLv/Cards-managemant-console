<?php
/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 11/2/2015
 * Time: 12:35 PM
 */

include "functions.php";
include_once "header.php";

$data = array();
if(isset($_GET['id']) && is_numeric($_GET['id'])) {

    $data = getCardActivity($_GET['id']);

}
?>

<div id="profile">
    <?php if(count($data) == 0) echo "<div style='font-size:17px; color:blue; margin-top:40px;'>No activity in database</div>";?>
    <h3>Card activity:</h3>

    <table id="profile_table" cellspacing="5" cellpadding="3">
        <thead>
        <tr>
            <th>Number</th>
            <th>Info</th>
            <th>Date</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($data) > 0) {
            foreach ($data as $row) {
                $row_html = "";
                $row_html = getProfileRowHtml($row);
                echo $row_html;
            }
        }
        ?>
        </tbody>
    </table>

</div>

<?php

include_once "footer.php";

?>