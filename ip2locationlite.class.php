<?php
final class ip2location_lite{
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = '';

	public function __construct(){}

	public function __destruct(){}

	public function setKey($key){
		if(!empty($key)) $this->apiKey = $key;
	}

	public function getError(){
		return implode("\n", $this->errors);
	}

	public function getCountry($host){
		return $this->getResult($host, 'ip-country');
	}

	public function getCity($host){
		return $this->getResult($host, 'ip-city');
	}

	private function getResult($host, $name){
		$ip = @gethostbyname($host);

		if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
			$xml = @file_get_contents('http://' . $this->service . '/' . $this->version . '/' . $name . '/?key=' . $this->apiKey . '&ip=' . $ip . '&format=xml');


			if (get_magic_quotes_runtime()){
				$xml = stripslashes($xml);
			}

			try{
				$response = @new SimpleXMLElement($xml);

				foreach($response as $field=>$value){
					$result[(string)$field] = (string)$value;
				}

				return $result;
			}
			catch(Exception $e){
				$this->errors[] = $e->getMessage();
				return;
			}
		}

		$this->errors[] = '"' . $host . '" is not a valid IP address or hostname.';
		return;
	}
}
?>




PHP example
We wrote a PHP class for our API. You can download it here. Here is an example using all the features of the class :
<?php
include('ip2locationlite.class.php');

//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('<your_api_key>');

//Get errors and locations
$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
$errors = $ipLite->getError();

//Getting the result
echo "<p>\n";
echo "<strong>First result</strong><br />\n";
if (!empty($locations) && is_array($locations)) {
	foreach ($locations as $field => $val) {
		echo $field . ' : ' . $val . "<br />\n";
	}
}
echo "</p>\n";

//Show errors
echo "<p>\n";
echo "<strong>Dump of all errors</strong><br />\n";
if (!empty($errors) && is_array($errors)) {
	foreach ($errors as $error) {
		echo var_dump($error) . "<br /><br />\n";
	}
} else {
	echo "No errors" . "<br />\n";
}
echo "</p>\n";
?>



Putting the geolocation data in a cookie
If you use our API to track your website visitors geolocation, we highly recommend that you put the geolocation data in a cookie (or in a database...). This way, you only query our servers for new visitors, not all page view. To achieve this, here is a quick sample in PHP how to set the country code in a cookie :
<?php
include_once('ip2locationlite.class.php');
 
//Set geolocation cookie
if(!$_COOKIE["geolocation"]){
  $ipLite = new ip2location_lite;
  $ipLite->setKey('<your_api_key>');
 
  $visitorGeolocation = $ipLite->getCountry($_SERVER['REMOTE_ADDR']);
  if ($visitorGeolocation['statusCode'] == 'OK') {
    $data = base64_encode(serialize($visitorGeolocation));
    setcookie("geolocation", $data, time()+3600*24*7); //set cookie for 1 week
  }
}else{
  $visitorGeolocation = unserialize(base64_decode($_COOKIE["geolocation"]));
}
 
var_dump($visitorGeolocation);