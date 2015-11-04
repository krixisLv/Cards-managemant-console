<?php
/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 11/2/2015
 * Time: 12:36 PM
 */

include "functions.php";
include_once "header.php";

$status_types = getStatusTypes();

$series = (isset($_POST['series']) && is_numeric($_POST['series']) ? $_POST['series'] : null);
$status = (isset($_POST['status']) && $_POST['status'] != 0 ? $_POST['status'] : null);
$number = (isset($_POST['number']) && is_numeric($_POST['number']) ? $_POST['number'] : null);
$issue =  (isset($_POST['date']) ? strtotime($_POST['date']) : null);
$exp =  (isset($_POST['exp']) ? strtotime($_POST['exp']) : null);

?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<form action="search.php" method="post">
    <table id="search_table">
        <tr>
            <td>Series</td>
            <td><input name="series" id="series" type="text" placeholder="card series"></td>
        </tr>
        <tr>
            <td>Number</td>
            <td><input name="number" id="number" type="text" placeholder="card number"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="status" id="status">
                    <option value="0"></option>
                    <?php
                        foreach($status_types as $row){
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Issue date</td><td><input name="date" type="text" id="datepicker1"></td>
        </tr>
        <tr>
            <td>Expiration date</td><td><input name="exp" type="text" id="datepicker2"></td>
        </tr>
    </table>
    <input type="submit" value="Submit">
</form>


<script type="text/javascript">

    $(function() {
        var $j = jQuery.noConflict();
        $j( "#datepicker1" ).datepicker();
        $j( "#datepicker2" ).datepicker();
    });

</script>


<?php

if(isset($_POST)){

    //$data = getCardList($series, $status, $number, $issue, $exp);
    include "cards.php";
}



include_once "footer.php";
?>
