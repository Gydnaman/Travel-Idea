<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$lat = 24.91;
$lon = 118.58;
$bbox = ($lat-2) . ',' . ($lon-2) . ',' . ($lat+2) . ',' . ($lon+2);
$url = "https://aviationweather.gov/api/data/metar?bbox={$bbox}&format=json";
echo $url . "\n";
$response = Illuminate\Support\Facades\Http::get($url);
print_r($response->json());
