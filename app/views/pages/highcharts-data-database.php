<?php

$mysqli = new mysqli("localhost", "root", "", "weather"); 

if ($mysqli->connect_errno){
	printf("Connect failed: %s\n", $mysqli->connect_error); 
	exit(); 
}

$query = "SELECT * FROM london_daily ORDER BY date LIMIT 7"; 
$result = $mysqli->query($query); 

while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$lowrows[] = $row['low'];
	$hirows[] = $row['hi'];
	$categ[] = $row['date'];
}

$lowtemp = json_encode($lowrows, JSON_NUMERIC_CHECK); 
$hightemp = json_encode($hirows, JSON_NUMERIC_CHECK);
$categories = json_encode($categ, JSON_NUMERIC_CHECK);

$result->free(); 
$mysqli->close(); 

?>


<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highcharts Example</title>
    
    
    <!-- 1. Add these JavaScript inclusions in the head of your page -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/drilldown.js"></script>
  

    <!-- Local copy of jsQuery js file is 
    <script src="js/jquery.min.js"></script>
    </head>
    --> 

     <!-- Local copy of Highcharts js file is 
    <script src="js/highcharts.js"></script>
    </head>
    --> 


    <!-- 2. Add the JavaScript to initialize the chart on document ready -->

<script type="text/javascript">
$(function () {
    $('#container').highcharts({

        chart: {
            type: 'column'
        },

        title: {
            text: 'Total fruit consumtion, grouped by gender'
        },

        xAxis: {
            categories: <?php echo $categories; ?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number of fruits'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

        series: [{
            name: 'Low',
            data: <?php echo $lowtemp; ?>
           
        }, {
            name: 'High',
            data: <?php echo $hightemp; ?>
           
        } ]
    });
});

</script>
  
</head>

<body>

    <div id="container" style="width:100%; height: 400px; margin: 0 auto"></div>

<form enctype="multipart/form-data">
    <input name="file" type="file" />
    <input type="button" value="Upload" />
</form>


<input type="file" id="fileinput"/>
<input type='button' id='btnLoad' value='Load' onclick='handleFileSelect();'>
<div id="editor"></div>



</body>
</html>
