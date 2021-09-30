<?php

phpinfo();

?>


<!DOCTYPE html>
<html>
<body>

<?php

$income['income'][] = array('first'=>1,'second'=>2);
$income['income'][] = array('first'=>1,'second'=>2);


$income = json_encode($income);

echo "<pre>";
print_r($income);
echo "</pre>";
exit();

$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

echo "<pre>";
print_r($age);
echo "</pre>";
exit();

echo json_encode($age); 

exit();
?>

</body>
</html>





<!DOCTYPE html>
<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
<input type="checkbox" name="drivers-include" id="drivers-include">

  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	exit();
    // collect value of input field
    $name = $_POST['fname'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
}
?>

</body>
</html>



<!-- <?php




$systemWithChunksArray = array();
$array2 = array();
$system = array('BOS1'=>71091,'BOS2'=>21918,'MIM'=>256069,'RCS'=>556490);

foreach ($system as $systemkey => $systemvalue) {

	//Your starting values
	$total = $systemvalue;
	$chunk = 15000;

	$countArray = array();
	for($numberArray = $chunk; $numberArray <= $total; $numberArray += $chunk) {
		array_push($countArray,$numberArray);
	}

	

	if($numberArray > $total) array_push($countArray, $total);

	
	

	foreach ($countArray as $countArraykey => $countArrayvalue) {
		if($countArraykey <=0)
		{
			$systemWithChunksArray[$systemkey][] = array('start'=>1,'end'=>$countArrayvalue);    
		}
		else
		{
			$systemWithChunksArray[$systemkey][] = array('start'=>$countArray[$countArraykey-1] + 1,'end'=>$countArrayvalue);       
		}
	}
	
}

foreach ($systemWithChunksArray as $systemWithChunksArraykey => $systemWithChunksArrayvalue) {
	foreach ($systemWithChunksArrayvalue as $systemkey => $systemvalue) {
		
		$value = $systemWithChunksArraykey;
		$model="App\Models\\".$systemWithChunksArraykey;
		$job = 'App\Jobs\MatchAllJobApi'; 
		if($systemWithChunksArraykey == 'BOS1' || $systemWithChunksArraykey == 'bos1')
		{
			$table_id = 'bos1_id'; 
		}elseif ($systemWithChunksArraykey == 'BOS2' || $systemWithChunksArraykey == 'bos2') {
			$table_id = 'bos2_id'; 
		}elseif ($systemWithChunksArraykey == 'MIM' || $systemWithChunksArraykey == 'mim') {
			$table_id = 'MIM_id'; 
		}elseif ($systemWithChunksArraykey == 'RCS' || $systemWithChunksArraykey == 'rcs') {
			$table_id = 'rcs_id';
		}
		
	$string = 'select * from '.$model.'where'.$table_id.'between'.$systemvalue['start'].' and '.$systemvalue['end'].'===='.$systemWithChunksArraykey.'-'.$systemvalue['end'];	

		echo "<pre>";
		
		print_r($string);
		echo "</pre>";
		echo "<br>";
		
	}
	
	

	

}


exit();



if ($_SERVER["REQUEST_METHOD"] == "POST") { 

	
$date = $_POST['date'];



$replace_date = $date;

if (strpos($date, '/') !== false || strpos($date, '-') !== false) {
    
    $date = str_replace(['/','-'], '', $date);

    if(strlen($date) < 8)
    {
    	echo "return";
    	exit();
    }

    $format1 = substr_replace_mul($date,'-',[4,7],0);

    $format2 = substr_replace_mul($date,'-',[2,5],0);

    if(validateDate($format1,'Y-m-d') == 1)
    {
    	echo "format 1 - yyyy-mm-dd";
    	$format = 'Y-m-d';
    }
    elseif(validateDate($format2,'m-d-Y') == 1)
    {
    	echo "format 2 - mm-dd-yyyy  ";
    	$format = 'm-d-Y';
    }
    elseif(validateDate($format2,'d-m-Y') == 1)
    {
    	echo "format 2 - dd-mm-yyyy  ";
    	$format = 'd-m-Y';
    }
    else
    {
    	$format = "failed";
    }


    if($format != "failed")
    {
    	$myDateTime = DateTime::createFromFormat($format, $replace_date);
	 $newDateString = $myDateTime->format('Y-m-d');

	 echo "<br>";
	 echo $newDateString;
    }
    else
    {
    	echo  "failed";
    }
     
    

}
else
{
	echo "invalid date 	string";
}

}
	
function validateDate($date, $format)
{
    $d = DateTime::createFromFormat($format, $date);
   
    return $d && $d->format($format) === $date;
}

function substr_replace_mul($string, $replacement, $start, $end) {
   for ($i = 0; $i < count($start); $i++) {
       $string = substr_replace($string, $replacement, $start[$i], is_array($end) ? $end[$i] : $end);
   }
   return $string;
}

?>


<html>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<input type="text" name="date" id="date">
<input type="submit" name="submit"
                   value="Submit"> 

</form>	

</html>
 -->