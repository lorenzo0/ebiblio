<?php 
    try {
         $connessioneMongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>