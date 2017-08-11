<?php

function calAge($birthday) {
	$date = new DateTime($birthday);
 	$now = new DateTime();

 	$interval = $now->diff($date);
 
 	return $interval->y;
}