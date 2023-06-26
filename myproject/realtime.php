<?php include "header.php";?>

<!DOCTYPE html>
<html>
<head>
<title>real time</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
		var did = 'device1'
      $(document).ready(function() {
         setInterval(function() {
            $.ajax({
            url: "download.php?did="+did,
            method: "GET",
            dataType: "text",
            success: function(data) {
				var mydata = JSON.parse(data);
				console.log(mydata);
				tempchart.data.labels = mydata.label;
				humichart.data.labels = mydata.label;
				illumichart.data.labels = mydata.label;
				tempchart.data.datasets[0].data = mydata.temp;
				humichart.data.datasets[0].data = mydata.humi;
				illumichart.data.datasets[0].data = mydata.illumi;
				tempchart.update();
				humichart.update();
				illumichart.update();
              	
            }
           })
         },1000);
      });
    </script>
</head>
<body>
<section>
	<table>
		<tr>
			<td>
				<div>
				<canvas id="line1"></canvas>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div>
					<canvas id="line2"></canvas>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div>
					<canvas id="line3"></canvas>
				</div>
			</td>
		</tr>
	</table>
<!-- <div style="width:600px;">
<canvas id="line1"></canvas>
</div>
<div style="width:600px;">
<canvas id="line2"></canvas>
</div>
<div style="width:600px;">
<canvas id="line3"></canvas>
</div> -->

<script>
var ctx1 = document.getElementById('line1').getContext('2d');
var ctx2 = document.getElementById('line2').getContext('2d');
var ctx3 = document.getElementById('line3').getContext('2d');
var tempchart = new Chart(ctx1, {
	type: 'line',
	data: {
		labels: ['N-6', 'N-5', 'N-4', 'N-3', 'N-2', 'N-1', 'N'],
		datasets: [
				{
					label: 'Temperature',
					backgroundColor: 'transparent',
					borderColor: "red",
					data: [0, 0, 0, 0, 0, 0, 0]
				}
		]
	},
	options: {}
});
var humichart = new Chart(ctx2, {
	type: 'line',
	data: {
		labels: ['N-6', 'N-5', 'N-4', 'N-3', 'N-2', 'N-1', 'N'],
		datasets: [
				{
					label: 'humidity',
					backgroundColor: 'transparent',
					borderColor: "blue",
					data: [0, 0, 0, 0, 0, 0, 0]
				}
		]
	},
	options: {}
});
var illumichart = new Chart(ctx3, {
	type: 'line',
	data: {
		labels: ['N-6', 'N-5', 'N-4', 'N-3', 'N-2', 'N-1', 'N'],
		datasets: [
				{
					label: 'illuminance',
					backgroundColor: 'transparent',
					borderColor: "yellow",
					data: [0, 0, 0, 0, 0, 0, 0]
				}
		]
	},
	options: {}
});

function nockanda_forever(){
	var recv  = window.AppInventor.getWebViewString();
	tempchart.data.datasets[0].data.shift();
	tempchart.data.datasets[0].data.push(recv);
	tempchart.update();
	humichart.data.datasets[0].data.shift();
	humichart.data.datasets[0].data.push(recv);
	humichart.update();
	illumichart.data.datasets[0].data.shift();
	illumichart.data.datasets[0].data.push(recv);
	illumichart.update();
}
</script>
</section>
<?php include "footer.php"; ?>
</body>
</html>
<!-- <link rel=stylesheet href=style.css> -->
<style>
	div{
		width: 600px;
		height: 300px;
	}
</style>