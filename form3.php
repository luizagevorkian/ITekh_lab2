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
        if (isset($_GET['managerWorkers'])) {
            include 'connection.php';
            $manager = $_GET['managerWorkers'];
            $cursor = $collection->find(
                [
                    'manager' => $manager
                ]
            );
            $managerWorkers = $manager . " Workers";
            $res = "Workers of $manager: ";
            foreach ($cursor as $document) {
                $worker = $document['worker'];
                $manager = $document['manager'];
                if (is_object($worker)) {
                    $worker = (array)$worker;
                    $worker = (implode('; ', $worker));
                }
                $res = $res . $worker . "; ";
             
                
            }
            echo $res;
            echo "<script> localStorage.setItem('$managerWorkers', '$res');</script>";
        }
    ?>