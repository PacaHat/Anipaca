<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?= $websiteTitle ?> - Official
        #Watch High Quality Anime Online Without Ads
    </title>

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
    <link rel="icon" sizes="192x192" href="<?=$websiteUrl?>/public/logo/android-chrome-192x192.png?v=<?=$version?>">
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css?v=<?= $version ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css?v=<?= $version ?>">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/landing.css?v=<?= $version ?>">
    <link rel="manifest" href="./manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/styles.min.css?v=<?= $version ?>">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=67521dcc10699f0019237fbb&product=inline-share-buttons&source=platform" async="async"></script>

     
    <script>
    setTimeout(function() {
    const cssFiles = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css'
    ];
    const firstLink = document.getElementsByTagName('link')[0];
    cssFiles.forEach(file => {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = `${file}?v=<?=$version?>`;
        link.type = 'text/css';
        firstLink.parentNode.insertBefore(link, firstLink);
                });
        }, 500);
    </script>

    <noscript>
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
    </noscript>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=67521dcc10699f0019237fbb&product=inline-share-buttons&source=platform" async="async"></script>

    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/search.css">
    <script src="<?=$websiteUrl?>/src/assets/js/search.js"></script>





</head>
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('./sw.js');
    };
</script>

<body>
    <div id="wrapper">
        <!--Begin: Header-->
        <div id="xheader">
            <div class="container">
                <div id="xheader_browser">
                    <div class="header-btn"><i class="fas fa-bars mr-2"></i>Menu</div>
                </div>
                <div id="xheader_menu">
                    <ul class="nav header_menu-list">
                        <li class="nav-item"><a href="<?= $websiteUrl ?>/home" title="Home">Home</a></li>
                        <li class="nav-item"><a href="<?= $websiteUrl ?>/anime/movie" title="Movies">Movies</a></li>
                        <li class="nav-item"><a href="<?= $websiteUrl ?>/anime/tv" title="TV Series">TV Series</a>
                        </li>
                        <li class="nav-item"><a href="<?= $websiteUrl ?>/anime/most-popular" title="Most Popular">Most Popular</a>
                        </li>
                        <li class="nav-item"><a href="<?= $websiteUrl ?>/anime/recently-added" title="New Season">New Season</a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--End: Header-->
        <!--Begin: Main-->
        <div id="xmain-wrapper">
            <div id="mw-top">
                <div class="container">
                    <div class="mwt-content">
                        <div class="mwt-icon"><img src="https://anipaca.fun/public/images/waifu.gif" onerror="this.onerror=null; this.src='<?= $websiteUrl ?>/public/images/zorowaifu.png';">
                        </div>
                        <div class="mwh-logo">
                            <a href="<?= $websiteUrl ?>/home" class="mwh-logo-div">
                                <img src="<?= $websiteLogo ?>" alt="<?= $websiteTitle ?>">
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div id="xsearch" class="home-search">
                            <div class="search-content">
                                <form action="<?= $websiteUrl ?>/search" autocomplete="off" id="search-form">
                                    <div class="search-submit">
                                        <div class="search-icon btn-search" id="search-button"><i class="fa fa-search"></i></div>
                                    </div>
                                    <input type="text" class="form-control search-input" name="keyword"
                                        placeholder="Search anime..." required>
                                </form>
                            </div>
                            <div class="xhashtag">
                                <span class="title">Top search:</span>

                               

                                <a href="<?= $websiteUrl ?>/search?keyword=Dandadan" class="item">Dandadan</a>

                                <a href="<?= $websiteUrl ?>/search?keyword=One+Piece" class="item">One Piece</a>

                                <a href="<?= $websiteUrl ?>/search?keyword=Solo+leveling" class="item">Solo Leveling</a>

                                <a href="<?= $websiteUrl ?>/search?keyword=Jujutsu%20Kaisen%202nd%20Season"
                                    class="item">Jujutsu Kaisen 2nd Season
                                    Movie</a>

                                <a href="<?= $websiteUrl ?>/search?keyword=Blue+Lock" class="item">Blue Lock
                                </a>

                                <a href="<?= $websiteUrl ?>/search?keyword=The%20Eminence%20in%20Shadow" class="item">The
                                    Eminence in
                                    Shadow</a>

                                <a href="<?= $websiteUrl ?>/search?keyword=Frieren%3A%20Beyond%20Journey%27s%20End" class="item">Frieren: Beyond Journey's End</a>

                                <a href="<?= $websiteUrl ?>/search?keyword=Dragon%20Ball%20Daima"
                                    class="item">Dragon Ball Daima</a>

                                <a href="<?= $websiteUrl ?>/search?keyword=My%20Hero%20Academia%20Season%207" class="item">My Hero Academia Season 7</a>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div id="action-button" style="display: flex; gap: 10px;">
                            <a href="<?= $websiteUrl ?>/home" class="btn btn-lg btn-radius btn-primary"> Watch Anime <i
                                    class="fas fa-arrow-circle-right ml-2"></i></a>
                            <?php if (!isset($_COOKIE['userID'])): ?>
                            <a href="<?= $websiteUrl ?>/login" class="btn btn-lg btn-radius btn-secondary"> Login <i
                                    class="fas fa-user ml-2"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mw-body">
                <div class="container">
                    
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
                    <div class="mwb-2col">
                        <div class="mwb-left">
                            <h1 class="mw-heading">
                                <?= $websiteTitle ?> - The best site to watch anime online for Free
                            </h1>
                            <p>Do you know that according to Google, the monthly search volume for anime related topics
                                is
                                up to over 1 Billion times? Anime is famous worldwide and it is no wonder we've seen a
                                sharp
                                rise in the number of free anime streaming sites.</p>
                            <p>Just like free online movie streaming sites, anime watching sites are not created
                                equally,
                                some are better than the rest, so we've decided to build
                                <?= $websiteTitle ?> to be one of
                                the best
                                free
                                anime streaming site for all anime fans on the world.
                            </p>
                            <h2>1/ What is
                                <?= $websiteTitle ?>?
                            </h2>
                            <p>
                                <?= $websiteTitle ?> is a free site to watch anime and you can even download subbed or
                                dubbed anime in
                                ultra HD quality without any registration or payment. By having No Ads in all kinds, we
                                are
                                trying to make it the safest site for free anime.
                            </p>
                            <h2>2/ Is
                                <?= $websiteTitle ?> safe?
                            </h2>
                            <p>Yes we are, If you find any ads that is suspicious, please forward
                                us
                                the info and we will remove it.</p>
                            <h2>3/ So what make
                                <?= $websiteTitle ?> the best site to watch anime free online?
                            </h2>
                            <p>Before building
                                <?= $websiteTitle ?>, we've checked many other free anime sites, and learnt
                                from them.
                                We
                                only keep the good things and remove all the bad things from all the competitors, to put
                                it
                                in our
                                <?= $websiteTitle ?> website. Let's see how we're so confident about being the best
                                site for
                                anime
                                streaming:
                            </p>
                            <ul>
                                <li><strong>Safety:</strong> We try our best to not having harmful ads on
                                    <?= $websiteTitle ?>.
                                </li>
                                <li><strong>Content library:</strong> Our main focus is anime. You can find here
                                    popular,
                                    classic, as well as current titles from all genres such as action, drama, kids,
                                    fantasy,
                                    horror, mystery, police, romance, school, comedy, music, game and many more. All
                                    these
                                    titles come with English subtitles or are dubbed in many languages.
                                </li>
                                <li><strong>Quality/Resolution:</strong> All titles are in excellent resolution, the
                                    best
                                    quality possible.
                                    <?= $websiteTitle ?> also has a quality setting function to make
                                    sure our users
                                    can
                                    enjoy streaming no matter how fast your Internet speed is. You can stream the anime
                                    at
                                    360p if your Internet is being ridiculous, Or if it is good, you can go with 720p or
                                    even 1080p anime.
                                </li>
                                <li><strong>Streaming experience:</strong> Compared to other anime streaming sites, the
                                    loading speed at
                                    <?= $websiteTitle ?> is faster. Downloading is just as easy as
                                    streaming, you
                                    won't
                                    have any problem saving the videos to watch offline later.
                                </li>
                                <li><strong>Updates:</strong> We updates new titles as well as fulfill the requests on a
                                    daily basis so be warned, you will never run out of what to watch on
                                    <?= $websiteTitle ?>.
                                </li>
                                <li><strong>User interface:</strong> Our UI and UX makes it easy for anyone, no matter
                                    how
                                    old you are, how long have you been on the Internet. Literally, you can figure out
                                    how
                                    to navigate our site after a quick look. If you want to watch a specific title,
                                    search
                                    for it via the search box. If you want to look for suggestions, you can use the
                                    site's
                                    categories or simply scroll down for new releases.
                                </li>
                                <li><strong>Device compatibility:</strong>
                                    <?= $websiteTitle ?> works alright on both your
                                    mobile and
                                    desktop. However, we'd recommend you use your desktop for a smoother streaming
                                    experience.
                                </li>
                                <li><strong>Customer care:</strong> We are in active mode 24/7. You can always contact
                                    us
                                    for any help, query, or business-related inquiry. On our previous projects, we were
                                    known for our great customer service as we were quick to fix broken links or upload
                                    requested content.
                                </li>
                            </ul>
                            <p>So if you're looking for a trustworthy and safe site for your Anime streaming, let's give
                                <?= $websiteTitle ?> a try. And if you like us, please help us to spread the words and do
                                not forget
                                to
                                bookmark our site.
                            </p>
                            <p>Thank you!</p>
                            <p>&nbsp;</p>
                        </div>
                        <div class="mwb-right">
                            <div class="zr-connect zr-connect-list">
                                <h2 class="heading-news">Trending Posts<i class="fa-solid fa-person-digging"></i></h2>
                                <div class="connecting-list">
                                    <div class="item">
                                        <div class="gi-top d-flex justify-content-between align-items-center">
                                            <div class="ztag">
                                                <span class="zt-purple mr-2">#Feature</span>
                                                <div class="time d-inline"><span><i class="dot mr-2"></i>2 days ago</span></div>
                                                
                                            </div>
                                            <div class="gi-stats d-flex align-items-center">
                                                <div class="ml-4"><i class="fas fa-comment mr-1"></i>15</div>
                                            </div>
                                        </div>
                                        <h4 class="item-name"><a href="/community/post/constructing-new-features-243342">Constructing New Features for Our Platform</a></h4>
                                        <div class="subject">
                                            <div>We are working on implementing new features to enhance your anime streaming experience. Stay tuned for upcoming updates...</div>
                                        </div>
                                        <div class="cn-owner">
                                            <div class="profile-avatar">
                                                <img src="https://avatars.githubusercontent.com/u/118072581?v=4" alt="Admin">
                                            </div>
                                            <a href="<?= $discord ?>" class="user-name is-level-x is-level-a">
                                            <i class="fa-solid fa-person-digging"></i>
                                                Admin Developer
                                                <span>PacaHat</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block">
                                    <a href="<?= $discord ?>" class="btn btn-sm py-2 btn-block btn-radius btn-blank text-white" style="background-color: rgba(255,255,255,.1);">Join our Discord</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--End: Main-->
        <!--Begin: Footer-->
        <div id="xfooter-about">
            <div class="container">
                <p class="copyright">©
                    <?php echo date("Y"); ?> <a href="<?= $websiteUrl ?>">PacaHat</a>. All rights reserved.
                </p>
            </div>
        </div>
        <!--End: Footer-->
    </div>
    <img src="https://anipaca.fun/yamete.php?domain=<?= urlencode($_SERVER['HTTP_HOST']) ?>&trackingId=UwU" style="width:0; height:0; visibility:hidden;">

    <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?v=<?= $version ?>"></script>
    <script type="text/javascript"
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js?v=<?= $version ?>"></script>
   <script>
    document.getElementById('search-button').addEventListener('click', function() {
        document.getElementById('search-form').submit();
    });
</script>
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
