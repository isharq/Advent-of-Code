<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$roundcounter = 0;

$cell = array();

$input = file("./day-09-input.txt");

$rowcounter = 0;

$output = "";

$compressed = $input[0];

$remaining = $compressed ;

$end=FALSE;

while ($end == FALSE)
{
	$nextmarker = strpos($remaining,"(");
	
	echo "<p>Next instructions start at ". $nextmarker; 
	
	$tosave = substr($remaining,0,$nextmarker);
	
	$output = $output . $tosave;
	
	echo "<p>Saving this to buffer: $tosave</p>";
	
	$instruction = substr($remaining,$nextmarker+1,strpos($remaining,")")-$nextmarker-1);
	
	echo "<p>Next instructions are ". $instruction; 

	$characters = substr($instruction,0,strpos($instruction,"x"));

	$multiple = substr($instruction,strpos($instruction,"x")+1);
	
	echo "<p>$characters characters times $multiple</p>";
	
	$startpos = strpos($remaining,")")+1;

	echo "<p>Start Pos: $startpos</p>";
	
	$todecode = substr($remaining,$startpos,$characters);
	
	echo "<p>To Decode: $todecode</p>";
		
	$decoded = str_repeat ($todecode,$multiple);
	
	$remaining = $decoded . $remaining; 
			
	$remaining = substr($remaining,$startpos + strlen($todecode));	
	
	echo "<p>Output is now " . strlen($output) . " long</p>";	
	
	echo $remaining; 
	
	
	$rowcounter++;
	if ($rowcounter > 40) {$end = TRUE;} 
}


?>

<h1>DONE</h1>