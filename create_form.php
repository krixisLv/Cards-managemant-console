<?php
/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 11/2/2015
 * Time: 2:51 PM
 */

include "functions.php";
include_once "header.php";

$card_types = getCardTypes();

if(isset($_POST['count'])){
    $interval = 0;
    foreach($card_types as $row){
        if($_POST['exp_time'] == $row['id']){
            $interval = $row['exp_interval'];
        };
    }

    if(is_numeric($_POST['count'])) {
        $series = generateCards($_POST['count'], $interval);
    }
}

?>

<form id="cards_create_form" action="create_form.php" method="post">
    <table id="cards_create_table" cellspacing="0" cellpadding="3">
        <tr>
            <td class="cell_label alignright">Count</td>
            <td class="cell_value"><input type="text" name="count" id="count"></td>
        </tr>
        <tr>
            <td class="cell_label alignright">Expiration period</td>
            <td class="cell_value">
                <select name="exp_time" id="exp_time">
                    <?php
                        foreach($card_types as $row){
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="cell_label"></td>
            <td class="cell_value"><input type="submit" value="Generate"></td>
        </tr>
    </table>
</form>

<?php

if(isset($series)) {
    include_once "cards.php";
}

include_once "footer.php";
?>