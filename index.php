<!DOCTYPE HTML>
<html>
<head>
    <title>Lab2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script>
        function form1() {
            let project = document.getElementById("project").value;
            let date = document.getElementById("date").value;
            let project_date = project + " " + date; 
            let result = localStorage.getItem(project_date);
            document.getElementById('res').innerHTML = result;
        }

        function form2() {
            let manager = document.getElementById("managerProject").value;
            let managerCount = manager + "Count";
            let result = localStorage.getItem(managerCount);
            document.getElementById('res').innerHTML = result;
        }
        function form3(){
            let manager = document.getElementById("managerWorkers").value;
            let managerWorkers = manager + " Workers";
            let result = localStorage.getItem(managerWorkers);  
            document.getElementById('res').innerHTML = result;
        }
     </script>
</head> 

<body>
    <form method="get" action="form1.php">
        <p>Finished tasks
        <select name="project" id="project" onchange = form1()>
            <?php
                include 'connection.php';
                $project = $collection->distinct("project");
                foreach ($project as $document) {
                    echo "<option>";
                    print($document);
                    echo "</option>";
                }
            ?>
        </select>
        <select  name="date" id="date" onchange = form1()>
            <?php
                include 'connection.php';
                $timeEnd = $collection->distinct("timeEnd");
                foreach ($timeEnd as $document) {
                    echo "<option>";
                    print gmdate("H:i:s Y-m-d", $document);
                    echo "</option>";
                }
            ?>
        </select>
        <input type="submit" value="ОК"></p>
    </form>

    <form method="get" action="form2.php">
        <p>Value of projects of manager
            <select name="managerProject" id="managerProject" onchange = form2()>
                <?php
                    include 'connection.php';
                    $manager = $collection->distinct("manager");
                    foreach ($manager as $document) {
                        echo "<option>";
                        print_r($document);
                        echo "</option>";
                    }
                ?>
            </select>
        <input type="submit" value="Ок"></p>
    </form>

    <form method="get" action="form3.php">
        <p> Information about workers 
            <select name="managerWorkers" id="managerWorkers" onchange = form3()>
                <?php
                include 'connection.php';
                $manager = $collection->distinct("manager");
                foreach ($manager as $document) {
                    echo "<option>";
                    print($document);
                    echo "</option>";
                }
                echo '</select>';
                ?>
                </select>
        <input type="submit" value="Ок"></p>
    </form>
    <div id="res"></div>
    
</body>
</html>