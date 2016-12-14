<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 220);
error_reporting(E_ALL);

$roundcounter= 0; 
$numberfound= 0; 

echo "<h1>Okay, let's find some passwords!</h1>";
	
$input = "abbhdwsy";

for ($i=0; $i <= 1000000000; $i++)
{
	$tohash = $input . "$i";
	
	$hash = md5($tohash); 
	
	if (substr($hash,0,5) === "00000")
	{
		
		if (substr(md5($tohash),5,1) === "0" OR (substr(md5($tohash),5,1) > 0 && substr(md5($tohash),5,1) < 8))
		{
		
		if (isset($password[substr(md5($tohash),5,1)]) === TRUE)
			{ 
				echo " " . substr(md5($tohash),5,1) . " ";
			}
		else
			{	
				$numberfound++;			
				echo "<p><tt>Hash of $i results in " . md5($tohash) . ", so digit " . substr(md5($tohash),5,1) . " of the password is: " . substr(md5($tohash),6,1) . "</tt><br />";
				$password[substr(md5($tohash),5,1)] = substr(md5($tohash),6,1); 
			}
		

		}
						
		if ($numberfound == 8)
		{
			echo "<p>Woohoo! We have a password! It should be <tt>"; 
				
				for ($i=0; $i <= 7; $i++)
				{
					echo $password[$i];
				}
				
				
									
				echo "</tt></p>"; 
			die ();
		}
	}
	else
	{
		$roundcounter++;
		if($roundcounter %500000 == 0) {
			echo " <a title='" . $roundcounter . "'>.</a> ";
			flush();		  
		}
	}
}

?>

<p>Ending...</p>