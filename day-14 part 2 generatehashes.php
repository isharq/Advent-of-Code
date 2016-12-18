<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('max_execution_time', 120); // 
// ini_set('max_execution_time', 600); // 


$input = "qzyelonm";
//$input = "abc";

$newhashes = 0; 

$solution = FALSE; 

$index = -1; 

$foundsolution = 0; 

$storedhashes = array(); 

include("./day-14 part 2 hashes.php");

function hashit($string)
{
	global $storedhashes;
	
	echo "$string / ";
	
	if (isset($storedhashes[$string]))
		{ 
				return $storedhashes[$string]; 
		}
	
	$stretched = $string; 
	
	for ($i = 0; $i <= 2016; $i++)
	{
		$stretched = strtolower(md5($stretched));
	}
		
	$storedhashes[$string] = $stretched; 
	
	// echo "<br />&nbsp; &nbsp; &nbsp; Stretched hash of $string is $stretched";
			
	return $stretched; 
}

$numStoredHashes = 0;

$numStoredHashes = count($storedhashes);

for ($tohash=$numStoredHashes; $tohash <= $numStoredHashes + 30000; $tohash++)
{
	$string = $input . $tohash;
		
	$hash = hashit($string);
			
}

?>
<h1>DONE</h1>

<textarea><? echo "&lt;?\n"; 
foreach ($storedhashes as $key => $thishash)
{
	echo "$" . "storedhashes" . "[\"" . $key . "\"] = \"$thishash\";\n"; 
}

echo "\n?&gt;"; 
?></textarea>