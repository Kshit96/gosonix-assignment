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
			
			$ip2="1.1.1.5";
			$sql2="Select count(ID) from `ip_addresses` where IP='".$ip2."'";
			$result2=$conn->query($sql2);
			$row=mysql_fetch_array($result2);
			$count=$row['count(ID)'];
			echo $count;
			if ($count>0){
				print_r($result2->fetch_assoc());
			}else {
				echo "New code to be executed";
				print_r($result2->fetch_assoc());
			}
						
			
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