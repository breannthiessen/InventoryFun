<?php 
    /* 
    Author: Breann Thiessen 
    */

    include "inventory.php";
    include "item.php";
    $inv = null;
    session_start();
    if(!isset($_SESSION["inventory"])){ 
        $inv = new Inventory(); 
        $_SESSION["inventory"] = $inv;
    } 
    else {
        $inv = $_SESSION["inventory"];
    }

    if($_POST['action'] == "get_inventory"){
        echo json_encode($inv->getInventory());
    }

    if($_POST['action'] == "add_item"){
        echo json_encode($inv->addItem($_POST['name'], $_POST['weight'], $_POST['width'], $_POST['length'], $_POST['height']));
    }

    if($_POST['action'] == "delete_item"){
        echo json_encode($inv->deleteItem($_POST['name']));
    }

    if($_POST['action'] == "update_item"){
        echo json_encode($inv->updateItem($_POST['name'], $_POST['weight'], $_POST['width'], $_POST['length'], $_POST['height']));
    }

    exit();
?>