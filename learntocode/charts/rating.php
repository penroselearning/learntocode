<?php
include "dashboard/db.php";
$query = "SELECT rating, count(*) as number FROM student_experience GROUP BY rating";
$result = mysqli_query($connection, $query);

$student_objectives = "SELECT objective, count(*) as number FROM student_objective GROUP BY objective ORDER BY objective DESC";
$objectives = mysqli_query($connection, $student_objectives);

$student_likes = "SELECT likes, COUNT(*) as number FROM `student_likes`GROUP BY likes ORDER BY likes";
$likes = mysqli_query($connection, $student_likes);

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawPieChart);
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawLikesChart);


    function drawPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Rating', 'Number'],
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "['" . $row["rating"] . "', " . $row["number"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'Experience Rating',
            //is3D:true,  
            pieHole: 0.4
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Objective', 'Number'],
            <?php
            while ($row = mysqli_fetch_array($objectives)) {
                echo "['" . $row["objective"] . "', " . $row["number"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'Acheivement Of Objectives',
            //is3D:true,  
            pieHole: 0.4
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_objective'));
        chart.draw(data, options);
    }

    function drawLikesChart() {
        var data = google.visualization.arrayToDataTable([
            ['Likes', 'Number'],
            <?php
            while ($row = mysqli_fetch_array($likes)) {
                echo "['" . $row["likes"] . "', " . $row["number"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'Student Preferences',
            //is3D:true,  
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_likes'));
        chart.draw(data, options);
    }
</script>