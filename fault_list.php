<html>
  <head>
 <style>
.btn {
    background-color: black;
    border: none;
    color: white;
    padding: 12px 16px;
    font-size: 16px;
    cursor: pointer;
	border-radius: 12px;
}

/* Darker background on mouse-over */
.btn:hover {
    background-color: orange !important;
}

</style>
	<title>FaultsDB</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    </script>
  </head>
  <body>
 <!-- topbar -->
<div class="w3-bar w3-grey w3-xlarge">
	<a href="fault_list.php" title="Home" class="w3-bar-item w3-button w3-blue">
	<i class="fa fa-home"></i></a>
	<a href="add_fault_page.php" title="Add a Fault" class="w3-bar-item w3-button">
	<i class="fa fa-ambulance"></i></a>
	<a href="add_site.html" title="Add a Site" class="w3-bar-item w3-button">
	<i class="fa fa-plus"></i></a>
</div>
	<div class="w3-container"> 
		<h1 class="w3-container w3-center w3-light-grey">FaultsDB</h1>
		<div class="w3-card-4 w3-dark-grey w3-padding" style="width:95%">
			<h2 id="sitename"></h2>
		</div>
		<br>
	</div>

	<div class="w3-container"> 
		<div class="w3-card-4 w3-dark-grey w3-padding" style="width:95%">
			
			<table class="w3-table">
			<tr>
			  <th>Fault#</th>
			  <th>Site</th>
			  <th>Start Date</th>
			  <th>RTS</th>
			  <th>Logged by</th>
			  <th>Assigned to</th>
			  <th>Description</th>
			</tr>
			<?php
			require_once('faultLogin.php');
			$conn = mysqli_connect($host, $user, $pass, $db);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * FROM faults";
			$result = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>" . $row['fault_num'] . "</td>";
				echo "<td>" . $row['site_name'] . "</td>";
				echo "<td>" . $row['date_reported'] . "</td>";
				echo "<td>" . $row['RTS'] . "</td>";
				echo "<td>" . $row['reported_by'] . "</td>";
				echo "<td>" . $row['assigned_to'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "</tr>";
			}
			
			mysqli_free_result($result);
			mysqli_close($conn);
			?>					
			
			
			</table>
			<br><br>
		</div>
	</div>
	
  </body>
</html>






