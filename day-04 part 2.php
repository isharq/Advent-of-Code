<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
$input = file("./day-04-input.txt");

function checksum ($roomname)
{
	$roomname = str_replace("-", "", $roomname);
	echo "<h3>Checking Checksum for $roomname</h3>";
	
	$counts = count_chars($roomname, 1);
	
	$output = "";
	
	
	for ($i=20; $i >= 0; $i--)
	{
		$found = array_keys ($counts,$i);
		
		if (count($found) > 0)
		{
			asort($found);
			foreach ($found as $result)
			{
				$output .= chr($result);
			}
		}
	}
	
	echo "Full checksum found: " . $output;
	
	$output = substr($output,0,5);
	
	echo "<br />5-digit checksum found: " . $output;
	
	return $output;
}

function decode ($roomname,$sector)
{
	$output = "";
		
	for ($i=0; $i <= strlen($roomname); $i++)
	{		
		$character = substr($roomname,$i,1);
					
		if ($character == "-") { $output .= " "; }
		else
		{
			$charnum = ord($character);		
			$decoded = $charnum + $sector; 
		
			while ($decoded > 122)
			{	
				$decoded = $decoded - 26; 			
			}		
		
			echo "<br />$decoded is right. That would be a " . chr($decoded); 
			$output .= chr($decoded);
		}
	}
		
	return $output; 
}

foreach ($input as $line)
{
	$checksum = substr($line,strpos($line,"["));
	$checksum = substr($checksum,1,strpos($checksum,"]")-1);
	
	$roomname = trim(substr($line,0,strpos($line,"[")));
	
	$sector = trim(substr($roomname,strrpos($roomname,"-")+1));

	$roomname = trim(substr($roomname,0,strrpos($line,"-")));
	
	echo "<p> $line <br /> $roomname <br /> $sector <br /> $checksum";	

	if (checksum ($roomname) == $checksum)
	{
		echo "<p>This checks out! $checksum seems to be valid. Let's decode it</p>";		
		
		echo "<p><strong>" . decode ($roomname,$sector) . "</strong>";
	}
			
}


?>