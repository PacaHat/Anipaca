<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Watch Anime Online, Free Anime Streaming Online on <?= $websiteTitle ?> Anime Website</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index,follow" />
    <meta http-equiv="content-language" content="en" />
    <meta name="description"
        content="<?= $websiteTitle ?>: Stream the Best Anime Anytime, Anywhere! Dive into a Vast Library of Classic and New Anime Series, Movies, and More – All Just a Click Away on <?= $websiteTitle ?>!" />
    <meta name="keywords"
        content="anime streaming, watch anime online, free anime streaming, anime episodes, anime movies, anime series, HD anime, anime website, latest anime, popular anime, anime streaming site, dubbed anime, subbed anime, stream anime online, anime library, new anime releases, anime genres, anime in HD, anime with subtitles, online anime, An-Streamz, anime streaming platform" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= $websiteUrl ?>" />
    <meta property="og:title"
        content="<?= $websiteTitle ?> - Official Watch High Quality Anime Online Without Ads" />
    <meta property="og:image" content="<?= $banner ?>" />
    <meta property="og:description"
        content="<?= $websiteTitle ?>: Stream the Best Anime Anytime, Anywhere! Dive into a Vast Library of Classic and New Anime Series, Movies, and More – All Just a Click Away on <?= $websiteTitle ?>!" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="apple-touch-icon" href="<?=$websiteUrl?>/favicon.png?v=<?=$version?>" />
    <link rel="shortcut icon" href="<?=$websiteUrl?>/favicon.png?v=<?=$version?>" type="image/x-icon"/>
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$websiteUrl?>/public/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$websiteUrl?>/public/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$websiteUrl?>/public/logo/favicon-16x16.png">
    <link rel="mask-icon" href="<?=$websiteUrl?>/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="icon" sizes="192x192" href="<?=$websiteUrl?>/public/logo/touch-icon-192x192.png?v=<?=$version?>">
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css?v=<?= $version ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css?v=<?= $version ?>">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/styles.min.css?v=<?= $version ?>">
    <link rel="manifest" href="./manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Enhanced ShareThis integration -->
    <script src="<?=$websiteUrl?>/src/assets/js/share-enhanced.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-R34F2GCSBW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R34F2GCSBW');
</script>

   <style>
    .pizza{ margin: 2rem auto; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem; padding: 1.5rem; border-radius: .6rem; text-align: center; color: #000; font-size: 16px; font-weight: 400; background-color: #FAACA8; background-image: linear-gradient(19deg, #FAACA8 0%, #DDD6F3 100%);}
    .pizza a{ color: #000; font-weight: 500;text-shadow: 0 1px 0 #fff;}
    .pizza a:hover{ text-shadow: 0 1px 3px #fff;}
    .pizza-x{ max-width: 800px; width: calc(100% - 32px); min-height: 90px;}
    .pizza-y{ max-width: 400px; min-height: 300px;}
    .pizza .in-text{ font-size: 1.5em; font-weight: 600;}
    .pizza .in-contact{ font-size: 1em;}
    @media screen and (max-width: 479px){
        .pizza{ font-size: 13px; gap: .6rem}
        .pizza-y{ min-height: 200px;}
    }
</style>


</head>
<body data-page="page_home">

<?php include('./src/component/header.php'); ?>

<div id="wrapper">
    <div id="main-wrapper" class="layout-page layout-page-404">
        <div class="container">
            <div class="container-404 text-center">
                <div class="c4-big-img"><img src="<?=$websiteUrl?>/public/images/404.gif" alt="404 image"></div>
                <div class="c4-medium">404 Error</div>
                <div class="c4-small">Oops! We can&#39;t find this page.</div>
                <div class="c4-button">
                    <a href="/home" class="btn btn-radius btn-focus">
                        <i class="fa fa-chevron-circle-left mr-2"></i>Back to homepage
                    </a>
                </div>
                <div class="c4-button" style="padding-top: 10px;">
                    <a href="<?= $discord ?>" class="btn btn-radius btn-focus">
                        <i class="fab fa-discord mr-2"></i>Report this problem in our Discord server
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php include('./src/component/footer.php'); ?>



<script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?v=<?= $version ?>"></script>
    <script type="text/javascript"
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js?v=<?= $version ?>"></script>
    <script>
        $(document).ready(function () {
            $("#xheader_browser").click(function (e) {
                $("#xheader_menu, #xheader_browser").toggleClass("active");
            });
            $('.btn-search').click(function () {
                if ($('.search-input').val().trim() !== "") {
                    $('#search-form').submit();
                }
            });
        });
    </script>
</body>

</html>
