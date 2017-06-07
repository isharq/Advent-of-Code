<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$roundcounter= 0; 
$numberfound= 0; 

echo "<h1>Okay, let's find some passwords!!</h1>";

$password = "";
	
$input = file("./day-06-input.txt");

foreach ($input as $transmission)
{
	for ($i=0;$i <= strlen($transmission)+1; $i++)
	{
		$character[$i][] = substr($transmission,$i,1);
	}
}


for ($i=0;$i <= 7; $i++)
{

	$count = array_count_values($character[$i]); 
	$result = array_search(min($count), $count);	
	
		
	echo "<h1>Checking digit $i. Most common: $result</p>"; 


}