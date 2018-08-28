<html>
<head>
<style>
body {
    background-color: silver;
}
th, td {
	padding: 8px;
    border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#A9CCE3;}
</style>
<title>Faults List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="w3-container"><br>
		<div class="w3-card-4 w3-light-grey w3-padding">
			
			<table id="faultTable" class="w3-table">
			<tr>
			  <th>Fault#</th>
			  <th>Site</th>
			  <th>Equipment</th>
			  <th>RTS</th>
			  <th>Logged by</th>
			  <th>Assigned to</th>
			  <th width="20%">Description</th>
			  <th>Status</th>
			</tr>
			<?php
			require_once('faultLogin.php');
			$conn = mysqli_connect($host, $user, $pass, $db);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			if (isset($_POST['show_cleared'])) {
				$sql = "SELECT * FROM faults ORDER BY " . $_POST["column"] . " " . $_POST["acdc"];
			} else {
				$sql = "SELECT * FROM faults WHERE status='Active' ORDER BY " . $_POST["column"] . " " . $_POST["acdc"];
			}
			echo $sql;
			
			$result = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$priority = "<td class='" . $row['priority'] . "'>";
				$link = "<a href=" . '"' . "edit_fault_page.php?fault_num=" . $row['fault_num'] . '" ' . "target=" . '"' . "_parent" . '"' . ">";
				if ($row['RTS'] == "0000-00-00") {$RTS = "";} else {$RTS = $row['RTS'];}
				echo "<tr>";
				echo $priority . $link . $row['fault_num'] . "</a>" . "</td>";
				//echo $priority . $row['fault_num'] . "</td>";
				echo "<td>" . $row['site_name'] . "</td>";
				echo "<td>" . $row['equipment'] . "</td>";
				echo "<td>" . $RTS . "</td>";
				//echo "<td>" . $row['RTS'] . "</td>";
				echo "<td>" . $row['reported_by'] . "</td>";
				echo "<td>" . $row['assigned_to'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
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
