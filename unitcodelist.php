<?php
session_start();
$hodid = $_SESSION['lecturerid'];
$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

	$stmt=$mysqli->prepare("SELECT unitcode,unitdesc FROM lecturer WHERE lecturerid =?");
	$stmt->bind_param('s',
		$_SESSION['lecturerid']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$unitname);
	?>
	<form action="home.php" method="get">
	    <p> Please select the unit that you wish to upload files. </p>
		Unit 
		<select name="unitcodeslist">
		
<?php 
	
	while($stmt->fetch()){	
	?> 		
		<?php		
		 echo "<option value='$unitcode|$unitname'>$unitcode $unitname</option>";	 
		?>
	
<?php		
	}	

?>
	
	</select>
	<input type="submit" value="Next" onclick="home.php"/>
	</form>

<?php
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
?>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
	$SQL = "SELECT hod FROM unitfile WHERE hod=?";
	if($stmt=$mysqli->prepare($SQL)){
	$stmt->bind_param('s',$hodid);
	$stmt->execute();
	$stmt->store_result();
	$numrows = $stmt->num_rows;
	if($numrows > 0) {
	echo '*Head of department please select a unit to approve ';
	}
	else{
	exit(0);
	}
}
?>

<?php

$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

	$stmt=$mysqli->prepare("SELECT unitCode,unitName FROM unitfile WHERE hod =?");
	$stmt->bind_param('s',$_SESSION['lecturerid']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$unitname);
	?>
	<form action="unitcodelist.php" method="get">
	   
		<select name="unitcodeslist;"select onmouseover="this.size=2;"onmouseout="this.size=1;">
		
<?php 

	while($stmt->fetch()){	
	?> 		
			
		<?php
    	echo "<option value='$unitcode|$unitname'>$unitcode $unitname</option>";			
		?>
	
<?php		
	}	

?>

	</select>
	<input type="submit" value="Select" onclick="unitcodelist.php"/>
	</form>
