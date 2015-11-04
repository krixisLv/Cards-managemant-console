<?php
/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 11/2/2015
 * Time: 2:22 PM
 */

function getRowHtml($row){
    $html = "";

    //date("d.m.Y", $row->time_begin)
    $html .= makeTableData($row["number"], 'number');
    $html .= makeTableData($row["series"], 'series');
    $html .= makeTableData( date("d.m.Y", $row["issue_date"]), 'issue' );
    $html .= makeTableData( date("d.m.Y", $row["exp_date"]), 'exp' );
    $html .= makeTableData($row["status"], 'status');
    $html .= makeTableDataButton("view", $row["number"], 'view');
    $html .= makeTableDataButton("delete", $row["number"], 'delete');
    $html .= makeTableDataButton("activate", $row["number"], 'toggle');

    $html = "<tr id='".$row['number']."'>" . $html . "</tr>";
    return $html;
}

function getProfileRowHtml($row){
    $html = "";

    $html .= makeTableData($row["info"], 'info');
    $html .= makeTableData( date("d.m.Y", $row["date"]), 'date' );
    $html .= makeTableData($row["amount"], 'amount');

    $html = "<tr id='".$row['id']."'>" . $html . "</tr>";
    return $html;
}

function makeTableData($data, $class ){

    $html = "<td class='". $class ."''>".$data."</td>";
    return $html;
}

function makeTableDataButton($type, $id){
    if($type == "view"){
        return "<td> <a class='submit_button' style='width: 50px;' href='profile.php?id=$id'>View</a></td>";
    } else if($type == "delete"){
        return "<td> <a class='submit_button delete' style='width: 50px;' href='javascript:void(0);'>Delete</a></td>";
    } else if($type == "activate"){
        return "<td class='wide'> <a class='submit_button toggle' style='width: 50px;' href='javascript:void(0);'>Toggle status</a></td>";
        //return "<td> <a class='submit_button' style='width: 50px;' href='card_operations.php?id=$id&action=toggle&value=2'>Toggle status</a></td>";
    }
}

function getCardActivity($number){
    $conn = getConnection();

    $data = array();
    $query = "SELECT id, card_number, info, UNIX_TIMESTAMP(date) date, amount FROM card_deals WHERE card_number = " . $number;
    try {
        $stmt = $conn->query($query);
        $data = $stmt->fetchAll();
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }

    return $data;
}

function generateCards($count, $interval){
    $conn = getConnection();

    $query = "SELECT MAX(series) series FROM cards";
    $stmt = $conn->query($query);

    if ($stmt) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $series = $row['series']+1;


        $query = "INSERT INTO cards (series, expiration_date) VALUES ";
        for($i = 0; $i < $count; $i++){
            $query .= ($i>0?",":"")."(".$series.",DATE_ADD(NOW(), INTERVAL ".$interval." DAY))";
        }

        $stmt = $conn->prepare($query);
        $stmt = $stmt->execute();

        return $series;
    }

}

function getCardList($series, $status, $number, $issue, $exp){
    $conn = getConnection();
    // construct query
    $query_base = "SELECT number, series, UNIX_TIMESTAMP(issue_date) issue_date, UNIX_TIMESTAMP(expiration_date) exp_date, ".
                    "(SELECT name FROM card_status_type WHERE id = status) status FROM cards ";

    $query_where = "";
    if(!is_null($series)){
        $query_where = "series = " . $series;
    }
    if(!is_null($status)){
        $query_where .= ($query_where != "" ? " AND " : "") . "status = " . $status;
    }
    if(!is_null($number)){
        $query_where .= ($query_where != "" ? " AND " : "") . "number = " . $number;
    }
    if(!is_null($issue)){
        $query_where .= ($query_where != "" ? " AND " : "") . "date(issue_date) = date(from_unixtime(" . $issue ."))";
    }
    if(!is_null($exp)){
        $query_where .= ($query_where != "" ? " AND " : "") . "date(expiration_date) = date(from_unixtime(" . $exp . "))";
    }

    $query = $query_base . ($query_where != "" ? "WHERE ". $query_where : "" ) . " ORDER BY number ASC";

    $stmt = $conn->query($query);
    $data = $stmt->fetchAll();

    return $data;

}

function getConnection(){
    try {
        $conn = new PDO('mysql:host=localhost;dbname=cards_db', "cards_admin", "admin_pass");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}

function getCardTypes(){
    $conn = getConnection();

    $data = array();
    $query = "SELECT id, name, exp_interval FROM card_expiration_types";
    try {
        $stmt = $conn->query($query);
        $data = $stmt->fetchAll();
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }

    return $data;
}

function getStatusTypes(){
    $conn = getConnection();

    $data = array();
    $query = "SELECT id, name FROM card_status_type";
    try {
        $stmt = $conn->query($query);
        $data = $stmt->fetchAll();
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }

    return $data;
}

function deleteCard($id){

    $conn = getConnection();

    $query = "DELETE FROM cards WHERE number = " . $id;
    $stmt = $conn->prepare($query);
    $stmt = $stmt->execute();
}

function toggleCardStatus($id, $status){
    $conn = getConnection();

    $query = "UPDATE cards SET status = ".$status." WHERE number = " . $id;
    $stmt = $conn->prepare($query);
    $stmt = $stmt->execute();
}