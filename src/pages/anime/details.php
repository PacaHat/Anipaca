<?php

require_once('src/component/anime/qtip.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

$mysqli = $conn;

$urlPath = $_SERVER['REQUEST_URI'];
$animeId = basename($urlPath);

$animeData = fetchAnimeData($animeId); 

if (!$animeData) {
    echo "Anime data not found.";
    exit;
}


$isLoggedIn = isset($_COOKIE['userID']) && !empty($_COOKIE['userID']);
$watchlistStatus = null;

if ($isLoggedIn) {
    try {
    
        $stmt = $mysqli->prepare("SELECT type FROM watchlist WHERE user_id = ? AND anime_id = ? LIMIT 1");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $mysqli->error);
        }
        
        $stmt->bind_param("is", $_SESSION['userID'], $animeId); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $row = $result->fetch_assoc()) {
            $watchlistStatus = (int)$row['type'];
        }
        
        $stmt->close();
    } catch (Exception $e) {
        error_log("Error checking watchlist status: " . $e->getMessage());
      
        $watchlistStatus = null;
    }
}

$watchlistLabels = [
    1 => 'Watching',
    2 => 'On-Hold', 
    3 => 'Plan to Watch',
    4 => 'Dropped',
    5 => 'Completed'
];


$characterApiUrl = "$zpi/character/list/$animeId";
$characterData = file_get_contents($characterApiUrl);
$characterDataJson = json_encode($characterData, JSON_PRETTY_PRINT);



?>



<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
 
<title>Details Of <?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?> - <?= htmlspecialchars($websiteTitle) ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="title" content="Watch <?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?> - <?= htmlspecialchars($websiteTitle) ?>" />
<meta name="description" content="<?= htmlspecialchars(substr($animeData['overview'], 0, 150)) ?>.... Read More On <?= htmlspecialchars($websiteTitle) ?>" />

<meta name="charset" content="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<meta name="robots" content="index, follow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Language" content="en" />
<meta property="og:title" content="Details Of <?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?> - <?= htmlspecialchars($websiteTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars(substr($animeData['overview'], 0, 150)) ?>.... Read More On <?= htmlspecialchars($websiteTitle) ?>.">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars($websiteTitle) ?>">
<meta property="og:url" content="<?= htmlspecialchars($websiteUrl) ?>/anime/<?= htmlspecialchars($animeId) ?>">
<meta itemprop="image" content="<?= htmlspecialchars($animeData['poster']) ?>">
<meta property="og:image" content="<?= htmlspecialchars($animeData['poster']) ?>">
<meta property="og:image:secure_url" content="<?= htmlspecialchars($animeData['poster']) ?>">
<meta property="og:image:width" content="650">
<meta property="og:image:height" content="350">
<meta property="twitter:title" content="Details Of <?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?> - <?= htmlspecialchars($websiteTitle) ?>">
<meta property="twitter:description" content="<?= htmlspecialchars(substr($animeData['overview'], 0, 150)) ?>.... Read More On <?= htmlspecialchars($websiteTitle) ?>.">
<meta property="twitter:url" content="<?= htmlspecialchars($websiteUrl) ?>/anime/<?= htmlspecialchars($animeId) ?>">
<meta property="twitter:card" content="summary">
<meta name="apple-mobile-web-app-status-bar" content="#202125">
<meta name="theme-color" content="#202125">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/styles.min.css?v=<?= $version ?>">
    <link rel="apple-touch-icon" href="<?= $websiteUrl ?>/public/logo/favicon.png?v=<?= $version ?>" />
    <link rel="shortcut icon" href="<?= $websiteUrl ?>/public/logo/favicon.png?v=<?= $version ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $websiteUrl ?>/public/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $websiteUrl ?>/public/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $websiteUrl ?>/public/logo/favicon-16x16.png">
    <link rel="mask-icon" href="<?= $websiteUrl ?>/public/logo/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="icon" sizes="192x192" href="<?= $websiteUrl ?>/public/logo/touch-icon-192x192.png?v=<?= $version ?>">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/new.css?v=<?= $version ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/search.css">
    <script src="<?= $websiteUrl ?>/src/assets/js/search.js"></script>

    <noscript>
        <link rel=stylesheet href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css>
        <link rel=stylesheet href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css>
    </noscript>
    <script>const cssFiles = ["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"], firstLink = document.getElementsByTagName("link")[0]; cssFiles.forEach((s => { const t = document.createElement("link"); t.rel = "stylesheet", t.href = `${s}?v=<?= $version ?>`, t.type = "text/css", firstLink.parentNode.insertBefore(t, firstLink) }))</script>
    <link rel=stylesheet href=https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css>
    <link rel=stylesheet href=https://use.fontawesome.com/releases/v5.3.1/css/all.css>
    <link rel=stylesheet href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=67521dcc10699f0019237fbb&product=inline-share-buttons&source=platform" async="async"></script>
</head>

<body data-page="movie_info">
    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
        <?php include('src/component/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" date-page="movie_info" data-id="<?= htmlspecialchars($animeId) ?>">
            <div id="ani_detail">
                <div class="ani_detail-stage">
                    <div class="container">
                        <div class="anis-cover-wrap">
                            <div class="anis-cover" style="background-image: url('<?= htmlspecialchars($animeData['poster']) ?>')"></div>
                        </div>
                        <div class="anis-content">
                            <div class="anisc-poster">
                                <div class="film-poster">
                                    <img src="<?= htmlspecialchars($animeData['poster']) ?>" class="film-poster-img">
                                   
                                </div>
                            </div>
                            <div class="anisc-detail">
                                <div class="prebreadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                                            <li class="breadcrumb-item"><a href="/anime">Anime</a></li>
                                            <li class="breadcrumb-item dynamic-name active" data-jname="<?= htmlspecialchars($animeData['japanese'] ?? $animeData['japanese']) ?>"><?= htmlspecialchars($animeData['title'] ?? $animeData['japanese']) ?></li>
                                        </ol>
                                    </nav>
                                </div>
                                <h2 class="film-name dynamic-name" data-jname="<?= htmlspecialchars($animeData['japanese'] ?? $animeData['title']) ?>"><?= htmlspecialchars($animeData['title'] ?? $animeData['japanese']) ?></h2>
                                <div id="mal-sync"></div>
                                <div class="film-stats">
                                    <div class="tick">
                                    <div class="tick-item tick-pg"><?= htmlspecialchars($animeData['rating']) ?></div>
                                    <div class="tick-item tick-quality"><?= htmlspecialchars($animeData['quality']) ?></div>
                                        <div class="tick-item tick-sub"><i class="fas fa-closed-captioning mr-1"></i><?= htmlspecialchars($animeData['subEp']) ?></div>
                                        <div class="tick-item tick-dub"><i class="fas fa-microphone mr-1"></i><?= htmlspecialchars($animeData['dubEp']) ?></div>
                                        <span class="dot"></span>
                                        <span class="item"><?= htmlspecialchars($animeData['showType']) ?></span>
                                        <span class="dot"></span>
                                        <span class="item"><?= htmlspecialchars($animeData['duration']) ?></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="film-buttons">
                                    <a href="/watch/<?= htmlspecialchars($animeData['id']) ?>?ep=1" class="btn btn-radius btn-primary btn-play"><i class="fas fa-play mr-2"></i>Watch now</a>
                                    <div class="dr-fav dropdown" id="watch-list-content">
                                        <button type="button" class="btn btn-radius btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-anime-id="<?= htmlspecialchars($animeId) ?>">
                                            <?php if (!$isLoggedIn): ?>
                                                <i class="fas fa-user mr-2"></i>Sign in to add
                                            <?php elseif ($watchlistStatus): ?>
                                                <i class="fas fa-check mr-2"></i><?= htmlspecialchars($watchlistLabels[$watchlistStatus]) ?>
                                            <?php else: ?>
                                                <i class="fas fa-plus mr-2"></i>Add to List
                                            <?php endif; ?>
                                        </button>
                                        <?php if ($isLoggedIn): ?>
                                            <div class="dropdown-menu dropdown-menu-model dropdown-menu-normal">
                                                <?php foreach ($watchlistLabels as $statusId => $label): ?>
                                                    <a class="wl-item dropdown-item <?= ($watchlistStatus == $statusId) ? 'active' : '' ?>" 
                                                       data-type="<?= $statusId ?>" 
                                                       data-movieid="<?= htmlspecialchars($animeId) ?>" 
                                                       data-animename="<?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?>" 
                                                       data-poster="<?= htmlspecialchars($animeData['poster']) ?>" 
                                                       data-subcount="<?= htmlspecialchars($animeData['subEp']) ?>" 
                                                       data-dubcount="<?= htmlspecialchars($animeData['dubEp']) ?>" 
                                                       data-animetype="<?= htmlspecialchars($animeData['showType']) ?>" 
                                                       data-anilistid="<?= htmlspecialchars($animeData['anilistId']) ?>" 
                                                       data-page="detail" 
                                                       href="javascript:;">
                                                        <?= htmlspecialchars($label) ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="film-description m-hide">
                                    <div class="text">
                                        <?= nl2br(htmlspecialchars($animeData['overview'])) ?><span class="btn-more-desc more">+ More</span>
                                    </div>
                                </div>
                                <div class="film-text m-hide">
                                    <?= htmlspecialchars($websiteTitle) ?> is the best site to watch <strong><?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?></strong> SUB online, or you can even watch <strong><?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?></strong> DUB in HD quality.
                                    You can also find <a class="name" href="/producer/<?= htmlspecialchars(strtolower(str_replace(" ", "-", $animeData['studio']))) ?>"><strong><?= htmlspecialchars($animeData['studio']) ?></strong></a> anime on <?= htmlspecialchars($websiteTitle) ?> website.
                                </div>
                                <div class="share-buttons share-buttons-min mt-3">
                                    <div class="share-buttons-block" style="padding-bottom: 0 !important;">
                                        <div class="share-icon"></div>
                                        <div class="sbb-title mr-3">
                                            <span>Share <?=$websiteTitle?></span>
                                            <p class="mb-0">to your friends</p>
                                        </div>
                                        <div class="sharethis-inline-share-buttons st-center st-has-labels st-inline-share-buttons st-animated" id="st-1"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="anisc-info-wrap">
                                <div class="anisc-info">
                                    <div class="item item-title w-hide">
                                        <span class="item-head">Overview:</span>
                                        <div class="text">
                                            <?= nl2br(htmlspecialchars($animeData['overview'])) ?>
                                        </div>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Japanese:</span>
                                        <span class="name"><?= htmlspecialchars($animeData['japanese'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Synonyms:</span>
                                        <span class="name">
                                            <?= !empty($animeData['synonyms']) && trim($animeData['synonyms']) !== '' ? 
                                                htmlspecialchars($animeData['synonyms']) : 
                                                htmlspecialchars($animeData['japanese'] ?? '') ?>
                                        </span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Aired:</span>
                                        <span class="name"><?= htmlspecialchars($animeData['aired']) ?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Premiered:</span>
                                        <span class="name"><?= htmlspecialchars($animeData['premiered']) ?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Duration:</span>
                                        <span class="name"><?= htmlspecialchars($animeData['duration']) ?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Status:</span>
                                        <span class="name"><?= htmlspecialchars($animeData['status']) ?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">MAL Score:</span>
                                        <span class="name"><?= htmlspecialchars($animeData['malscore']) ?></span>
                                    </div>
                                    <div class="item item-list">
                                        <span class="item-head">Genres:</span>
                                        <?php if (!empty($animeData['genres']) && is_array($animeData['genres'])): ?>
                                            <?php foreach ($animeData['genres'] as $genre): ?>
                                                <a href="<?= htmlspecialchars($websiteUrl) ?>/genre/<?= strtolower(str_replace(" ", "+", htmlspecialchars($genre))) ?>" title="<?= htmlspecialchars($genre) ?>"><?= htmlspecialchars($genre) ?></a>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span>Genres not available</span>
                                        <?php endif; ?>
                                    </div>
                            <div class="item item-title">
                                <span class="item-head">Studios:</span>
                                        <?php if (!empty($animeData['studio'])): ?>
                                            <?php 
                                                $studios = explode(',', $animeData['studio']); // Split studios by comma
                                                $studioLinks = [];

                                                foreach ($studios as $studio) {
                                                    $studio = trim($studio); // Trim spaces
                                                    $studioSlug = preg_replace('/[^a-z0-9-]+/', '', strtolower(str_replace(" ", "-", $studio)));
                                                    $studioLinks[] = '<a class="name" href="/producer/' . htmlspecialchars($studioSlug) . '">' . htmlspecialchars($studio) . '</a>';
                                                }

                                                echo implode(', ', $studioLinks); // Join studios with a comma and space
                                            ?>
                                        <?php else: ?>
                                            <span>No studio available</span>
                                        <?php endif; ?>
                                    </div>


                                        <div class="item item-title">
                                            <span class="item-head">Producers:</span>
                                            <?php if (!empty($animeData['producer']) && is_array($animeData['producer'])): ?>
                                                <?php foreach ($animeData['producer'] as $producer): ?>
                                                    <?php 
                                                        $producerSlug = preg_replace('/[^a-z0-9-]+/', '', strtolower(str_replace(" ", "-", $producer ?? '')));
                                                    ?>
                                                    <a class="name" href="/producer/<?= htmlspecialchars($producerSlug) ?>"><?= htmlspecialchars($producer) ?></a><?php if (next($animeData['producer'])) echo ','; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span>No producers available</span>
                                            <?php endif; ?>
                                        </div>
                                     <div class="film-text w-hide">
                                        <?= htmlspecialchars($websiteTitle) ?> is the best site to watch <strong><?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?></strong> SUB online, or you can even watch <strong><?= htmlspecialchars($animeData['title'] ?? $animeData['jname']) ?></strong> DUB in HD quality.
                                        You can also find <a class="name" href="/producer/<?= htmlspecialchars(strtolower(str_replace(" ", "-", $animeData['studio']))) ?>"><strong><?= htmlspecialchars($animeData['studio']) ?></strong></a> anime on <?= htmlspecialchars($websiteTitle) ?> website.
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="main-content">
                <!-- More Seasons -->
                <?php if (!empty($animeData['season']) || !empty($animeData['actors']) || !empty($animeData['trailers'])): ?>
                <!-- More Seasons -->
                <?php if (!empty($animeData['season']) && is_array($animeData['season'])): ?>
                <section class="block_area block_area-seasons">
                    <div class="block_area-header">
                        <div class="bah-heading">
                            <h2 class="cat-heading">More Seasons</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="os-list">
                        <?php foreach ($animeData['season'] as $season): ?>
                            <a href="<?= $websiteUrl ?>/details/<?= $season['id'] ?>" class="os-item <?= $season['id'] === $animeId ? 'active' : '' ?>" title="<?= htmlspecialchars($season['title']) ?>">
                                <div class="title"><?= htmlspecialchars($season['name']) ?></div>
                                <div class="season-poster" style="background-image: url(<?= htmlspecialchars($season['poster']) ?>);"></div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Characters & Voice Actors -->
                <?php if (!empty($animeData['actors'])): ?>
                <section class="block_area block_area-actors">
                    <div class="block_area-header">
                        <div class="float-left bah-heading mr-4">
                            <h2 class="cat-heading">Characters &amp; Voice Actors</h2>
                        </div>
                        <div class="float-right viewmore">
                            <a class="btn" data-toggle="modal" data-target="#modalVoiceActors">View more<i class="fas fa-angle-right ml-2"></i></a>
                        </div>                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="block-actors-content">
                        <div class="bac-list-wrap">
                            <?php foreach ($animeData['actors'] as $entry): ?>
                                <div class="bac-item">
                                    <div class="per-info ltr">
                                        <a href="/character/<?= htmlspecialchars($entry['character']['id']) ?>" class="pi-avatar" rel="noopener noreferrer">
                                            <img data-src="<?= htmlspecialchars($entry['character']['poster']) ?>" alt="<?= htmlspecialchars($entry['character']['name']) ?>" class="lazyloaded" src="<?= htmlspecialchars($entry['character']['poster']) ?>">
                                        </a>
                                        <div class="pi-detail">
                                            <h4 class="pi-name">
                                                <a href="/character/<?= htmlspecialchars($entry['character']['id']) ?>" rel="noopener noreferrer">
                                                    <?= htmlspecialchars($entry['character']['name']) ?>
                                                </a>
                                            </h4>
                                            <span class="pi-cast"><?= htmlspecialchars($entry['character']['cast']) ?></span>
                                        </div>
                                    </div> 

                                    <?php if (!empty($entry['voiceActors']) && is_array($entry['voiceActors'])): ?>
                                        <?php $voiceActor = $entry['voiceActors'][0]; // Get the first voice actor ?>
                                        <div class="per-info rtl">
                                            <a href="/actors/<?= htmlspecialchars($voiceActor['id']) ?>" class="pi-avatar" rel="noopener noreferrer">
                                                <img data-src="<?= htmlspecialchars($voiceActor['poster']) ?>" class="lazyloaded" alt="<?= htmlspecialchars($voiceActor['name']) ?>" src="<?= htmlspecialchars($voiceActor['poster']) ?>">
                                            </a>
                                            <div class="pi-detail">
                                                <h4 class="pi-name">
                                                    <a href="/actors/<?= htmlspecialchars($voiceActor['id']) ?>" rel="noopener noreferrer">
                                                        <?= htmlspecialchars($voiceActor['name']) ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="clearfix"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </section>
                <?php endif; ?> 

                <!-- Promotion Videos -->
                <?php if (!empty($animeData['trailers'])): ?>
                <section class="block_area block_area-promotions">
                    <div class="block_area-header">
                        <div class="float-left bah-heading mr-4">
                            <h2 class="cat-heading">Promotion Videos</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="block_area-content block_area-promotions-list">
                        <div class="screen-items">
                            <?php foreach ($animeData['trailers'] as $trailer): ?>
                                <div class="item">
                                    <div class="screen-item-thumbnail" onclick="showTrailer(this)">
                                        <span class="icon-play"><i class="fas fa-play"></i></span>
                                        <img src="<?= htmlspecialchars($trailer['thumbnail']) ?>" class="sit-img">
                                    </div>
                                    <div class="screen-item-info">
                                        <h3 class="sii-title"><?= htmlspecialchars($trailer['title']) ?></h3>
                                    </div>
                                    <div class="trailer-iframe" style="display: none;">
                                        <iframe width="560" height="315" src="<?= htmlspecialchars($trailer['source']) ?>" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
                <?php endif; ?>
                <?php endif; ?>
                <script>
                   document.addEventListener('DOMContentLoaded', function() {
                        function showTrailer(element) {
                            var trailerSource = element.parentElement.querySelector('.trailer-iframe iframe').src;
                            document.getElementById('trailerIframe').setAttribute('src', trailerSource);
                            var trailerModal = new bootstrap.Modal(document.getElementById('trailerModal'));
                            trailerModal.show();
                        }

                        // Clear the iframe source when the modal is closed
                        var modalElement = document.getElementById('trailerModal');
                        if (modalElement) {
                            modalElement.addEventListener('hidden.bs.modal', function () {
                                document.getElementById('trailerIframe').setAttribute('src', '');
                            });
                        } else {
                            console.error('trailerModal element not found');
                        }
                    });
                </script>
                <!-- Recommended for you -->
                <section class="block_area block_area_category">
                    <div class="block_area-header">
                        <div class="float-left bah-heading mr-4">
                            <h2 class="cat-heading">Recommended for you</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-content">
                        <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
                            <div class="film_list-wrap">
                                <?php if (!empty($animeData['recommendedAnimes'])): ?>
                                    <?php foreach ($animeData['recommendedAnimes'] as $recommendedAnime): ?>
                                        <div class="flw-item">
                                            <div class="film-poster">
                                                <div class="tick ltr">
                                                    <?php if (!empty($recommendedAnime['episodes']['sub'])): ?>
                                                        <div class="tick-item tick-sub"><i class="fas fa-closed-captioning mr-1"></i><?= htmlspecialchars($recommendedAnime['episodes']['sub']) ?></div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($recommendedAnime['episodes']['dub'])): ?>
                                                        <div class="tick-item tick-dub"><i class="fas fa-microphone mr-1"></i><?= htmlspecialchars($recommendedAnime['episodes']['dub']) ?></div>
                                                    <?php endif; ?>
                                                    <div class="tick-item tick-eps"><?= htmlspecialchars($recommendedAnime['episodes']['sub'] ?? $recommendedAnime['episodes']['dub']) ?></div>
                                                </div>
                                                <img data-src="<?= htmlspecialchars($recommendedAnime['poster']) ?>" class="film-poster-img lazyloaded" alt="<?= htmlspecialchars($recommendedAnime['name'] ?? $recommendedAnime['jname']) ?>" src="<?= htmlspecialchars($recommendedAnime['poster']) ?>">
                                                <a href="/details/<?= htmlspecialchars($recommendedAnime['id']) ?>" class="film-poster-ahref item-qtip" data-id="<?= htmlspecialchars($recommendedAnime['id']) ?>" data-hasqtip="0" oldtitle="<?= htmlspecialchars($recommendedAnime['name'] ?? $recommendedAnime['jname']) ?>" title="" aria-describedby="qtip-0"><i class="fas fa-play"></i></a>
                                            </div>
                                            <div class="film-detail">
                                                <h3 class="film-name"><a href="/details/<?= htmlspecialchars($recommendedAnime['id']) ?>" title="<?= htmlspecialchars($recommendedAnime['name'] ?? $recommendedAnime['jname']) ?>"><?= htmlspecialchars($recommendedAnime['name'] ?? $recommendedAnime['jname']) ?></a></h3>
                                                <div class="fd-infor">
                                                    <span class="fdi-item"><?= htmlspecialchars($recommendedAnime['type']) ?></span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item fdi-duration"><?= htmlspecialchars($recommendedAnime['duration']) ?></span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No recommended animes available</p>
                                <?php endif; ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
            </div>
            <div class="lazy-component">
                <?php include('src/component/anime/sidenav.php'); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php include('src/component/footer.php'); ?>
    <div id="mask-overlay"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/app.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/comman.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/movie.js"></script>
    <link rel="stylesheet" href="<?= htmlspecialchars($websiteUrl) ?>/src/assets/css/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/function.js"></script>
    <!-- Bootstrap JS and dependencies -->
     0
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-labelledby="trailerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trailerModalLabel">Promotion Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="trailerIframe" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    
  <script>

document.addEventListener('DOMContentLoaded', function() {
    const watchListItems = document.querySelectorAll('.wl-item');
    
    const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;  

    console.log('Login status:', isLoggedIn); 
    watchListItems.forEach(item => {
        item.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (!isLoggedIn) {
                const currentUrl = window.location.href;
                window.location.href = `/login?redirect=${encodeURIComponent(currentUrl)}`;
                return;
            }
            const type = this.getAttribute('data-type');
            const movieId = this.getAttribute('data-movieid');
            const animeName = this.getAttribute('data-animename');
            const poster = this.getAttribute('data-poster');
            const subCount = this.getAttribute('data-subcount');
            const dubCount = this.getAttribute('data-dubcount');
            const animeType = this.getAttribute('data-animetype');
            const anilistId = this.getAttribute('data-anilistid');
            try {
                const response = await fetch('/src/ajax/wl-up.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ 
                        type, 
                        movieId, 
                        animeName, 
                        poster, 
                        subCount, 
                        dubCount, 
                        animeType, 
                        anilistId
                    }),
                    credentials: 'same-origin'
                });

                const data = await response.json();
                if (data.success) {
                    const dropdownToggle = document.querySelector('#watch-list-content .btn');
                    const selectedText = this.textContent.trim();
                    dropdownToggle.innerHTML = `<i class="fas fa-check mr-2"></i>${selectedText}`;

                    watchListItems.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error updating watch list:', error);
                alert(error.message || 'Failed to update your list. Please try again later.');
            }

            const dropdownMenu = document.querySelector('#watch-list-content .dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
            }
        });
    });

    const dropdownToggle = document.querySelector('#watch-list-content .btn');
    if (dropdownToggle) {
        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (!isLoggedIn) {
                const currentUrl = window.location.href;
                window.location.href = `/login?redirect=${encodeURIComponent(currentUrl)}`;
                return;
            }

            const dropdownMenu = document.querySelector('#watch-list-content .dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.toggle('show');
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('#watch-list-content')) {
            const dropdownMenu = document.querySelector('#watch-list-content .dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
            }
        }
    });
});
</script>


<!-- Characters & Voice Actors Modal -->
<div class="modal fade premodal premodal-characters" id="modalVoiceActors" tabindex="-1" role="dialog" aria-labelledby="modalVoiceActorsTitle" aria-hidden="true"  style="background-color: transparent;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style=" z-index: 2;">
            <div class="modal-header">
                <h5 class="modal-title text-left" id="modalVoiceActorsTitle">Characters & Voice Actors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-characters">
                    <div id="characters-content">
                        <div class="bac-list-wrap mb-3" id="character-list">
                            <!-- Characters will be populated here -->
                        </div>
                        <div class="loading-relative" style="display: none;">
                            <div class="loading">
                                <div class="span1"></div>
                                <div class="span2"></div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        <div class="pre-pagination">
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    <!-- Pagination will be populated here -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const characterData = <?= $characterData ?>;
    const ITEMS_PER_PAGE = 6;

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('[data-target="#modalVoiceActors"]').addEventListener('click', function() {
            displayCharacters(1);
        });
    });

    function displayCharacters(page) {
        const loadingElement = document.querySelector('.loading-relative');
        const characterList = document.getElementById('character-list');
        
        try {
            loadingElement.style.display = 'block';
            characterList.innerHTML = '';

            if (characterData && characterData.success && characterData.results.data) {
                const characters = characterData.results.data;
                const totalPages = Math.ceil(characters.length / ITEMS_PER_PAGE);
                const startIndex = (page - 1) * ITEMS_PER_PAGE;
                const endIndex = startIndex + ITEMS_PER_PAGE;
                const pageCharacters = characters.slice(startIndex, endIndex);

                pageCharacters.forEach(item => {
                    const characterItem = document.createElement('div');
                    characterItem.className = 'bac-item';

                    // Create character info
                    const characterHtml = `
                        <div class="per-info ltr">
                            <a href="/character/${item.character.id}" class="pi-avatar">
                                <img class="lazyload" src="${item.character.poster}" alt="${item.character.name}">
                            </a>
                            <div class="pi-detail">
                                <h4 class="pi-name">
                                    <a href="/character/${item.character.id}">${item.character.name}</a>
                                </h4>
                                <span class="pi-cast">${item.character.cast}</span>
                            </div>
                        </div>
                    `;

                    // Create voice actors info with tooltip
                    const voiceActorsHtml = `
                        <div class="per-info per-info-xx">
                            <div class="pix-list">
                                ${item.voiceActors.map(actor => `
                                    <a href="/actors/${actor.id}" data-toggle="tooltip" title="${actor.name}" class="pi-avatar">
                                        <img class="lazyload" src="${actor.poster}" alt="${actor.name}">
                                    </a>
                                `).join('')}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    `;

                    characterItem.innerHTML = characterHtml + voiceActorsHtml;
                    characterList.appendChild(characterItem);
                });

                // Update pagination
                updatePagination(page, totalPages);
                
                // Initialize tooltips
                $('[data-toggle="tooltip"]').tooltip();

            } else {
                console.error('Invalid character data structure');
            }
        } catch (error) {
            console.error('Error displaying characters:', error);
        } finally {
            loadingElement.style.display = 'none';
        }
    }

    function updatePagination(currentPage, totalPages) {
        const paginationElement = document.querySelector('.pagination');
        let paginationHtml = '';

        // Previous button
        if (currentPage > 1) {
            paginationHtml += `
                <li class="page-item">
                    <a href="javascript:;" class="page-link" onclick="displayCharacters(${currentPage - 1})">‹</a>
                </li>
            `;
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a href="javascript:;" class="page-link" onclick="displayCharacters(${i})">${i}</a>
                </li>
            `;
        }

        // Next button
        if (currentPage < totalPages) {
            paginationHtml += `
                <li class="page-item">
                    <a href="javascript:;" class="page-link" onclick="displayCharacters(${currentPage + 1})">›</a>
                </li>
            `;
        }

        paginationElement.innerHTML = paginationHtml;
    }
</script>

</body>
</html>
