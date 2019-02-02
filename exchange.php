<?php

if (!isset($argv[1])) exit('Enter the required amount');

if (!is_numeric($argv[1])) exit('Enter an integer');

if ($argv[1] > 100000) exit('Maximum amount 100000');

$nominalArray = [1, 2, 5, 10, 20, 50, 100, 200, 500];

$summa = $argv[1];

$result = [];

function getNominalPayment($summa, $nominalArray, &$result)
{

    $nominal = array_pop($nominalArray);
	
    if (!($summa >= $nominal))
        $nominal = array_pop($nominalArray);

    if ( $summa % $nominal ) {
        list($total, $rest) = explode('.', $summa / $nominal);
    } else {
        $total = $summa / $nominal;
	}
	
	if ($total != 0){
		$result[$nominal] = $total;
	}
	
    if (isset($rest)) {
        $rest = $summa - $total * $nominal;
        getNominalPayment($rest, $nominalArray, $result);
    }
}

getNominalPayment($summa, $nominalArray, $result);

if (is_array($result)) {
	foreach($result as $key => $value){
		echo $key . ':' . $value . PHP_EOL ;
	}
}