<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '_config.php';
session_start();

$query = $_SERVER['QUERY_STRING'] ?: 'sort=default';

if ($query) {
    $apiUrl = "$zpi/filter?$query";

    try {
        $response = file_get_contents($apiUrl);
        if ($response !== false) {
            $data = json_decode($response, true);
            if ($data && isset($data['success']) && $data['success'] && isset($data['results']['data'])) {
                $searchResults = $data['results']['data'];
                $currentPage = $data['results']['currentPage'] ?? 1;
                $totalPages = $data['results']['totalPage'] ?? 1;
                $hasNextPage = $data['results']['hasNextPage'] ?? false;
            } else {
                $errorMessage = 'Failed to fetch search results. Please try again later.';
            }
        } else {
            $errorMessage = 'Could not connect to the API.';
        }
    } catch (Exception $e) {
        $errorMessage = 'An error occurred: ' . $e->getMessage();
    }
}

$itemsPerPage = 36;
$totalResults = 0;
if (isset($data['results']['total'])) {
    $totalResults = $data['results']['total'];
} elseif (isset($data['results']['data'])) {
    $totalResults = count($data['results']['data']) + (($totalPages - 1) * $itemsPerPage);
} else {
    $totalResults = $totalPages * $itemsPerPage;
}

?>

<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Filtering Catalog on  <?=$websiteTitle?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="Filtering Catalog on <?=$websiteTitle?>">
    <meta name="description" content="Popular Anime in HD with No Ads. Watch anime online">
    <meta name="keywords" content="<?=$websiteTitle?>, watch anime online, free anime, anime stream, anime hd, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, <?=$websiteTitle?>, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa">
    <meta name="charset" content="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="robots" content="noindex, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Language" content="en">
    <meta property="og:title" content="Filtering Catalog on <?=$websiteTitle?>">
    <meta property="og:description" content="Filtering Catalog on <?=$websiteTitle?> in HD with No Ads. Watch anime online">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?=$websiteTitle?>">
    <meta itemprop="image" content="<?=$banner?>">
    <meta property="og:image" content="<?=$banner?>">
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
    <meta property="twitter:card" content="summary">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css?v=<?=$version?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css?v=<?=$version?>" type="text/css">
    <link rel="apple-touch-icon" href="<?= $websiteUrl ?>/public/logo/favicon.png?v=<?= $version ?>" />
    <link rel="shortcut icon" href="<?= $websiteUrl ?>/public/logo/favicon.png?v=<?= $version ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $websiteUrl ?>/public/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $websiteUrl ?>/public/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $websiteUrl ?>/public/logo/favicon-16x16.png">
    <link rel="mask-icon" href="<?= $websiteUrl ?>/public/logo/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="icon" sizes="192x192" href="<?= $websiteUrl ?>/public/logo/touch-icon-192x192.png?v=<?= $version ?>">
    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/styles.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/new.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/search.css">
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
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css?v=<?=$version?>" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css?v=<?=$version?>" />
    </noscript>
    <script></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="<?=$websiteUrl?>/src/assets/js/search.js"></script>

</head>

<body data-page="page_anime">
    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
        <?php include('src/component/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" class="layout-page page-az page-filter">
            <div class="container">
                <div class="prebreadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Filter</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-search-wrap">
                    <div id="filter-block">
                        <?php include('src/component/filter.php'); ?>
                    </div>
                    <section class="block_area block_area_search">
                        <div class="block_area-header">
                            <div class="float-left bah-heading">
                                <h2 class="cat-heading">Filter Results</h2>
                            </div>
                            <div class="float-right bah-result">
                                <span style="line-height: 40px;"><?=$totalResults?> results</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
                            <div class="film_list-wrap">
                                <?php if ($query && !empty($searchResults)): ?>
                                    <?php foreach ($searchResults as $anime): ?>
                                        <div class="flw-item">
                                            <div class="film-poster">
                                                <?php if ($anime['adultContent']) { ?>
                                                    <div class="tick ltr" style="position: absolute; top: 10px; left: 10px;">
                                                        <div class="tick-item tick-age amp-algn">18+</div>
                                                    </div>
                                                <?php } ?>
                                                <div class="tick ltr" style="position: absolute; bottom: 10px; left: 10px;">
                                                    <?php if (!empty($anime['tvInfo']['sub'])) { ?>
                                                        <div class="tick-item tick-sub amp-algn" style="text-align: left;">
                                                            <i class="fas fa-closed-captioning"></i> &nbsp;<?=$anime['tvInfo']['sub']?>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($anime['tvInfo']['dub'])) { ?>
                                                        <div class="tick-item tick-dub amp-algn" style="text-align: left;">
                                                            <i class="fas fa-microphone"></i> &nbsp;<?=$anime['tvInfo']['dub']?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <img class="film-poster-img lazyload" data-src="<?=$anime['poster']?>" src="<?=$websiteUrl?>/public/images/no_poster.jpg" alt="<?=$anime['title']?>">
                                                <a class="film-poster-ahref" href="/details/<?=$anime['id']?>" title="<?=$anime['title']?>">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            </div>
                                            <div class="film-detail">
                                                <h3 class="film-name">
                                                    <a href="/details/<?=$anime['id']?>"><?=$anime['title']?></a>
                                                </h3>
                                                <div class="fd-infor">
                                                    <span class="fdi-item"><?=$anime['tvInfo']['showType']?></span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item"><?=$anime['tvInfo']['duration']?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php elseif ($query): ?>
                                    <p>No results found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    </section>
                    
                    <div class="pre-pagination mt-5 mb-5">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-lg justify-content-center">
                          
                                <?php
                                $range = 2;
                                $start = max(1, $currentPage - $range);
                                $end = min($totalPages, $currentPage + $range);

                                if ($currentPage > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=1" title="First">«</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $currentPage - 1 ?>" title="Previous">‹</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = $start; $i <= $end; $i++): ?>
                                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>" title="Page <?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($hasNextPage): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $currentPage + 1 ?>" title="Next">›</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $totalPages ?>" title="Last">»</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php include('./src/component/footer.php'); ?>
        <div id="mask-overlay"></div>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/comman.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/app.js"></script>
        <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/function.js"></script>
        <script src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/pre-qtip.js"></script>
        <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/app.min.js?v=1.4"></script>

        <script>
        let currentPage = <?= $currentPage ?>;
        let totalPages = <?= $totalPages ?>;
        let hasNextPage = <?= $hasNextPage ? 'true' : 'false' ?>;

        function updateFilterResults(params = null) {
            const query = new URLSearchParams(window.location.search);
            
            if (params) {
                Object.entries(params).forEach(([key, value]) => {
                    if (value) {
                        query.set(key, value);
                    } else {
                        query.delete(key);
                    }
                });
            }

            if (!query.has('page')) {
                query.set('page', '1');
            }

            const apiUrl = `<?= $zpi ?>/filter?${query.toString()}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.results.data) {
                        const resultsContainer = document.querySelector('.film_list-wrap');
                        resultsContainer.innerHTML = '';

                        totalPages = data.results.totalPage;
                        currentPage = data.results.currentPage;
                        hasNextPage = data.results.hasNextPage;
                        const totalResults = data.results.total || (totalPages * 36);
                        document.querySelector('.bah-result span').textContent = `${totalResults} results`;

                        data.results.data.forEach(anime => {
                            const item = document.createElement('div');
                            item.className = 'flw-item';
                            item.innerHTML = `
                                <div class="film-poster">
                                    ${anime.adultContent ? '<div class="tick ltr" style="position: absolute; top: 10px; left: 10px;"><div class="tick-item tick-age amp-algn">18+</div></div>' : ''}
                                    <div class="tick ltr" style="position: absolute; bottom: 10px; left: 10px;">
                                        ${anime.tvInfo.sub ? `<div class="tick-item tick-sub amp-algn" style="text-align: left;"><i class="fas fa-closed-captioning"></i> &nbsp;${anime.tvInfo.sub}</div>` : ''}
                                        ${anime.tvInfo.dub ? `<div class="tick-item tick-dub amp-algn" style="text-align: left;"><i class="fas fa-microphone"></i> &nbsp;${anime.tvInfo.dub}</div>` : ''}
                                    </div>
                                    <img class="film-poster-img lazyload" data-src="${anime.poster}" src="<?=$websiteUrl?>/public/images/no_poster.jpg" alt="${anime.title}">
                                    <a class="film-poster-ahref" href="/details/${anime.id}" title="${anime.title}"><i class="fas fa-play"></i></a>
                                </div>
                                <div class="film-detail">
                                    <h3 class="film-name"><a href="/details/${anime.id}">${anime.title}</a></h3>
                                    <div class="fd-infor">
                                        <span class="fdi-item">${anime.tvInfo.showType}</span>
                                        <span class="dot"></span>
                                        <span class="fdi-item">${anime.tvInfo.duration}</span>
                                    </div>
                                </div>
                            `;
                            resultsContainer.appendChild(item);
                        });

                        updatePagination();
                        
                        window.history.pushState({}, '', `?${query.toString()}`);
                    } else {
                        document.querySelector('.film_list-wrap').innerHTML = '<p>No results found.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching results:', error);
                    document.querySelector('.film_list-wrap').innerHTML = '<p>Error loading results. Please try again.</p>';
                });
        }

        function updatePagination() {
            const paginationContainer = document.querySelector('.pagination');
            const range = 2;
            const start = Math.max(1, currentPage - range);
            const end = Math.min(totalPages, currentPage + range);
            
            let paginationHTML = '';
            
            if (currentPage > 1) {
                paginationHTML += `
                    <li class="page-item">
                        <a class="page-link" data-page="1" href="#" title="First">«</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-page="${currentPage - 1}" href="#" title="Previous">‹</a>
                    </li>
                `;
            }

            for (let i = start; i <= end; i++) {
                paginationHTML += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" data-page="${i}" href="#" title="Page ${i}">${i}</a>
                    </li>
                `;
            }

            if (hasNextPage) {
                paginationHTML += `
                    <li class="page-item">
                        <a class="page-link" data-page="${currentPage + 1}" href="#" title="Next">›</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" data-page="${totalPages}" href="#" title="Last">»</a>
                    </li>
                `;
            }

            paginationContainer.innerHTML = paginationHTML;

            document.querySelectorAll('.pagination .page-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = e.target.dataset.page;
                    updateFilterResults({ page });
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            updatePagination();

            const filterForm = document.querySelector('#filter-form');
            if (filterForm) {
                filterForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const formData = new FormData(filterForm);
                    const params = Object.fromEntries(formData.entries());
                    params.page = 1;
                    updateFilterResults(params);
                });
            }

            document.querySelectorAll('#filter-form select').forEach(select => {
                select.addEventListener('change', () => {
                    const formData = new FormData(filterForm);
                    const params = Object.fromEntries(formData.entries());
                    params.page = 1;
                    updateFilterResults(params);
                });
            });
        });
        </script>
    </div>
</body>
</html>
