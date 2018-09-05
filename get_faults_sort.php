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

.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: grey;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}

</style>
<title>Faults List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
</script>
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
			  <th>Delay</th>
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
				
				$link = "<a href=" . '"' . "edit_fault_page.php?fault_num=" . $row['fault_num'] . '" ' . "target=" . '"' . "_parent" . '"' . ">";
				if ($row['RTS'] == "0000-00-00") {$RTS = "";} else {$RTS = $row['RTS'];}
				if ($row['priority'] == "w3-red") {$tooltip = "New!";}
				if ($row['priority'] == "w3-orange") {$tooltip = "Planning RTS";}
				if ($row['priority'] == "w3-light-blue") {$tooltip = "Delayed RTS";}
				if ($row['priority'] == "w3-light-green") {$tooltip = "Fixed";}
				echo "<tr>";
				echo "<td class='" . $row['priority'] . "'><a href='edit_fault_page.php?fault_num=" . $row['fault_num'] . "' target='_parent' class='tooltip'>" . $row['fault_num'] . "<span class='tooltiptext'>" . $tooltip . "</span></a></td>";
				echo "<td>" . $row['site_name'] . "</td>";
				echo "<td>" . $row['equipment'] . "</td>";
				echo "<td>" . $RTS . "</td>";
				echo "<td>" . $row['delay'] . "</td>";
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
