<?php
// You'll need the nikeplusphp lib
require SITE_PATH_LIB."nikeplusphp/class.nikeplus.php";

$np = new NikePlusPHP('user@email.com', 'password');

try {
	/*
	$profile = $np->profile();	
	$user = $profile->user;
	$userTotals = $profile->userTotals;
	$userOptions = $profile->userOptions;
	$mostRecentRun = $profile->mostRecentRun;
	
    object(stdClass)#1188 (14) {
      ["name"]=>
      string(25) "RUN ON: 07/05/08 05:27 PM"
      ["activityId"]=>
      string(9) "251418039"
      ["activityType"]=>
      string(3) "RUN"
      ["timeZone"]=>
      string(9) "GMT+01:00"
      ["startTimeUtc"]=>
      string(25) "2008-07-05T17:27:16+01:00"
      ["status"]=>
      string(11) "in progress"
      ["activeTime"]=>
      int(0)
      ["gps"]=>
      bool(false)
      ["heartrate"]=>
      bool(false)
      ["deviceType"]=>
      string(4) "IPOD"
      ["isTopRoute"]=>
      bool(false)
      ["tags"]=>
      object(stdClass)#1189 (0) {
      }
      ["metrics"]=>
      object(stdClass)#1190 (6) {
        ["averagePace"]=>
        float(1627515.220252)
        ["duration"]=>
        int(3127596)
        ["calories"]=>
        int(232)
        ["fuel"]=>
        int(406)
        ["steps"]=>
        int(0)
        ["distance"]=>
        float(1.9217000007629)
      }
      ["dataStreamIndicators"]=>
      array(1) {
        [0]=>
        string(8) "DISTANCE"
      }
    }
  }
	
	*/

	$runs = $np->activities();	
	foreach ($runs->activities as $run) {
		$startTime = 0;
		$duration = 0;
		$endTime = 0;
		$distanceMiles = 0;

			// Pre-database calculations
			$startTime = strtotime($run->startTimeUtc);
			$duration = $run->metrics->duration/1000;			
			$endTime = $startTime+$duration;								
			$distanceMiles = (float)$run->metrics->distance*0.621;
	
			// Store data
	
      // Output some debug
			echo "Added new run from ".date("r", $startTime)." (".$run->activityId.")\n";		
	}  
} catch(Exception $e) {
	echo "Fatal Error: ".$e->getMessage();
}