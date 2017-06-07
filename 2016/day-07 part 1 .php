<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$roundcounter= 0; 
$numberfound= 0; 
$positive=0;

echo "<h1>Okay, let's find some passwords!!</h1>";

$password = "";
	
$input = file("./day-07-input.txt");

foreach ($input as $ips)
{
	echo "<br />$ips";
	preg_match_all("/\[[^\]]*\]/", $ips, $bad);			

	foreach ($bad[0] as $test)
	{
		for ($i=0; $i<= strlen($test)-5; $i++)
		{
			if ($test[$i] === $test[$i+3]) 
			{
			
				if ($test[$i+1] === $test[$i+2])
				{
					if ($test[$i] === $test[$i+1])
					{
						
					}
					else
					{
						
					echo "<br /> <strong>We found a negative match. Excluding! </strong>  <tt>" ;
					echo $test[$i] . $test[$i+1] . $test[$i+2] . $test[$i+3] . "</tt><br />";
					
					continue(3);
					}
				}
			}
		}		
	}
	
	for ($i=0; $i<= strlen($ips)-5; $i++)
	{
		if ($ips[$i] === $ips[$i+3]) 
		{
		
			if ($ips[$i+1] === $ips[$i+2])
			{
				if ($ips[$i] === $ips[$i+1])
				{
					
				}
				else
				{
				echo "<br /> <strong>We found a positive match. WOOO! </strong>  <tt>" ;
				echo $ips[$i] . $ips[$i+1] . $ips[$i+2] . $ips[$i+3] . "</tt><br />";
				$positive++; 
				continue(2);
				}
			}
		}
	}		
	
	
	
}

echo "<h3>Found $positive matches.</h3>";

?>