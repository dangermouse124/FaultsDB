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
<title>Add Fault</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">


</script>
</head>
<body>
<div class="w3-container"> 
	<h1 class="w3-container w3-center w3-light-grey">Add a Fault</h1>
	<div class="w3-card-4 w3-dark-grey w3-padding" style="width:95%">
		<form id="faultform" action="add_fault.php" method="POST">	
			Site Name: 
			<?php
			require_once('faultLogin.php');
			$conn = mysqli_connect($host, $user, $pass, $db);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT site_name FROM sites";
			$result = mysqli_query($conn, $sql);

			echo "<select name='site_name'>";
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				echo "<option value='" . $row['site_name'] . "'>" . $row['site_name'] . "</option>";
			}
			echo "</select>";
			mysqli_free_result($result);
			mysqli_close($conn);
			?>		
						
			Priority:
			<select name="priority" id="priority">
				<option value="Red">Red</option>
				<option value="Orange">Orange</option>
				<option value="Yellow">Yellow</option>
				<option value="Grey">Grey</option>
			</select>
			<br><br>
			
			Description of fault:<br>
			<textarea rows="4" cols="50" id="description" name="description"></textarea>
			<br><br>
			
			Entered by:
			<input type="text" name="reported_by" id="reported_by">
						
			Assigned to:
			<input type="text" name="assigned_to" id="assigned_to">
			<br><br>
			
			Expected RTS:
			<input type="text" name="RTS" id="RTS">
						
			Delay Reason:
			<input type="text" name="delay" id="delay">
			<br><br>
			
			Comments:<br>
			<textarea rows="4" cols="50" id="comment" name="comment"></textarea>

			<div class="w3-container w3-margin w3-text-orange">
			<h2>Check and submit</h2>
			<input type="submit" value="Submit">
			</div>
			<br>
		</form>	
	</div>
</div> 
  
  
</body>
</html>