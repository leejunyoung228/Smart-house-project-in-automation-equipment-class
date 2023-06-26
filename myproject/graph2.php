﻿<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>
</head>
<body>


<div style="position:relative;width:300px; height:300px;">
	<canvas id="myChart1"></canvas>
	<div id="cap" style="position:absolute;top:110px;left:0px;text-align:center;width:100%;font-size:70px;font-family:Arial, sans-serif;">
	<?php echo $graph2;?>℃
	</div>
</div>

<script>
var input_value = <?php echo $graph2; ?>;
var max_value = 100;
var num = input_value/max_value; 
var color = 'red';
var data = { labels: [input_value ], datasets: [ { data: [num, 1-num], backgroundColor: [color], hoverBackgroundColor: [ color ] }] }; 
var ctx = document.getElementById('myChart1').getContext('2d');
var chart = new Chart(ctx, {
type: 'doughnut',
data: data,
options: { 
   responsive: true, 
   legend: { display: false }, 
   elements: { center: { text: Math.round(num*100), fontStyle: 'Helvetica', sidePadding: 15 } }, 
   maintainAspectRatio : false, 
   cutoutPercentage:70 } 
});
function nockanda_forever(){
var recv  = window.AppInventor.getWebViewString();
// var recv  = 90;
newval   = recv/max_value;
chart.data.datasets[0].data[0] = newval;
chart.data.datasets[0].data[1] = 1-newval;
chart.data.labels[0] = recv;
document.getElementById("cap").innerHTML = recv + "'C";
chart.update();
}

</script>
<!-- <input type="button" value="테슷흐버튼" onclick="nockanda_forever();"> ! -->
</body>
</html>