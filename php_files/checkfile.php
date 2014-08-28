<html>
<body>
<?php
session_start();
include('database_config.php');

$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}


	$stmt=$mysqli->prepare("SELECT unitcode,trimester FROM lecturer WHERE lecturerid =?");
	$stmt->bind_param('s',
		$_SESSION['lecturerid']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$trimester);
	while($stmt->fetch()){

	if($trimester =="Jan2014")
	{
		echo "January 2014<br>";
		echo "<a href='home.php?unitcode=$unitcode'>$unitcode</a>";
	}


$myfile = fopen("$unitcode_$trimester.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("$unitcode_$trimester.txt"));
fclose($myfile);

$unit_file = array();
array_push($unit_file, "$unitcode_$trimester");
}

?>
<script type="text/javascript" language="javascript">
    var pausecontent = new Array();
    <?php foreach($unit_file as $key => $val){ ?>
        pausecontent.push('<?php echo $val; ?>');
    <?php } ?>
</script>

</body>
</html>