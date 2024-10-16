<?php 
include './_config.php'; 
$page = rand(1,86);
$select = rand(1,120);

$getAnime = file_get_contents("$api/animeList?page=$page");
$getAnime = json_decode($getAnime, true);

$getAnime = $getAnime[$select];
$getAnime = $getAnime['animeId'];


$newURL = "$websiteUrl/anime/$getAnime";
header('Location: '.$newURL);
?>
