<?php
define('RUNKEEPER_UID', 'username');

$url = "http://runkeeper.com/user/".RUNKEEPER_UID."/activity/";
$raw = file_get_contents($url);
$counter = 0;

$newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
$content = str_replace($newlines, "", html_entity_decode($raw));

preg_match_all("|/activity/(.*)\">|U",$content, $rows);
foreach ($rows[0] as $row){
	$counter += 1;
	if ($counter < 12) {
		if ($counter == 1) {
			continue;
		} else {
			$row = str_replace("/activity/", "", $row);
			$activity_id = str_replace("\">", "", $row);
			$url ="http://runkeeper.com/user/".RUNKEEPER_UID."/activity/".$activity_id;
			$raw = file_get_contents($url); 
			$content = str_replace($newlines, "", html_entity_decode($raw));
			preg_match_all("|activityDateText(.*)::|U",$content, $actdates);
			foreach ($actdates[0] as $actdate) {
				$actdate = str_replace("activityDateText\">","", $actdate);
				$actdate = str_replace("::","", $actdate);
				$actdate = str_replace("\xa0","", $actdate);
				$newdate = strtotime(trim($actdate));
				$startTime = $newdate;
				$newdate = date("Y-m-d\\TH:i:s\\Z",$newdate);
			}
			
			$jsonurl = "http://runkeeper.com/ajax/pointData?activityId=".$activity_id;
			$json = file_get_contents($jsonurl, 0, null, null);
			$json_output = json_decode($json);
			
			$id = $activity_id;
			$type = strtolower(trim($json_output->activityType));
			$calories = trim($json_output->statsCalories);
			$distance = (float)$json_output->statsDistance;
			$duration = strcolontotime($json_output->statsDuration);			
			$elevation = trim($json_output->statsElevation);
			$pace = trim($json_output->statsPace);
			$speed = trim($json_output->statsSpeed);
			$endTime = $startTime+$duration;
			
			// Test that ID has been stored, store it if not
		}
	}
}