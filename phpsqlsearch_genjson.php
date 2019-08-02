<?php  
header("Content-type: text/html;charset=UTF-8");
require("config.php");
 
@$lat = $_GET["lat"];
@$lng = $_GET["lng"];
 
@$radius = $_GET["radius"];

@$strength_start = $_GET['strength_start'];
@$strength_end = $_GET['strength_end'];
@$strength = $_GET['strength'];

@$time_start = $_GET['time_start'];
@$time_end = $_GET['time_end'];
@$time = $_GET['time'];

if ( isset($strength) ) {

$query = sprintf("SELECT * FROM schools WHERE strength >= '%s' AND strength <= '%s'",
  mysql_real_escape_string($strength_start),
  mysql_real_escape_string($strength_end));

}	

else if( isset($time)) {
	 if($time == "time1") {
		 $query = sprintf("SELECT * FROM schools WHERE time_start >= '%s'",
		 mysql_real_escape_string($time_start));
		 
	 }
	 else if($time == "time2") {
		
		 $query = sprintf("SELECT * FROM schools WHERE time_end >= '%s'",
		 
	     mysql_real_escape_string($time_end));
	 }
		
}
else {
$query = sprintf("SELECT address, name, id, lat, lng, ( 6371 * acos( cos( radians('%s') ) *
 cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * 
 sin( radians( lat ) ) ) ) AS distance FROM schools HAVING distance < '%s' ORDER BY distance LIMIT 0 , 50",

 
  mysql_real_escape_string($lat),
  mysql_real_escape_string($lng),
  mysql_real_escape_string($lat),
  mysql_real_escape_string($radius));
}
 
$result = mysql_query($query);
 
 
if (!$result) {
  die("Invalid query: " . mysql_error());
}
 
while ($par1 = mysql_fetch_array($result)){
 
$places[] = array("id" => $par1['id'],
 
				  "address" => $par1['address'],
 
				  "name" => $par1['name'],

				  "lat" => $par1['lat'],
 
				  "lng" => $par1['lng']);
 
}
 
$json = json_encode($places);
 
echo $json;
 
?>