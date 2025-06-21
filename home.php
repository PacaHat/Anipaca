<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');



define('BASE_API_URL', $zpi);
$endpoint = '';
$apiUrl = BASE_API_URL . $endpoint;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
    exit;
}
curl_close($ch);

$data = json_decode($response, true);

if (!$data || !$data['success']) {
    echo "Muhehehe! API request failed and no cache available.";
    exit;
}

$data = $data['results'];
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title><?= $websiteTitle ?> #1 Watch High Quality Anime Online Without Ads</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title"
        content="<?= $websiteTitle ?> #1 Watch High Quality Anime Online Without Ads" />
    <meta name="description"
        content="<?= $websiteTitle ?> #1 Watch High Quality Anime Online Without Ads. You can watch anime online free in HD without Ads. Best place for free find and one-click anime." />
    <meta name="keywords"
        content="<?= $websiteTitle ?>, watch anime online, free anime, anime stream, anime hd, anipaca, alpaca, apaca, palahat, pacahat, rahat, raisul rahat, anpaca, pacatv, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa" />
    <meta name="charset" content="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Language" content="en" />
    <meta property="og:title"
        content="<?= $websiteTitle ?> #1 Watch High Quality Anime Online Without Ads">
    <meta property="og:description"
        content="<?= $websiteTitle ?> #1 Watch High Quality Anime Online Without Ads. You can watch anime online free in HD without Ads. Best place for free find and one-click anime.">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= $websiteTitle ?>">
    <meta property="og:url" content="<?= $websiteUrl ?>/home">
    <meta itemprop="image" content="<?= $banner ?>">
    <meta property="og:image" content="<?= $banner ?>">
    <meta property="og:image:secure_url" content="<?= $banner ?>">
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
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
<body data-page="page_home">
<div id="preloder"></div>
 

<div id="sidebar_menu_bg" class=""></div>
        <?php include('./src/component/header.php'); ?>
        <div class="clearfix"></div>
        
        <?php include('./src/component/anime/slidebar.php'); ?>
     
        
        <?php include('./src/component/anime/trending.php') ?>
        

        <div class="share-buttons share-buttons-home">
            <div class="container">
                <div class="share-buttons-block">
                    <div class="share-icon"></div>
                    <div class="sbb-title mr-3">
                        <span>Share <?=$websiteTitle?></span>
                        <p class="mb-0">to your friends</p>
                    </div>
                   <div class="sharethis-inline-share-buttons"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="lazy-component mt-3" data-component="apfc">
            <?php include('./src/component/anime/apfc.php'); ?>
        </div>
        
                                        
        <div id="anime-featured">
        <div id="main-wrapper">
            <div class="container">
                <div id="main-content" class="lazy-component" data-component="main-content">
                    <?php if (isset($_COOKIE['userID'])) {
                        $user_id = $_COOKIE['userID'];
                        $sql = "SELECT * FROM watch_history WHERE user_id = ? GROUP BY anime_id, episode_number  ORDER BY MAX(id) DESC  LIMIT 4";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $user_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        
                        if ($result->num_rows > 0) { ?>
                            <section class="block_area block_area_home">
                                <div class="block_area-header">
                                    <div class="float-left bah-heading mr-4">
                                        <h2 class="cat-heading"><i class="fas fa-history mr-2"></i>Continue Watching</h2>
                                    </div>
                                    <div class="float-right viewmore">
                                        <a class="btn" href="/continue-watching">View more<i class="fas fa-angle-right ml-2"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="block_area-content block_area-list film_list film_list-grid">
                                        <div class="film_list-wrap">
                                            <?php while($anime = $result->fetch_assoc()) { ?>
                                                <div class="flw-item">
                                                    <div class="film-poster">
                                                        <div class="tick ltr">
                                                            <?php if (!empty($anime['sub_count'])): ?>
                                                                <div class="tick-item tick-sub"><i class="fas fa-closed-captioning mr-1"></i><?php echo htmlspecialchars($anime['sub_count']); ?></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($anime['dub_count'])): ?>
                                                                <div class="tick-item tick-dub"><i class="fas fa-microphone mr-1"></i><?php echo htmlspecialchars($anime['dub_count']); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                       
                                                        <img class="film-poster-img lazyload" 
                                                             loading="lazy"
                                                             data-src="<?php echo htmlspecialchars($anime['poster']); ?>"
                                                             src="<?= $websiteUrl ?>/public/images/no_poster.jpg"
                                                             alt="<?php echo htmlspecialchars($anime['anime_name']); ?>">
                                                        <a class="film-poster-ahref" 
                                                           href="/watch/<?php echo htmlspecialchars($anime['anime_id']); ?>?ep=<?php echo htmlspecialchars($anime['episode_number']); ?>"
                                                           title="<?php echo htmlspecialchars($anime['anime_name']); ?>">
                                                           <i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
                                                    <div class="film-detail">
                                                        <h3 class="film-name">
                                                            <a href="/watch/<?php echo htmlspecialchars($anime['anime_id']); ?>?ep=<?php echo htmlspecialchars($anime['episode_number']); ?>"
                                                               title="<?php echo htmlspecialchars($anime['anime_name']); ?>">
                                                                <?php echo htmlspecialchars($anime['anime_name']); ?>
                                                            </a>
                                                        </h3>
                                                        <div class="fd-infor">
                                                            <span class="fdi-item"><i class="fas fa-play-circle"></i> EP <?= $anime['episode_number'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </section>
                        <?php }
                       
                    } 
                    ?>

                    <?php include('./src/component/anime/latest.php'); ?>
                    <?php include('./src/component/anime/new-on.php'); ?>
                    <?php include('./src/component/anime/schedule.php'); ?>
                    <?php include('./src/component/anime/upcoming.php'); ?>
                  
                    </div> 
                <div class="lazy-component" data-component="sidenav">
                    <?php include('./src/component/anime/sidenav.php'); ?>
                </div>
                <div class="clearfix"></div>
                               
            </div>
        </div>
        <div class="clearfix"></div>
        <?php include('./src/component/footer.php'); ?>
        <div id="mask-overlay"></div>
     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/app.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/comman.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/movie.js"></script>
        <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/function.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
    </div>
</body>

</html>
