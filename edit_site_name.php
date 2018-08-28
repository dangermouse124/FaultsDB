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
<title>Edit site name</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="faults.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		<h2 class="w3-red">Edit a site name</h2>
		<form id="edit_site_number" action="edit_site.php" method="POST">
			<br>
			Site number:
			<?php
			require('faultLogin.php');
			$conn = mysqli_connect($host, $user, $pass, $db);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT site_num FROM sites";
			$result = mysqli_query($conn, $sql);

			echo "<select id='site_num' name='site_num'>";
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				echo "<option value='" . $row['site_num'] . "'>" . $row['site_num'] . "</option>";
			}
			echo "</select>";
			mysqli_free_result($result);
			mysqli_close($conn);
			?>			

			Site name:
			<input type="text" name="site_name" id="site_name">
			
			<input type="hidden" name="edit_item" id="edit_item" value="site_name">

			<br>

			<div class="w3-container w3-margin w3-text-orange">
			<button class="btn" type="submit"><i class="fa fa-plus"></i> Update Site name</button>
			</div>
		</form>	
	</div>
</div>
  
  
</body>
</html>