<?php 
require('./_config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$websiteTitle?> - Official <?=$websiteTitle?> Watch High Quality Anime Online Without Ads</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index,follow" />
    <meta http-equiv="content-language" content="en" />
    <meta name="description"
        content="<?=$websiteTitle?> - Official <?=$websiteTitle?> #1 Watch High Quality Anime Online Without Ads. You can watch anime online free in HD without Ads. Best place for free find and one-click anime." />
    <meta name="keywords"
        content="anime to watch, watch anime,anime online, free anime online, online anime, anime streaming, stream anime online, english anime, english dubbed anime" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?=$websiteUrl?>" />
    <meta property="og:title"
        content="<?=$websiteTitle?> - Official <?=$websiteTitle?> Watch High Quality Anime Online Without Ads" />
    <meta property="og:image" content="<?=$banner?>" />
    <meta property="og:description"
        content="<?=$websiteTitle?> - Official <?=$websiteTitle?> #1 Watch High Quality Anime Online Without Ads. You can watch anime online free in HD without Ads. Best place for free find and one-click anime." />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="shortcut icon" href="<?=$websiteUrl?>/favicon.ico?v=<?=$version?>?v=<?=$version?>" type="image/x-icon" />
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/home.css?v=<?=$version?>?v=0.5">
    <link rel="manifest" href="./manifest.json">
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
                        <li class="nav-item"><a href="<?=$websiteUrl?>/home" title="Home">Home</a></li>
                        <li class="nav-item"><a href="<?=$websiteUrl?>/type/movies" title="Movies">Movies</a></li>
                        <li class="nav-item"><a href="<?=$websiteUrl?>/type/tv-series" title="TV Series">TV Series</a>
                        </li>
                        <li class="nav-item"><a href="<?=$websiteUrl?>/popular" title="Most Popular">Most Popular</a>
                        </li>
                        <li class="nav-item"><a href="<?=$websiteUrl?>/new-season" title="New Season">New Season</a>
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
                        <div class="mwt-icon"><img src="https://anikatsu.me/files/images/render1.png">
                        </div>
                        <div class="mwh-logo">
                            <a href="<?=$websiteUrl?>/home" class="mwh-logo-div">
                                <img src="<?=$websiteLogo?>" alt="<?=$websiteTitle?>">
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div id="xsearch" class="home-search">
                            <div class="search-content">
                                <form action="<?=$websiteUrl?>/search" autocomplete="off" id="search-form">
                                    <div class="search-submit">
                                        <div class="search-icon btn-search"><i class="fa fa-search"></i></div>
                                    </div>
                                    <input type="text" class="form-control search-input" name="keyword"
                                        placeholder="Search anime..." required>
                                </form>
                            </div>
                            <div class="xhashtag">
                                <span class="title">Top search:</span>

                                <a href="<?=$websiteUrl?>/search?keyword=One%20Piece" class="item">One Piece</a>

                                <a href="<?=$websiteUrl?>/search?keyword=Naruto%3A%20Shippuden" class="item">Naruto:
                                    Shippuden</a>

                                <a href="<?=$websiteUrl?>/search?keyword=Naruto" class="item">Naruto</a>

                                <a href="<?=$websiteUrl?>/search?keyword=Jujutsu%20Kaisen%200%20Movie"
                                    class="item">Jujutsu Kaisen 0
                                    Movie</a>

                                <a href="<?=$websiteUrl?>/search?keyword=Bleach" class="item">Bleach</a>

                                <a href="<?=$websiteUrl?>/search?keyword=Jujutsu%20Kaisen%20(TV)" class="item">Jujutsu
                                    Kaisen (TV)</a>

                                <a href="<?=$websiteUrl?>/search?keyword=The%20Eminence%20in%20Shadow" class="item">The
                                    Eminence in
                                    Shadow</a>

                                <a href="<?=$websiteUrl?>/search?keyword=Mob%20Psycho%20100%20III" class="item">Mob
                                    Psycho 100 III</a>

                                <a href="<?=$websiteUrl?>/search?keyword=Boruto%3A%20Naruto%20Next%20Generations"
                                    class="item">Boruto:
                                    Naruto Next Generations</a>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mw-body">
                <div class="container">
                    <div id="action-button">
                        <a href="<?=$websiteUrl?>/home" class="btn btn-lg btn-radius btn-primary">View Full Site <i
                                class="fas fa-arrow-circle-right ml-2"></i></a>
                    </div>
                    <script type="text/javascript"
                        src="//s7.addthis.com/js/300/addthis_widget.js?v=<?=$version?>#pubid=ra-63430163bc99824a">
                    </script>
                    <div class="share-buttons share-buttons-detail">
                        <div class="share-buttons-block">
                            <div class="share-icon"></div>
                            <div class="sbb-title">
                                <span>Share <?=$websiteTitle?></span>
                                <p class="mb-0">to your friends</p>
                            </div>
                            <div class="sbb-social">
                                <div class="addthis_inline_share_toolbox"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    
                    <div class="mwb-2col">
                        <div class="mwb-left">
                            <h1 class="mw-heading"><?=$websiteTitle?> - The best site to watch anime online for Free
                            </h1>
                            <p>Do you know that according to Google, the monthly search volume for anime related topics
                                is
                                up to over 1 Billion times? Anime is famous worldwide and it is no wonder we've seen a
                                sharp
                                rise in the number of free anime streaming sites.</p>
                            <p>Just like free online movie streaming sites, anime watching sites are not created
                                equally,
                                some are better than the rest, so we've decided to build <?=$websiteTitle?> to be one of
                                the best
                                free
                                anime streaming site for all anime fans on the world.</p>
                            <h2>1/ What is <?=$websiteTitle?>?</h2>
                            <p><?=$websiteTitle?> is a free site to watch anime and you can even download subbed or
                                dubbed anime in
                                ultra HD quality without any registration or payment. By having No Ads in all kinds, we
                                are
                                trying to make it the safest site for free anime.</p>
                            <h2>2/ Is <?=$websiteTitle?> safe?</h2>
                            <p>Yes we are, we do have only one Ads to cover the server cost and we keep scanning the ads
                                24/7 to make sure all are clean, If you find any ads that is suspicious, please forward
                                us
                                the info and we will remove it.</p>
                            <h2>3/ So what make <?=$websiteTitle?> the best site to watch anime free online?</h2>
                            <p>Before building <?=$websiteTitle?>, we've checked many other free anime sites, and learnt
                                from them.
                                We
                                only keep the good things and remove all the bad things from all the competitors, to put
                                it
                                in our <?=$websiteTitle?> website. Let's see how we're so confident about being the best
                                site for
                                anime
                                streaming:</p>
                            <ul>
                                <li><strong>Safety:</strong> We try our best to not having harmful ads on
                                    <?=$websiteTitle?>.
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
                                    quality possible. <?=$websiteTitle?> also has a quality setting function to make
                                    sure our users
                                    can
                                    enjoy streaming no matter how fast your Internet speed is. You can stream the anime
                                    at
                                    360p if your Internet is being ridiculous, Or if it is good, you can go with 720p or
                                    even 1080p anime.
                                </li>
                                <li><strong>Streaming experience:</strong> Compared to other anime streaming sites, the
                                    loading speed at <?=$websiteTitle?> is faster. Downloading is just as easy as
                                    streaming, you
                                    won't
                                    have any problem saving the videos to watch offline later.
                                </li>
                                <li><strong>Updates:</strong> We updates new titles as well as fulfill the requests on a
                                    daily basis so be warned, you will never run out of what to watch on
                                    <?=$websiteTitle?>.
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
                                <li><strong>Device compatibility:</strong> <?=$websiteTitle?> works alright on both your
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
                                <?=$websiteTitle?> a try. And if you like us, please help us to spread the words and do
                                not forget
                                to
                                bookmark our site.</p>
                            <p>Thank you!</p>
                            <p>&nbsp;</p>
                        </div>
                        <div class="mwb-right">
                            <div class="zr-news zr-news-list">
                                <h2 class="heading-news">Popular Anime</h2>
                                <div class="item">
                                    <a href="/anime/one-piece" class="zr-news-thumb"><img
                                            src="https://gogocdn.net/images/anime/One-piece.jpg" class="zrn-image"></a>
                                    <div class="zr-news-infor">
                                        <a href="/anime/one-piece" class="zrn-title">
                                            <h4 class="news-title">One Piece</h4>
                                        </a>
                                        <div class="description">One Piece is a story about &nbsp;Monkey D. Luffy, who
                                            wants to become a sea-robber. In a world mystical, there have a mystical
                                            fruit whom eat will have a special power but also have greatest weakness.
                                            Monkey ate Gum-Gum Fruit which gave him a strange power but he can NEVER
                                            swim. And this weakness made his dream become a sea – robber to find
                                            ultimate treasure is difficult.
                                            One Piece is a story about &nbsp;Monkey D. Luffy, who wants to become a
                                            sea-robber. In a world mystical, there have a mystical fruit whom eat will
                                            have a special power but also have greatest weakness. Monkey ate Gum-Gum
                                            Fruit which gave him a strange power but he can NEVER swim. And this
                                            weakness made his dream become a sea – robber to find ultimate treasure is
                                            difficult. But along his ways, he meet himself many members to help.
                                            Together, they sail the Seven Seas of adventure in search of the elusive
                                            treasure “One Piece.” </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <a href="/anime/chainsaw-man" class="zr-news-thumb"><img
                                            src="https://gogocdn.net/cover/chainsaw-man-1664388043.png" class="zrn-image"></a>
                                    <div class="zr-news-infor">
                                        <a href="/anime/chainsaw-man" class="zrn-title">
                                            <h4 class="news-title">Chainsaw Man</h4>
                                        </a>
                                        <div class="description">Denji has a simple dream—to live a happy and peaceful life, spending time with a girl he likes. This is a far cry from reality, however, as Denji is forced by the yakuza into killing devils in order to pay off his crushing debts. Using his pet devil Pochita as a weapon, he is ready to do anything for a bit of cash. Unfortunately, he has outlived his usefulness and is murdered by a devil in contract with the yakuza. However, in an unexpected turn of events, Pochita merges with Denji's dead body and grants him the powers of a chainsaw devil. Now able to transform parts of his body into chainsaws, a revived Denji uses his new abilities to quickly and brutally dispatch his enemies. Catching the eye of the official devil hunters who arrive at the scene, he is offered work at the Public Safety Bureau as one of them. Now with the means to face even the toughest of enemies, Denji will stop at nothing to achieve his simple teenage dreams. </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <a href="/anime/bleach-sennen-kessen-hen" class="zr-news-thumb"><img
                                            src="https://gogocdn.net/cover/bleach-sennen-kessen-hen-1664387572.png"
                                            class="zrn-image"></a>
                                    <div class="zr-news-infor">
                                        <a href="/anime/bleach-sennen-kessen-hen" class="zrn-title">
                                            <h4 class="news-title">Bleach: Sennen Kessen-hen</h4>
                                        </a>
                                        <div class="description">Was it all just a coincidence, or was it inevitable? Ichigo Kurosaki gained the powers of a Soul Reaper through a chance encounter. As a Substitute Soul Reaper, Ichigo became caught in the turmoil of the Soul Society, a place where deceased souls gather. But with help from his friends, Ichigo overcame every challenge to become even stronger. </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <a href="/anime/blue-lock" class="zr-news-thumb"><img
                                            src="https://gogocdn.net/cover/blue-lock-1664387634.png"
                                            class="zrn-image"></a>
                                    <div class="zr-news-infor">
                                        <a href="/anime/blue-lock" class="zrn-title">
                                            <h4 class="news-title">Blue Lock</h4>
                                        </a>
                                        <div class="description">
                                        After reflecting on the current state of Japanese soccer, the Japanese Football Association decides to hire the enigmatic and eccentric coach Jinpachi Ego to achieve their dream of winning the World Cup. Believing that Japan has lacked an egoistic striker hungry for goals, Jinpachi initiates the Blue Lock—a prison-like facility where three hundred talented strikers from high schools all over Japan are isolated and pitted against each other. The sole survivor of Blue Lock will earn the right to become the national team's striker, and those who are defeated shall be banned from joining the team forever. Selected to join this risky project is Yoichi Isagi, a striker who failed to bring his high school soccer team to the national tournament. After choosing to pass to a teammate who missed instead of scoring on his own, he could not help but wonder if the results would have been different had he been more selfish. Using this golden opportunity given by the Blue Lock Project, Yoichi aims to clear his doubts and chase his ultimate desire—to become the greatest striker in the world and lead Japan to World Cup glory.
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <a href="/anime/naruto-shippuden" class="zr-news-thumb"><img
                                            src="https://gogocdn.net/images/anime/naruto_shippuden.jpg"
                                            class="zrn-image"></a>
                                    <div class="zr-news-infor">
                                        <a href="/anime/naruto-shippuden" class="zrn-title">
                                            <h4 class="news-title">Naruto Shippuden</h4>
                                        </a>
                                        <div class="description">Naruto Shippuden is a continuation of original series
                                            Naruto. After 2 and a half years of training with his master, Naruto finally
                                            returns to his village of Konoha. Naruto is now older and more mature than
                                            before. With his new trained ability, his goal of searching for long lost
                                            friend, Uchiha Sasuke, is set for a stronger determination than before.
                                            Naruto Shippuden is a continuation of original series Naruto. After 2 and a
                                            half years of training with his master, Naruto finally returns to his
                                            village of Konoha. Naruto is now older and more mature than before. With his
                                            new trained ability, his goal of searching for long lost friend, Uchiha
                                            Sasuke, is set for a stronger determination than before.
                                            He is putting his ambitions to work along with the help of his many friends,
                                            though with so many obstacles ahead of him. Now, he will face even more
                                            dangerous enemies, especially the Akatsuki. </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item item-more">
                                    <a href="/popular" class="btn btn-sm btn-block">Show more.</a>
                                </div>
                                <div class="clearfix"></div>
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
                    <?php echo date("Y"); ?> <a href="<?=$websiteUrl?>"><?=$websiteTitle?></a>. All rights reserved.
                </p>
            </div>
        </div>
        <!--End: Footer-->
    </div>
    <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?v=<?=$version?>"></script>
    <script type="text/javascript"
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js?v=<?=$version?>"></script>
    <script>
    $(document).ready(function() {
        $("#xheader_browser").click(function(e) {
            $("#xheader_menu, #xheader_browser").toggleClass("active");
        });
        $('.btn-search').click(function() {
            if ($('.search-input').val().trim() !== "") {
                $('#search-form').submit();
            }
        });
    });
    </script>
</body>

</html>