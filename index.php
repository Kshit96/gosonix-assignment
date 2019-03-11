<html>
	<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<style>
		body {
    			font-family: 'Roboto', sans-serif;font-size: 20px;
			}
	</style>
	</head>
		<?php 
			$cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
			$cleardb_server   = $cleardb_url["host"];
			$cleardb_username = $cleardb_url["user"];
			$cleardb_password = $cleardb_url["pass"];
			$cleardb_db       = substr($cleardb_url["path"],1);
			
			$conn = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
			$table='ip_address';
			$val=mysqli_query("select 1 from `ip_address` LIMIT 1");
			$res = mysql_query('DESCRIBE ip_address');
			while($row = mysql_fetch_array($res)) {
    				echo "{$row['Field']} - {$row['Type']}\n";
			}
			if($val !== FALSE)
			{
  				echo "Table found";
			}
			else
			{
    				echo "Table not found";
			}
			if ($conn->connect_error) {
               			die("Connection failed: " . $conn->connect_error);
            		} 
            		$sql = "CREATE TABLE IF NOT EXISTS $table (
				ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Visit INT,
				IP VARCHAR(255)
				)";

            		$result=mysqli_query($conn, $sql);
			echo $result,"<br>";
			
			if ($conn->query($sql) === TRUE) {
               			echo "Table created successfully","<br>";
            		} else {
               			echo "Error: " . $sql . "" . mysqli_error($conn),"<br>";
            		}

			$sql1="Select * from `ip_address` where IP='".$_SERVER['REMOTE_ADDR']."'";
			$result1=$conn->query($sql1);
			while ($row=$result1->fetch_assoc())
			{
				print_r($row);
			}
			if ($result1->num_row===0){
				$sql2="INSER INTO `ip_address` (Visit,IP) values (1,'".$_SERVER['REMOTE_ADDR']."')";
				if ($conn->query($sql2)) {
               				echo "New record created successfully";
            			} else {
               				echo "Error: " . $sql2 . "" . mysqli_error($conn);
           			}
				echo "New Row code executed";
			}else {

				echo "Add code to give unique visitor number and visitor number";
			}
			

			//if(is_resource($result) && mysqli_num_rows($result)==1){
			//	$row=mysqli_fetch_assoc($result);
			//	echo $row,"<br>";


            		$conn->close();
			echo $_SERVER['REMOTE_ADDR'];
			$x=53;
			$y=$x%10;
			$pf="th";
			if($y==1)
			{
				$pf="st";
			} elseif ($y==2)
			{
				$pf="nd";
			} elseif ($y==3)
			{
				$pf="rd";
			} else
			{
				$pf=$pf;
			}

			
			echo "<center><p>Hi Human ", "\u{1f44b}", " You are the $x<sup>$pf</sup> visitor!</p></center>";
			
			


		?> 
			<br>
		<center><img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/teaching_f1cm.svg" alt="Teaching" width="1000" height="300"></center>
	</body>
</html>