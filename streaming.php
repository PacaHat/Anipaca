<?php 
require('./_config.php');
$parts=parse_url($_SERVER['REQUEST_URI']); 
$page_url=explode('/', $parts['path']);
$url = $page_url[count($page_url)-1];
$getEpisode = file_get_contents("$api/getEpisode/$url");
$getEpisode = json_decode($getEpisode, true);
$anime = $getEpisode['anime_info'];
$download = str_replace("Gogoanime", "$websiteTitle", $getEpisode['ep_download']);

$getAnime = file_get_contents("$api/getAnime/$anime");
$getAnime = json_decode($getAnime, true);
$episodelist = $getAnime['episode_id'];

?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Watch <?=$getEpisode['animeNameWithEP']?>on <?=$websiteTitle?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="Watch <?=$getEpisode['animeNameWithEP']?>on <?=$websiteTitle?>">
    <meta name="description" content="<?=substr($getAnime['synopsis'],0, 150)?> ... at <?=$websiteUrl?>">
    <meta name="keywords"
        content="<?=$websiteTitle?>, <?=$getEpisode['animeNameWithEP']?>,<?=$getAnime['othername']?><?=$getAnime['name']?>, watch anime online, free anime, anime stream, anime hd, english sub">
    <meta name="charset" content="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="robots" content="index, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Language" content="en">
    <meta property="og:title" content="Watch <?=$getEpisode['animeNameWithEP']?>on <?=$websiteTitle?>">
    <meta property="og:description" content="<?=substr($getAnime['synopsis'],0, 150)?> ... at <?=$websiteUrl?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?=$websiteTitle?>">
    <meta property="og:url" content="<?=$websiteUrl?>/anime/<?=$url?>">
    <meta itemprop="image" content="<?=$getAnime['imageUrl']?>">
    <meta property="og:image" content="<?=$getAnime['imageUrl']?>">
    <meta property="twitter:title" content="Watch <?=$getEpisode['animeNameWithEP']?>on <?=$websiteTitle?>">
    <meta property="twitter:description" content="<?=substr($getAnime['synopsis'],0, 150)?> ... at <?=$websiteUrl?>">
    <meta property="twitter:url" content="<?=$websiteUrl?>/anime/<?=$url?>">
    <meta property="twitter:card" content="summary">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63430163bc99824a"></script>
    <meta name="theme-color" content="#202125">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
        type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        type="text/css">
    <link rel="shortcut icon" href="<?=$websiteUrl?>/favicon.ico?v=<?=$version?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=$websiteUrl?>/favicon.ico?v=<?=$version?>" />
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/style.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/min.css?v=<?=$version?>">
</head>

<body data-page="movie_watch">
    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="movie_watch">
        <?php include('./_php/header.php');?>
        <div class="clearfix"></div>
        <div id="main-wrapper" date-page="movie_watch" data-id="">
            <div id="ani_detail">
                <div class="ani_detail-stage">
                    <div class="container">
                        <div class="anis-cover-wrap">
                            <div class="anis-cover"
                                style="background-image: url('<?=$websiteUrl?>/files/images/banner.webp')">
                            </div>
                        </div>
                        <div class="anis-watch-wrap">
                            <div class="prebreadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item">
                                            <a itemprop="item" href="/"><span itemprop="name">Home</span></a>
                                            <meta itemprop="position" content="1">
                                        </li>
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item">
                                            <a itemprop="item" href="/anime"><span itemprop="name">Anime</span></a>
                                            <meta itemprop="position" content="2">
                                        </li>
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item"
                                            aria-current="page">
                                            <a itemprop="item" href="/anime/<?=$anime?>"><span
                                                    itemprop="name"><?=$getAnime['name']?></span></a>
                                            <meta itemprop="position" content="3">
                                        </li>
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item"
                                            aria-current="page">
                                            <a itemprop="item" href="<?=$websiteUrl?>/watch/<?=$url?>"><span
                                                    itemprop="name">Episode <?=$getEpisode['ep_num']?></span></a>
                                            <meta itemprop="position" content="4">
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="anis-watch anis-watch-tv">
                                <div class="watch-player">
                                    <div class="player-frame">
                                        <div class="loading-relative loading-box" id="embed-loading">
                                            <div class="loading">
                                                <div class="span1"></div>
                                                <div class="span2"></div>
                                                <div class="span3"></div>
                                            </div>
                                        </div>
                                        <!---recommended to use Anikatsu Servers only ---->
                                         <iframe name="iframe-to-load"
                                            src="<?=$websiteUrl?>/player/v1.php?id=<?= $url ?>" frameborder="0"
                                            scrolling="no"
                                            allow="accelerometer;autoplay;encrypted-media;gyroscope;picture-in-picture"
                                            allowfullscreen="true" webkitallowfullscreen="true"
                                            mozallowfullscreen="true"></iframe>
                                    </div>
                                    <div class="player-controls">
                                        <div class="pc-item pc-resize">
                                            <a href="javascript:;" id="media-resize" class="btn btn-sm"><i
                                                    class="fas fa-expand mr-1"></i>Expand</a>
                                        </div>
                                        <div class="pc-item pc-toggle pc-light">
                                            <div id="turn-off-light" class="toggle-basic">
                                                <span class="tb-name"><i class="fas fa-lightbulb mr-2"></i>Light</span>
                                                <span class="tb-result"></span>
                                            </div>
                                        </div>
                                        <div class="pc-item pc-download">
                                            <a class="btn btn-sm pc-download" href="<?=$download?>" target="_blank"><i
                                                    class="fas fa-download mr-2"></i>Download</a>
                                        </div>
                                        <div class="pc-right">
                                            <?php if($getEpisode['prevEpText'] == "") {
                                            echo "";
                                        } else { ?>
                                            <div class="pc-item pc-control block-prev">
                                                <a class="btn btn-sm btn-prev"
                                                    href="/watch<?=$getEpisode['prevEpLink']?>"><i
                                                        class="fas fa-backward mr-2"></i>Prev</a>
                                            </div>&nbsp;
                                            <?php } ?>
                                            <?php if($getEpisode['nextEpText'] == "") {
                                            echo "";
                                        } else { ?>
                                            <div class="pc-item pc-control block-next">
                                                <a class="btn btn-sm btn-next"
                                                    href="/watch<?=$getEpisode['nextEpLink']?>"><i
                                                        class="fas fa-forward ml-2"></i>Next</a>
                                            </div>
                                            <?php } ?>
                                            <div class="pc-item pc-fav" id="watch-list-content"></div>
                                            <div class="pc-item pc-download" style="display:none;">
                                                <a class="btn btn-sm pc-download"><i
                                                        class="fas fa-download mr-2"></i>Download</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="player-servers">
                                    <div id="servers-content">
                                        <div class="ps_-status">
                                            <div class="content">
                                                <div class="server-notice"><strong>Currently watching <b>Episode
                                                            <?=$getEpisode['ep_num']?></b></strong> Switch to alternate
                                                    servers in case of error.</div>
                                            </div>
                                        </div>
                                        <div class="ps_-block ps_-block-sub servers-mixed">
                                            <div class="ps__-title"><i class="fas fa-server mr-2"></i>SERVERS:</div>
                                            <div class="ps__-list">
                                                <div class="item">
                                                     <a id="server1" href="<?=$websiteUrl?>/player/v1.php?id=<?= $url ?>"
                                                        target="iframe-to-load" class="btn btn-server active">Server
                                                        1</a>
                                                </div>
                                                <div class="item">
                                                    <a id="server2"
                                                        href="https://player.ryuk.to?id=<?= $url ?>"
                                                        target="iframe-to-load" class="btn btn-server">Server 2</a>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div id="source-guide"></div>
                                        </div>
                                    </div>
                                </div>

                                <div id="episodes-content">
                                    <div class="seasons-block seasons-block-max">
                                        <div id="detail-ss-list" class="detail-seasons">
                                            <div class="detail-infor-content">
                                                <div style="min-height:43px;" class="ss-choice">
                                                    <div class="ssc-list">
                                                        <div id="ssc-list" class="ssc-button">
                                                            <div class="ssc-label">List of episodes:</div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="episodes-page-1" class="ss-list ss-list-min" data-page="1"
                                                    style="display:block;">

                                                    <?php 
                                                    foreach ($episodelist as $episodelist) {  ?>
                                                    <a title="Episode <?=$episodelist['episodeNum']?>"
                                                        class="ssl-item ep-item <?php if ($getEpisode['ep_num'] === $episodelist['episodeNum']) {echo 'active';}?>"
                                                        href="/watch/<?=$episodelist['episodeId']?>">
                                                        <div class="ssli-order" title=""><?=$episodelist['episodeNum']?>
                                                        </div>
                                                        <div class="ssli-detail">
                                                            <div class="ep-name dynamic-name" data-jname="" title="">
                                                            </div>
                                                        </div>
                                                        <div class="ssli-btn">
                                                            <div class="btn btn-circle"><i class="fas fa-play"></i>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="anis-watch-detail">
                                <div class="anis-content">
                                    <div class="anisc-poster">
                                        <div class="film-poster">
                                            <img src="<?=$getAnime['imageUrl']?>" data-src="<?=$getAnime['imageUrl']?>"
                                                class="film-poster-img ls-is-cached lazyloaded"
                                                alt="<?=$getAnime['name']?>">
                                        </div>
                                    </div>
                                    <div class="anisc-detail">
                                        <h2 class="film-name">
                                            <a href="/anime/<?=$anime?>" class="text-white dynamic-name"
                                                title="<?=$getAnime['name']?>" data-jname="<?=$getAnime['name']?>"
                                                style="opacity: 1;"><?=$getAnime['name']?></a>
                                        </h2>
                                        <div class="film-stats">
                                            <div class="tac tick-item tick-quality">HD</div>
                                            <div class="tac tick-item tick-dub">SUB</div>
                                            <span class="dot"></span>
                                            <span class="item"><?=$getAnime['status']?></span>
                                            <span class="dot"></span>
                                            <span class="item"><?=$getAnime['released']?></span>
                                            <span class="dot"></span>
                                            <span class="item"><?=$getAnime['othername']?></span>
                                            <span class="dot"></span>
                                            <span class="item"><?=$getAnime['type']?></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="film-description m-hide">
                                            <div class="text"><?=$getAnime['synopsis']?></div>
                                        </div>
                                        <div class="film-text m-hide mb-3">
                                            <?=$websiteTitle?> is a site to watch online anime like
                                            <strong><?=$getAnime['name']?></strong> online, or you can even watch
                                            <strong><?=$getAnime['name']?></strong> in HD quality
                                        </div>
                                        <div class="block"><a href="/anime/<?=$anime?>" class="btn btn-xs btn-light"><i
                                                    class="fas fa-book-open mr-2"></i> View detail</a></div>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="share-buttons share-buttons-detail">
                <div class="container">
                    <div class="share-buttons-block">
                        <div class="share-icon"></div>
                        <div class="sbb-title">
                            <span>Share Anime</span>
                            <p class="mb-0">to your friends</p>
                        </div>
                        <div class="addthis_inline_share_toolbox"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div id="main-content">
                    <section class="block_area block_area-comment">
                        <div class="block_area-header block_area-header-tabs">
                            <div class="float-left bah-heading mr-4">
                                <h2 class="cat-heading">Comments</h2>
                            </div>
                            <div class="float-left bah-setting">

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <?php include('./_php/disqus.php'); ?>
                        </div>
                    </section>

                    <?php include('./_php/recent-releases.php'); ?>
                    <div class="clearfix"></div>
                </div>
                <?php include('./_php/sidenav.php'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php include('./_php/footer.php'); ?>
        <div id="mask-overlay"></div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js">
        </script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/app.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/comman.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/movie.js"></script>
        <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/function.js"></script>
        <script type="text/javascript">
        $(".btn-server").click(function() {
            $(".btn-server").removeClass("active");
            $(this).closest(".btn-server").addClass("active");
        });
        </script>
    </div>
</body>

</html>