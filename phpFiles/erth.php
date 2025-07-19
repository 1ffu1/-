<?php

$host = "localhost"; 
$user = "if0_39499776_sho"; 
$pass = "bLo9WMV1y4bwp0k"; 
$dbname = "if0_39499776_sho"; 

// مفتاح API المعتمد
$valid_api_key = "49Bb83Wp70Sk90Au25Ht"; // استبدله بمفتاحك الحقيقي

// التحقق من مفتاح API في الطلب
if (!isset($_GET['api_key']) || $_GET['api_key'] !== $valid_api_key) {
    die(json_encode(["error" => "مفتاح API غير صالح"], JSON_UNESCAPED_UNICODE));
}

// الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "فشل الاتصال بقاعدة البيانات: " . $conn->connect_error], JSON_UNESCAPED_UNICODE));
}

// استعلام جلب البيانات
$sql = "SELECT * FROM erth";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // إزالة القيم null
        $row = array_filter($row, function($value) {
            return $value !== null;
        });

        $data[] = $row;
    }
}

// تحويل البيانات إلى JSON
$json_data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// تشفير البيانات باستخدام base64
$encoded_data = base64_encode($json_data);

// إرجاع البيانات المشفرة
echo $encoded_data;

$conn->close();
?>
