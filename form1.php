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
        if (isset($_GET['project']) && isset($_GET['date'])) {
            include 'connection.php';
            $project = $_GET['project'];
            $date = $_GET['date'];
            $time_end = strtotime($date)+7200;
            $cursor = $collection->find(
                [
                    'project' => $project,
                    'timeEnd' => $time_end
                ]
            );
            $project_date = $project . " " . $date;
            $res = "<table border =1><thead><tr><th>Title</th><th>Description</th><th>Worker</th><th>Project</th><th>Manager</th><th>Start Time</th><th>End Time</th></tr></thead><tbody>";
            foreach ($cursor as $document) {
                $title = $document['title'];
                $description = $document['description'];
                $worker = $document['worker'];
                $time_start =  $document['timeStart'];
                $time_start = gmdate("H:i:s Y-m-d", $time_start);
                $time_end = $document['timeEnd'];
                $time_end = gmdate("H:i:s Y-m-d", $time_end);
                $manager = $document['manager'];
                if (is_object($worker)) {
                    $worker = (array)$worker;
                    $worker = (implode(', ', $worker));
                }
                $res = $res . "<tr><td>$title</td><td>$description</td><td>$worker</td><td>$project</td><td>$manager</td><td>$time_start</td><td>$time_end</td></tr>";
            }
            echo $res;
            echo "<script> localStorage.setItem('$project_date', '$res'); </script>";
        }
    ?>
