<?php
$ip = $_SERVER['REMOTE_ADDR'];
$data = file_get_contents("http://ip-api.com/json/{$ip}");
$details = json_decode($data, true);

if (strpos($details["org"], "EarthLink") !== false) {
    echo "الطلب قادم من Earthlink";
} else {
    echo "الطلب ليس من Earthlink";
}
?>
