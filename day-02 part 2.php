<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
$input = "LLLRLLULLDDLDUDRDDURLDDRDLRDDRUULRULLLDLUURUUUDLUUDLRUDLDUDURRLDRRRUULUURLUDRURULRLRLRRUULRUUUDRRDDRLLLDDLLUDDDLLRLLULULRRURRRLDRLDLLRURDULLDULRUURLRUDRURLRRDLLDDURLDDLUDLRLUURDRDRDDUURDDLDDDRUDULDLRDRDDURDLUDDDRUDLUDLULULRUURLRUUUDDRLDULLLUDLULDUUDLDLRRLLLRLDUDRUULDLDRDLRRDLDLULUUDRRUDDDRDLRLDLRDUDRULDRDURRUULLUDURURUUDRDRLRRDRRDRDDDDLLRURULDURDLUDLUULDDLLLDULUUUULDUDRDURLURDLDDLDDUULRLUUDLDRUDRURURRDDLURURDRLRLUUUURLLRR.
UUUUURRRURLLRRDRLLDUUUUDDDRLRRDRUULDUURURDRLLRRRDRLLUDURUDLDURURRLUDLLLDRDUDRDRLDRUDUDDUULLUULLDUDUDDRDUUUDLULUDUULLUUULURRUDUULDUDDRDURRLDDURLRDLULDDRUDUDRDULLRLRLLUUDDURLUUDLRUUDDLLRUURDUDLLDRURLDURDLRDUUDLRLLRLRURRUDRRLRDRURRRUULLUDLDURDLDDDUUDRUUUDULLLRDRRDRLURDDRUUUDRRUUDLUDDDRRRRRLRLDLLDDLRDURRURLLLULURULLULRLLDDLDRLDULLDLDDDRLUDDDUDUDRRLRDLLDULULRLRURDLUDDLRUDRLUURRURDURDRRDRULUDURRLULUURDRLDLRUDLUDRURLUDUUULRRLRRRULRRRLRLRLULULDRUUDLRLLRLLLURUUDLUDLRURUDRRLDLLULUDRUDRLLLRLLDLLDUDRRURRLDLUUUURDDDUURLLRRDRUUURRRDRUDLLULDLLDLUDRRDLLDDLDURLLDLLDLLLDR.
LRDULUUUDLRUUUDURUUULLURDRURDRRDDDLRLRUULDLRRUDDLLUURLDRLLRUULLUDLUDUDRDRDLUUDULLLLRDDUDRRRURLRDDLRLDRLULLLRUUULURDDLLLLRURUUDDDLDUDDDDLLLURLUUUURLRUDRRLLLUUULRDUURDLRDDDUDLLRDULURURUULUDLLRRURDLUULUUDULLUDUUDURLRULRLLDLUULLRRUDDULRULDURRLRRLULLLRRDLLDDLDUDDDUDLRUURUDUUUDDLRRDLRUDRLLRDRDLURRLUDUULDRRUDRRUDLLLLRURRRRRUULULLLRDRDUDRDDURDLDDUURRURLDRRUDLRLLRRURULUUDDDLLLRDRLULLDLDDULDLUUDRURULLDLLLLDRLRRLURLRULRDLLULUDRDR.
RURRRUDLURRURLURDDRULLDRDRDRRULRRDLDDLDUUURUULLRRDRLDRRDRULLURRRULLLDULDDDDLULRUULRURUDURDUDRLRULLLRDURDDUDDRDLURRURUURDLDDDDDURURRURLLLDDLDRRDUDDLLLDRRLDDUUULDLLDRUURUDDRRLDUULRRDDUDRUULRLDLRLRUURLLDRDLDRLURULDLULDRULURLLRRLLDDDURLRUURUULULRLLLULUDULUUULDRURUDDDUUDDRDUDUDRDLLLRDULRLDLRRDRRLRDLDDULULRLRUUDDUDRRLUDRDUUUDRLLLRRLRUDRRLRUUDDLDURLDRRRUDRRDUDDLRDDLULLDLURLUUDLUDLUDLDRRLRRRULDRLRDUURLUULRDURUDUUDDURDDLRRRLUUUDURULRURLDRURULDDUDDLUDLDLURDDRRDDUDUUURLDLRDDLDULDULDDDLDRDDLUURDULLUDRRRULRLDDLRDRLRURLULLLDULLUUDURLDDULRRDDUULDRLDLULRRDULUDUUURUURDDDRULRLRDLRRURR.
UDDDRLDRDULDRLRDUDDLDLLDDLUUURDDDLUDRDUDLDURLUURUDUULUUULDUURLULLRLUDLLURUUUULRLRLLLRRLULLDRUULURRLLUDUDURULLLRRRRLRUULLRDRDRRDDLUDRRUULUDRUULRDLRDRRLRRDRRRLULRULUURRRULLRRRURUDUURRLLDDDUDDULUULRURUDUDUDRLDLUULUDDLLLLDRLLRLDULLLRLLDLUUDURDLLRURUUDDDDLLUDDRLUUDUDRDRLLURURLURRDLDDDULUURURURRLUUDUDLDLDDULLURUDLRLDLRLDLDUDULURDUDRLURRRULLDDDRDRURDDLDLULUDRUULDLULRDUUURLULDRRULLUDLDRLRDDUDURRRURRLRDUULURUUDLULDLRUUULUDRDRRUDUDULLDDRLRDLURDLRLUURDRUDRDRUDLULRUDDRDLLLRLURRURRLDDDUDDLRDRRRULLUUDULURDLDRDDDLDURRLRRDLLDDLULULRRDUDUUDUULRDRRDURDDDDUUDDLUDDUULDRDDULLUUUURRRUUURRULDRRDURRLULLDU.";


$pos = 5;

function move ($direction)
{
	global $pos;
	
	if (10 == ord($direction)) { return; }
	if ($direction == ".") { return; }
	

		
	$legal["U"] = array(3,6,7,8,10,11,12,13);
	$legal["D"] = array(1,2,3,4,6,7,8,11);
	$legal["L"] = array(3,4,6,7,8,9,11,12);
	$legal["R"] = array(2,3,5,6,7,8,10,11);

	if ( in_array($pos,$legal[$direction]) )
		{ echo "<br />OK! Moving $direction from $pos is cool."; 
		
			if ($direction == "R") { $pos = $pos + 1; }
			if ($direction == "L") { $pos = $pos - 1; }

			if ($direction == "U") 
			{ 
				if 			($pos == 3) 	{ $pos = 1; 		}	
				else if 	($pos == 14) 	{ $pos = 11;		}
				else 						{ $pos = $pos - 4; 	}	
			}

			if ($direction == "D") 
			{ 
				if 			($pos == 1) 	{ $pos = 3; 		}	
				else if 	($pos == 11) 	{ $pos = 13;		}
				else 						{ $pos = $pos + 4; 	}	
			}
			
			echo " Posisition is now $pos (" . strtoupper(dechex($pos)) . ")";
		} 
else
	{
		echo "<br />&rarr; <strong>NO!</strong> Moving $direction from $pos is impossible. Staying put.";	
	}
}


echo "<h2>The string is " . strlen($input) . " characters long</h2>";

for ($i = 1; $i <= strlen($input); $i++) 
	{
	$thischar = substr($input,$i,1);
	if ($thischar == ".")
		{ 
			echo "<h1>Found a digit!</h1>";
			echo "<p>The digit is " . strtoupper(dechex($pos)) . "." ;
			$fullstring = $fullstring . strtoupper(dechex($pos)); 
			echo "<h1>Code so far: $fullstring</h1>";
	    }
		else
		{
			move ($thischar);			
		}
}	


?>