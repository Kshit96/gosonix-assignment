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
			$active_group = 'default';
			$query_builder = TRUE;

			$db['default'] = array(
    				'dsn'    => '',
    				'hostname' => $cleardb_server,
    				'username' => $cleardb_username,
   				'password' => $cleardb_password,
    				'database' => $cleardb_db,
    				'dbdriver' => 'mysqli',
    				'dbprefix' => '',
    				'pconnect' => FALSE,
    				'db_debug' => (ENVIRONMENT !== 'production'),
    				'cache_on' => FALSE,
    				'cachedir' => '',
    				'char_set' => 'utf8',
    				'dbcollat' => 'utf8_general_ci',
    				'swap_pre' => '',
    				'encrypt' => FALSE,
    				'compress' => FALSE,
    				'stricton' => FALSE,
    				'failover' => array(),
    				'save_queries' => TRUE
			);
			$conn = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

			$table='ip_addresses';
			$sql = "CREATE TABLE IF NOT EXISTS $table (
				ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Visit INT,
				IP VARCHAR(255)
				)";
			$result=$conn->query($sql);
			
			$ip2=$_SERVER['REMOTE_ADDR'];
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        			$ip2 = $_SERVER['HTTP_CLIENT_IP'];
    			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        			$ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
    			}
			$sql2="Select count(ID) from `ip_addresses` where IP='".$ip2."'";
			$result2=$conn->query($sql2);
			$count=0;
			while($output=$result2->fetch_assoc()){
				//print_r($output['count(ID)']);
				$count=$output['count(ID)'];
				//echo "<br>";
			}
			
			//echo $count;
			//echo "<br>";
			$Visit=0;
			$Number=0;
			$sql3="Select * from `ip_addresses` where IP='".$ip2."'";
			$result3=$conn->query($sql3);
			while($output2=$result3->fetch_assoc()){
				$Visit=$output2['Visit'];
				$Number=$output2['ID'];
			}

			//echo $Visit;
			//echo "<br>";
			//echo $Number;
			//echo "<br>";

			if ($count>0){
				$Visit=$Visit+1;
				//echo "Incremented Visit:".$Visit."<br>";
				$update_query="Update `ip_addresses` Set Visit='$Visit' where IP='".$ip2."'";
				$result5=$conn->query($update_query);
			}
			else {
				$sql4="INSERT INTO `ip_addresses` (Visit,IP) values (1,'".$ip2."')";
				$result4=$conn->query($sql4);
				$result3=$conn->query($sql3);
				while($output2=$result3->fetch_assoc()){
					$Number=$output2['ID'];
				}

				$Visit=1;
			}

			//$resource=$conn->query('Select * from ip_addresses');
			//while($rows=$resource->fetch_assoc()){
			//	print_r($rows);
			//	echo "<br>";
			//	}
			//$resource->free();			

			
			$conn->close();
	
			//echo $ip2;
			$x=$Number/10+.8;
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

			$y=$Visit%10;
			$pf1="th";
			if($y==1)
			{
				$pf1="st";
			} elseif ($y==2)
			{
				$pf1="nd";
			} elseif ($y==3)
			{
				$pf1="rd";
			} else
			{
				$pf1=$pf1;
			}

			
			echo "<center><p>Hi Human ", "\u{1f44b}", " You are the $x<sup>$pf</sup> visitor and this is your $Visit<sup>$pf1</sup> visit!</p></center>";
			
			


		?> 
			<br>
		<center><img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/teaching_f1cm.svg" alt="Teaching" width="1000" height="300"></center>
	</body>
</html>