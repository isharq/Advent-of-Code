<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$roundcounter= 0; 
$numberfound= 0; 

echo "<h1>Okay, let's find some passwords!</h1>";

$password = "";
	
$input = "abbhdwsy";

for ($i=1; $i <= 10000000; $i++)
{
	$tohash = $input . "$i";
	
	$hash = md5($tohash); 
	
	if (substr($hash,0,5) === "00000")
	{
		$numberfound++;
		echo "<p><tt>Hash of $i results in " . md5($tohash) . ", so digit $numberfound of the password is: </tt>";
		echo "<strong>" . substr(md5($tohash),5,1) . "</strong>";
		
		$password .= substr(md5($tohash),5,1);
		
		if ($numberfound == 8)
		{
			echo "<p>Woohoo! We have a password! It should be <tt>" . $password . "</tt></p>"; 
			die ();
		}
	}
	else
	{
		$roundcounter++;
		if($roundcounter %100000 == 0) {
			echo " <a title='" . $roundcounter . "'>.</a> ";
			flush();		  
		}
	}
}

?>