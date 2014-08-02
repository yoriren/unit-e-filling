
<html>
<script type="text/javascript" src="jquery-2.1.1.js"></script>
<head>
	<?php
	session_start();
	$mysqli = new mysqli('localhost', 'root', '', 'team_project');
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	$stmt2=$mysqli->prepare("SELECT unitcode,unitdesc FROM lecturer WHERE lecturerid =?");
	$stmt2->bind_param('s',
		$_SESSION['lecturerid']
		);
	$stmt2->execute();
	$stmt2->bind_result($unitcode,$unitname);
	
	?>
</head>
<script type="text/javascript">


	function reqListener () {
		console.log(this.responseText);
	}

    var oReq = new XMLHttpRequest(); //New request object
    oReq.onload = function() {
        //This is where you handle what to do with the response.
        //The actual data is found on this.responseText
        //The data from get_hod_status, 1= is a hod, 0= not hod
        if(this.responseText==1){			
			
        	$("#approvelist").append("<fieldset><legend>HOD</legend>Proceed to HOD Home Page?<br/>Click <a href='hod_homepage.php'>here</a>");
			$("#approvelist").append("</fieldset>");
        }
    };
    oReq.open("get", "get_hod_status.php", true);
    //                               ^ Don't block the rest of the execution.
    //                                 Don't wait until the request finishes to 
    //                                 continue.
    oReq.send();
    </script>
<body>
	<form action="home.php" method="get">
		<p> Please select the unit that you wish to upload files. </p>
		Unit Code
		<select name="unitcodeslist">
			echo "<option value =''> </option>";	
			<?php 
			while($stmt2->fetch()){
				if($unitcode!='')
				echo "<option value='$unitcode|$unitname'>$unitcode $unitname</option>";
				}
			?>

		</select>
		<input type="submit" value="Next" name="home" onclick="home.php"/>		
	</form>
	
	


	<div id="approvelist">
	</div>
	

</body>

</html>




