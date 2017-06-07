<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('max_execution_time', 600); // 

$input = "qzyelonm";
$input = "abc";

$solution = FALSE; 

$index = -1; 

$foundsolution = 0; 

$storedhashes = array(); 

function hashit($string)
{
	global $storedhashes;
	
	if (isset($storedhashes[$string]))
		{ return $storedhashes[$string]; }
	
	$thehash = strtolower(md5($string)); 
	
	$storedhashes[$string] = $thehash; 
	
	echo "<br /> Hash of $string is " . $thehash; 
	
	return $thehash; 
	
}


function checkthree($hash)
{
	for ($i=0; $i <= strlen($hash)-3; $i++)
	{	
		if ($hash[$i] == $hash[$i+1] && $hash[$i+1] == $hash[$i+2]) 
			{ return $hash[$i]; }
	}
}

function checkfive($hash, $testfor)
{
	for ($i=0; $i <= strlen($hash)-5; $i++)
	{
		if (   $hash[$i+0] == $testfor 
			&& $hash[$i+1] == $testfor 
			&& $hash[$i+2] == $testfor 
			&& $hash[$i+3] == $testfor 
			&& $hash[$i+4] == $testfor) { return TRUE; }
	}
}	

while ($solution == FALSE)
{
	$index++; 
	
	$string = $input . $index;
		
	$hash = hashit($string);
		
	if ($testfor = checkthree($hash)) 
	{
			
		for ($totest = $index+1; $totest <= $index + 1000; $totest++)
		{
			$string = $input . $totest;
			$hash = hashit($string);
			if (checkfive($hash, $testfor))
			{
				$foundsolution++; 
				echo "<br /><strong>&rarr; Found pad</strong> $foundsolution at <strong>$index</strong> ";
				echo "now " . number_format(count($storedhashes)) . " stored hashes   | "; 
			}
		}
	}
	
	if ($index % 1000 == 0) { echo ". "; flush(); }
	
	if ($foundsolution == 64) { $solution = true; }
}

?>
<h1>DONE</h1>