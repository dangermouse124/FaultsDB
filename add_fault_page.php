<html>
<head>
<style>
h2 {
text-align: center;
background-color: Lightgrey;
}

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
<link rel="stylesheet" href="faults.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
</script>
</head>
<body>
 <!-- topbar -->
<div class="navbar">
	<a href="fault_home.html" title="Home" class="w3-blue">
	<i class="fa fa-home"> Home</i></a>
	<a href="add_fault_page.php" title="Add a Fault">
	<i class="fa fa-ambulance"> Add Fault</i></a>
  <div class="dropdown">
    <button class="dropbtn">Sites 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
	<a href="add_site.html" title="Add a Site">
	<i class="fa fa-plus"> Add Site</i></a>
	<a href="edit_site_name.php" title="Add a Site">
	<i class="fa fa-magic"> Edit Site Name</i></a>
	<a href="edit_site_num.php" title="Add a Site">
	<i class="fa fa-magic"> Edit Site Number</i></a>
    </div>
  </div> 
</div><br>

<div class="w3-container"> 
	<div class="w3-card-4 w3-dark-grey w3-padding" style="width:95%">
		<h2><font color="black">Add a Fault</font></h2><br>
		<form id="faultform" action="add_fault.php" method="POST">	
			Site Name: 
			<?php
			require('faultLogin.php');
			$conn = mysqli_connect($host, $user, $pass, $db);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT site_name FROM sites";
			$result = mysqli_query($conn, $sql);

			echo "<select id='site_name' name='site_name'>";
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				echo "<option value='" . $row['site_name'] . "'>" . $row['site_name'] . "</option>";
			}
			echo "</select>";
			mysqli_free_result($result);
			mysqli_close($conn);
			?>		
						
			Progress:
			<select name="priority" id="priority">
				<option class="w3-red" value="w3-red">New!</option>
				<option class="w3-orange" value="w3-orange">Planning RTS</option>
				<option class="w3-light-blue" value="w3-light-blue">Delayed RTS</option>
				<option class="w3-light-green" value="w3-light-green">Fixed</option>
			</select>
						
			Equipment:
			<input type="text" name="equipment" id="equipment">
			<br><br>
			
			Status:
			<select name="status" id="status">
				<option value="Active">Active</option>
				<option value="Cleared">Cleared</option>
			</select>
			
			Entered into sitesDB:
			<select name="sitesDB" id="sitesDB">
				<option value="No">No</option>
				<option value="Yes">Yes</option>
			</select>
			<br><br>
			
			Description of fault:<br>
			<textarea rows="4" cols="50" id="description" name="description"></textarea>
			<br><br>
			
			Entered by:
			<input type="text" name="reported_by" id="reported_by">
						
			Assigned to:
			<input type="text" name="assigned_to" id="assigned_to" required>
			<br><br>
			
			Expected RTS:
			<input type="date" name="RTS" id="RTS">
						
			Delay Reason:
			<input type="text" name="delay" id="delay">
			<br><br>
			
			Comments:<br>
			<textarea rows="4" cols="50" id="comment" name="comment"></textarea>

			<div class="w3-container w3-margin w3-text-orange">
			<button class="btn" type="submit"><i class="fa fa-plus"></i> Add Fault</button>
			</div>
			<br>
		</form>	
	</div>
</div> 
  
  
</body>
</html>