<?php
// You'll need an OAuth token here
define("FOURSQUARE_OAUTH_TOKEN", "");

// To pull for a period, set a unix timestamp here
$timestamp = 0;

$data = @file_get_contents("https://api.foursquare.com/v2/users/908651/checkins?oauth_token=".FOURSQUARE_OAUTH_TOKEN."&afterTimestamp=".$timestamp);
if (!empty($data)) {
	if ($checkins_decoded = json_decode($data)) {					
		$checkins = $checkins_decoded->response->checkins->items;
		if (count($checkins)) {
			foreach ($checkins as $checkin) {		

				// You can store the data below:
				$checkin->id
				$checkin->createdAt
				$checkin->isMayor
				$checkin->venue->id
				$checkin->venue->name
				$checkin->venue->location->lat
				$checkin->venue->location->lng
				$checkin->venue->location->city
				$checkin->venue->categories[0]->name
				$checkin->venue->stats->checkinsCount
				$checkin->venue->stats->usersCount
				$checkin->venue->stats->tipCount

			}
		}			   
  	}
}  
