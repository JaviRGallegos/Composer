<?php 
require_once 'vendor/autoload.php';

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);
$userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
$dd = new DeviceDetector($userAgent);

$dd->parse();

if ($dd->isBot()) {
  $botInfo = $dd->getBot();
} else {
  $clientInfo = $dd->getClient(); // holds information about browser, feed reader, media player, ...
  $osInfo = $dd->getOs();
  $device = $dd->getDeviceName();
  $brand = $dd->getBrandName();
  $model = $dd->getModel();
}

use DeviceDetector\Parser\OperatingSystem;
$osFamily = OperatingSystem::getOsFamily($dd->getOs('name'));

use DeviceDetector\Parser\Client\Browser;
$browserFamily = Browser::getBrowserFamily($dd->getClient('name'));
echo "<h1> Device detector </h1>";
echo "Sistema operativo: ". $osFamily. "<br>";
echo "Navegador: ". $browserFamily;
var_dump($dd);


?>