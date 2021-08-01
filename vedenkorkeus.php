#!/usr/bin/php
<?php
require 'vendor/autoload.php';
require 'credentials.php';

// limit for deep water
const LIMIT = 33.94;


$url = 'http://wwwi3.ymparisto.fi/i3/tilanne/FIN/Vedenkorkeus/image/bigimage/W2300100.txt';
$data = file($url);
if(false === $data) { 
	exit("Unable to open URL {$url} for reading\n");
}

// prepare data, start digging from the bottom to save time
$data = array_reverse($data);
$matches = array();
$value = null;
for($i = 0; ($i < count($data) && null === $value); $i++) {
	$line = $data[$i];
	if(preg_match('/^[0-9.]*\s*(\d\d,\d\d)\s*.*/',$line, $matches)) {
		// echo $line;
		$value = floatval(str_replace(',','.',$matches[1]));
	}
}
if(null === $value) {
	exit("No matches found\n");
}

// send data to beebotte
$bclient = new Beebotte(BBT_API_KEY, BBT_SECRET_KEY);
$bclient->write('Vanjarvi', 'vedenkorkeus', $value);


if($value < LIMIT) {
	echo "Water level of {$value} is below the set limit of ".LIMIT."\n";
} else {
	echo "Water level of {$value} is OVER the set limit of ".LIMIT."\n";

}

exit(0);
