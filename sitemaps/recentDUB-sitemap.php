<?php
include('../_config.php');

header('Content-type: application/xml');

echo "<?xml version='1.0' encoding='UTF-8'?>"."\n";
echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>"."\n";

$json = file_get_contents("$api/recent-release?type=2&page=1");
$json = json_decode($json, true);
foreach($json as $recentRelease) 
{  
    echo "<url>";
    echo "<loc>https://{$_SERVER['SERVER_NAME']}/watch/".$recentRelease['episodeId']."</loc>";
    echo "<changefreq>daily</changefreq>";
    echo "<priority>0.8000</priority>";
    echo "</url>";
}

echo "</urlset>";

?>