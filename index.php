<?php
// Masukkan API key Windy Webcams Anda di sini
$api_key = "QnFHR6mset9En4v1v5uYruur7sh4Z4es";

// URL endpoint API Windy Webcams untuk mendapatkan data kamera
$url = "https://api.windy.com/api/webcams/v2/list/nearby=-5.1477,119.4327,50/orderby=distance/limit=10?show=webcams:image,player,location,timezone&key=" . $api_key;

// Buat cURL request untuk mendapatkan data
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// Konversi data JSON menjadi objek PHP
$data = json_decode($response);

// Output data kamera
foreach ($data->result->webcams as $webcam) {
  echo "<h3>" . $webcam->location->city . ", " . $webcam->location->country . "</h3>";
  echo "<p>" . $webcam->title . "</p>";
  echo "<img src=\"" . $webcam->image->current->preview . "\">";
  if (isset($webcam->player->day->embed)) {
    echo "<br><iframe src=\"" . $webcam->player->day->embed . "\" width=\"640\" height=\"480\" frameborder=\"0\" scrolling=\"no\"></iframe>";
  }
  echo "<br><br>";
}
?>