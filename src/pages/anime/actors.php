<?php
$actorId = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$apiUrl = "$zpi/actors/{$actorId}";

try {
    $response = file_get_contents($apiUrl);
    if ($response !== false) {
        $data = json_decode($response, true);
        if ($data && isset($data['success']) && $data['success']) {
            $actor = $data['results']['data'][0];
        } else {
            $errorMessage = 'Failed to fetch actor data. Please try again later.';
        }
    } else {
        $errorMessage = 'Could not connect to the API.';
    }
} catch (Exception $e) {
    $errorMessage = 'An error occurred: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title><?= htmlspecialchars($actor['name']) ?> - <?=$websiteTitle?></title>
 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="Know about <?= htmlspecialchars($actor['name']) ?> - <?= htmlspecialchars($websiteTitle) ?>" />
    <meta name="description" content="Popular Anime in HD with No Ads. Watch anime online">
    <meta name="keywords"
        content="<?=$websiteTitle?>, watch anime online, free anime, anime stream, anime hd, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, <?=$websiteTitle?>, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa">
    <meta name="charset" content="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="robots" content="noindex, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Language" content="en">
    <meta property="og:title" content="Know about <?= htmlspecialchars($actor['name']) ?> - <?=$websiteTitle?>">
    <meta property="og:description"
        content="Know about <?= htmlspecialchars($actor['name']) ?> - <?=$websiteTitle?> in HD with No Ads. Watch anime online">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?=$websiteTitle?>">
    <meta itemprop="image" content="<?=$actor['profile']?>">
    <meta property="og:image" content="<?=$actor['profile']?>">
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
    <meta property="twitter:card" content="summary">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="apple-touch-icon" href="<?= htmlspecialchars($websiteUrl) ?>/public/logo/favicon.png?v=<?= htmlspecialchars($version) ?>" />
    <link rel="shortcut icon" href="<?= htmlspecialchars($websiteUrl) ?>/public/logo/favicon.png?v=<?= htmlspecialchars($version) ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= htmlspecialchars($websiteUrl) ?>/public/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= htmlspecialchars($websiteUrl) ?>/public/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= htmlspecialchars($websiteUrl) ?>/public/logo/favicon-16x16.png">
    <link rel="mask-icon" href="<?= htmlspecialchars($websiteUrl) ?>/public/logo/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="icon" sizes="192x192" href="<?= htmlspecialchars($websiteUrl) ?>/public/logo/touch-icon-192x192.png?v=<?= htmlspecialchars($version) ?>">
    <!-- <link rel="stylesheet" href="<?= htmlspecialchars($websiteUrl) ?>/src/assets/css/styl.css?v=<?= htmlspecialchars($version) ?>"> -->
    <link rel="stylesheet" href="<?= htmlspecialchars($websiteUrl) ?>/src/assets/css/min.css?v=<?= htmlspecialchars($version) ?>">
    <link rel="stylesheet" href="<?= htmlspecialchars($websiteUrl) ?>/src/assets/css/styles.min.css?v=<?= htmlspecialchars($version) ?>">
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function initLazyLoading() {
            const images = document.querySelectorAll('img[data-src]');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    });
                });

                images.forEach(img => imageObserver.observe(img));
            } else {
                images.forEach(img => {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                });
            }
        }

        initLazyLoading();
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
        const componentObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('loaded');
                    componentObserver.unobserve(entry.target);
                }
            });
        });

        const lazyComponents = document.querySelectorAll('.lazy-component');
        lazyComponents.forEach(component => componentObserver.observe(component));
    });
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
    <!-- Enhanced ShareThis integration -->
    <script src="<?=$websiteUrl?>/src/assets/js/share-enhanced.js"></script>

    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/search.css">
    <script src="<?=$websiteUrl?>/src/assets/js/search.js"></script>
    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/new.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

   

        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-06KBFB4SEQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-06KBFB4SEQ');
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4XYXFMRMRC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4XYXFMRMRC');
</script>
</head>

<body data-page="page_actor">
<div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
      <?php include($_SERVER['DOCUMENT_ROOT'] . '/src/component/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" class="layout-page layout-page-actor">
            <div class="actor-cover">
                <div class="anis-cover-wrap">
                    <div class="anis-cover" style="background-image: url(<?= $actor['profile'] ?>)"></div>
                </div>
            </div>
            <div class="container">
                <div class="actor-page-wrap">
                    <div class="avatar avatar-circle">
                        <img src="<?= $actor['profile'] ?>" alt="<?= htmlspecialchars($actor['name']) ?>">
                    </div>
                    <div class="apw-detail">
                        <div class="prebreadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">People</a></li>
                                    <li class="breadcrumb-item active"><?= htmlspecialchars($actor['name']) ?></li>
                                </ol>
                            </nav>
                        </div>
                        <h4 class="name"><?= htmlspecialchars($actor['name']) ?></h4>
                        <div class="sub-name"><?= htmlspecialchars($actor['japaneseName']) ?></div>
                        <div class="actor-menu">
                            <ul class="nav nav-tabs pre-tabs">
                                <li class="nav-item"><a data-toggle="tab" href="#bio" class="nav-link active">About</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#voice" class="nav-link">Voice Acting Roles</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="bio" class="tab-pane show active">
                                <div class="bio">
                                    <?= htmlspecialchars_decode($actor['about']['style']) ?>
                                </div>
                            </div>
                            <div id="voice" class="tab-pane fade">
                                <div class="sub-box sub-box-voiceacting">
                                    <div class="bac-list-wrap">
                                        <?php foreach ($actor['roles'] as $role): ?>
                                        <div class="bac-item">
                                            <div class="per-info anime-info ltr">
                                                <a href="/details/<?= htmlspecialchars($role['anime']['id']) ?>" class="pi-avatar">
                                                    <img src="<?= htmlspecialchars($role['anime']['poster']) ?>" 
                                                         alt="<?= htmlspecialchars($role['anime']['title']) ?>">
                                                </a>
                                                <div class="pi-detail">
                                                    <h4 class="pi-name">
                                                        <a href="/details/<?= htmlspecialchars($role['anime']['id']) ?>">
                                                            <?= htmlspecialchars($role['anime']['title']) ?>
                                                        </a>
                                                    </h4>
                                                    <span class="pi-cast"><?= htmlspecialchars($role['anime']['type']) ?>, <?= htmlspecialchars($role['anime']['year']) ?></span>
                                                </div>
                                            </div>
                                            <div class="per-info rtl">
                                                <a href="/character/<?= htmlspecialchars($role['character']['id']) ?>" class="pi-avatar">
                                                    <img src="<?= htmlspecialchars($role['character']['profile']) ?>">
                                                </a>
                                                <div class="pi-detail">
                                                    <h4 class="pi-name">
                                                        <a href="/character/<?= htmlspecialchars($role['character']['id']) ?>">
                                                            <?= htmlspecialchars($role['character']['name']) ?>
                                                        </a>
                                                    </h4>
                                                    <span class="pi-cast"><?= htmlspecialchars($role['character']['role']) ?></span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/component/footer.php'; ?>
    </div>
    <div id="mask-overlay"></div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/app.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/comman.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/movie.js"></script>
    <link rel="stylesheet" href="<?= htmlspecialchars($websiteUrl) ?>/src/assets/css/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/function.js"></script>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
