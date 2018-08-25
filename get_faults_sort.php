<html>
<head>
<title>Faults List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="w3-container"><br>
		<div class="w3-card-4 w3-dark-grey w3-padding">
			
			<table id="faultTable" class="w3-table">
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

			$sql = "SELECT * FROM faults ORDER BY " . $_POST["column"] . " " . $_POST["acdc"];
			echo $sql;
			
			$result = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$prority = "<tr bgcolor='" . $row['priority'] . "'>";
				echo $prority;
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
