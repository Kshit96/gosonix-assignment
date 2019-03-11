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
		<center><img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/teaching_f1cm.svg" alt="Teaching" width="2000" height="500"></center>
	</body>
</html>