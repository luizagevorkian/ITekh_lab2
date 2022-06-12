<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        if (isset($_GET['managerProject'])) {
            include 'connection.php';
            $manager = $_GET['managerProject'];
            $cursor = $collection->aggregate([
                ['$match' => ['manager' => $manager]],
                ['$group' => ['_id' => '$project']],
                ['$count' => 'count']
            ]);
            $manager = $manager . "Count";
            $res = "Value of projects of manager: ";
           foreach ($cursor as $document) {
                if (is_object($document)) {
                    $document = (array)$document;
                    $document = (implode('', $document));
                }

                $res = $res . $document;    
            } 
            
            echo $res;
            echo "<script> localStorage.setItem('$manager', '$res');</script>";
        }
?>