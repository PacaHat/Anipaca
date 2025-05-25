<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');
session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if (!isset($_COOKIE['userID'])) {
    header('location:/login');
    exit();
}

$user_id = $_COOKIE['userID'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


$page = $_GET['page'] ?? 1;
$items_per_page = 10; 
$offset = ($page - 1) * $items_per_page; 

$status = $_GET['status'] ?? 'All'; 
$safeStatus = htmlspecialchars($status ?? '', ENT_QUOTES, 'UTF-8');

// Map status to type values
$statusMap = [
    'Watching' => 1,
    'On-Hold' => 2,
    'Plan to Watch' => 3,
    'Dropped' => 4,
    'Completed' => 5
];

$type = $statusMap[$status] ?? null;

$site_watchlist_sql = "SELECT * FROM watchlist WHERE user_id = ?";
if ($type !== null) {
    $site_watchlist_sql .= " AND type = ?";
}
$site_watchlist_sql .= " LIMIT ? OFFSET ?";

$site_stmt = $conn->prepare($site_watchlist_sql);
if ($type !== null) {
    $site_stmt->bind_param("iiii", $user_id, $type, $items_per_page, $offset);
} else {
    $site_stmt->bind_param("iii", $user_id, $items_per_page, $offset);
}
$site_stmt->execute();
$site_watchlist_result = $site_stmt->get_result();


$count_site_sql = "SELECT COUNT(*) as total FROM watchlist WHERE user_id = ?";
$count_site_stmt = $conn->prepare($count_site_sql);
$count_site_stmt->bind_param("i", $user_id);
$count_site_stmt->execute();
$total_site_items = $count_site_stmt->get_result()->fetch_assoc()['total'];


$total_pages = ceil($total_site_items / $items_per_page);
?>


<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>Your watchlist on <?= $websiteTitle ?> </title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title"
        content="<?= $websiteTitle ?> #1 Watch High Quality Anime Online Without Ads" />
    <meta name="description"
        content="<?= $websiteTitle ?> #1 Watch High Quality Anime Online Without Ads. You can watch anime online free in HD without Ads. Best place for free find and one-click anime." />
    <meta name="keywords"
        content="<?= $websiteTitle ?>, watch anime online, free anime, anime stream, anime hd, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa" />
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
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/min.css?v=<?= $version ?>">
    <link rel="apple-touch-icon" href="<?= $websiteUrl ?>/public/logo/favicon.png?v=<?= $version ?>" />
    <link rel="shortcut icon" href="<?= $websiteUrl ?>/public/logo/favicon.png?v=<?= $version ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $websiteUrl ?>/public/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $websiteUrl ?>/public/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $websiteUrl ?>/public/logo/favicon-16x16.png">
    <link rel="mask-icon" href="<?= $websiteUrl ?>/public/logo/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="icon" sizes="192x192" href="<?= $websiteUrl ?>/public/logo/touch-icon-192x192.png">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/new.css?v=<?= $version ?>">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/profile.css?v=<?= $version ?>">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/search.css">
    <script src="<?= $websiteUrl ?>/src/assets/js/search.js"></script>
     
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
    <!-- Enhanced ShareThis integration -->
    <script src="<?=$websiteUrl?>/src/assets/js/share-enhanced.js"></script>

    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/search.css">
    <script src="<?=$websiteUrl?>/src/assets/js/search.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/app.js"></script>
    <script src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/comman.js"></script>
    <script src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/movie.js"></script>
    <link rel="stylesheet" href="<?= htmlspecialchars($websiteUrl) ?>/src/assets/css/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="<?= htmlspecialchars($websiteUrl) ?>/src/assets/js/function.js"></script>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Ensure Bootstrap CSS is loaded -->
    
    <!-- Ensure jQuery is loaded before Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Ensure Bootstrap JS is loaded -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>


<body data-page="page_watchlist">
  <div id="sidebar_menu_bg"></div>
  <div id="wrapper" data-page="page_home">
    <?php include 'src/component/header.php'; ?>
    <div class="clearfix"></div>

    <div id="main-wrapper" class="layout-page layout-watchlist">
      <div class="profile-header">
        <div class="profile-header-cover"
          style="background-image: url(<?= htmlspecialchars($user['image']) ?>);"></div>
        <div class="container">
          <div class="ph-title">Hi, <?= htmlspecialchars($user['username']) ?></div>
          <div class="ph-tabs">
            <div class="bah-tabs">
              <ul class="nav nav-tabs pre-tabs">
                <li class="nav-item"><a class="nav-link" href="<?= $websiteUrl ?>/profile"><i
                      class="fas fa-user mr-2"></i>Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $websiteUrl ?>/continue-watching"><i class="fas fa-history mr-2"></i>Continue Watching
                      </a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= $websiteUrl ?>/watchlist"><i class="fas fa-heart mr-2"></i>Watch
                    List</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $websiteUrl ?>/changepass"><i class="fas fa-key mr-2"></i>Change
                    Password</a></li>
                    <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showToast('(・`ω´・)', 'Do you really need settings too, baka?', 'info')">
                       <i class="fas fa-cog mr-2"></i>Settings 
                    </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="profile-content">
        <div class="container">
          <div class="profile-box profile-box-watchlist makeup">
            <h2 class="h2-heading mb-4"><i class="fas fa-heart mr-3"></i>Your Watchlist</h2>
            
            <div class="fav-tabs mb-4">
                <ul class="nav nav-tabs pre-tabs pre-tabs-min">
                    <li class="nav-item"><a href="#" class="nav-link active" data-toggle="tab" data-target="#site">Site Watchlist</a></li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="statusDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Status: <?= htmlspecialchars($status) ?>
                        </a>
                       
                    <div class="dropdown-menu" aria-labelledby="statusDropdown">
                        <a class="dropdown-item <?= $status == 'All' ? 'active' : '' ?>" href="?status=All">All</a>
                        <a class="dropdown-item <?= $status == 'Watching' ? 'active' : '' ?>" href="?status=Watching">Watching</a>
                        <a class="dropdown-item <?= $status == 'On-Hold' ? 'active' : '' ?>" href="?status=On-Hold">On-Hold</a>
                        <a class="dropdown-item <?= $status == 'Plan to Watch' ? 'active' : '' ?>" href="?status=Plan to Watch">Plan to Watch</a>
                        <a class="dropdown-item <?= $status == 'Dropped' ? 'active' : '' ?>" href="?status=Dropped">Dropped</a>
                        <a class="dropdown-item <?= $status == 'Completed' ? 'active' : '' ?>" href="?status=Completed">Completed</a>
                       </div>

                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Site Watchlist Tab -->
                <div class="tab-pane fade show active" id="site">
                    <div class="block_area-content block_area-list film_list film_list-grid">
                        <div class="film_list-wrap">
                            <?php if ($site_watchlist_result->num_rows > 0): ?>
                                <?php while($anime = $site_watchlist_result->fetch_assoc()): ?>
                                    <div class="flw-item">
                                        <div class="film-poster">
                                            <div class="tick ltr">
                                                <?php if (!empty($anime['sub_count'])): ?>
                                                    <div class="tick-item tick-sub"><i class="fas fa-closed-captioning mr-1"></i><?php echo htmlspecialchars($anime['sub_count']); ?></div>
                                                <?php endif; ?>
                                                <?php if (!empty($anime['dub_count'])): ?>
                                                    <div class="tick-item tick-dub"><i class="fas fa-microphone mr-1"></i><?php echo htmlspecialchars($anime['dub_count']); ?></div>
                                                <?php endif; ?>
                                                <div class="tick-item tick-eps"><?php echo htmlspecialchars($anime['sub_count'] ?? $anime['dub_count']); ?></div>
                                            </div>
                                            <img class="film-poster-img" 
                                                 src="<?php echo htmlspecialchars($anime['poster'] ?? '/path/to/default-image.jpg'); ?>"
                                                 alt="<?php echo htmlspecialchars($anime['anime_name'] ?? 'Unknown Title'); ?>">
                                            <a class="film-poster-ahref" 
                                               href="<?php echo $websiteUrl; ?>/details/<?php echo htmlspecialchars($anime['anime_id'] ?? ''); ?>"
                                               title="<?php echo htmlspecialchars($anime['anime_name'] ?? 'Unknown Title'); ?>">
                                               <i class="fas fa-play"></i>
                                            </a>
                                        </div>
                                        <div class="film-detail">
                                            <h3 class="film-name">
                                                <a href="<?php echo $websiteUrl; ?>/details/<?php echo htmlspecialchars($anime['anime_id'] ?? ''); ?>"
                                                   title="<?php echo htmlspecialchars($anime['anime_name'] ?? 'Unknown Title'); ?>">
                                                    <?php echo htmlspecialchars($anime['anime_name'] ?? 'Unknown Title'); ?>
                                                </a>
                                            </h3>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="alert alert-warning">No anime in your site watchlist yet!</div>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pagination">
                            <?php if ($total_pages > 1): ?>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?status=<?= urlencode($status) ?>&page=<?= $page-1 ?>">Previous</a>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?status=<?= urlencode($status) ?>&page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        
                                        <?php if ($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?status=<?= urlencode($status) ?>&page=<?= $page+1 ?>">Next</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('./src/component/anime/new-on.php'); ?>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <?php include 'src/component/footer.php' ?>
    <div id="mask-overlay"></div>
    
<script type="text/javascript">
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
<div id="mask-overlay"></div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js?v=1.5"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js?v=1.5"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
  
    <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/comma.js?v=1.5"></script>
    <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/movie.js?v=1.5"></script>
    <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/jquery-ui.css?v=1.5">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?v=1.5"></script>
    <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/function.js?v=1.5"></script>
    <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/app.min.js?v=1.4"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure the dropdown items trigger a page reload with the correct status
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                const status = this.getAttribute('href').split('=')[1]; // Extract status from href

                // Redirect to the new URL with the selected status
                window.location.href = `watchlist.php?status=${status}`;
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check local storage for the last active tab
        const lastActiveTab = localStorage.getItem('activeTab');
        if (lastActiveTab) {
            // Deactivate all tabs and tab contents
            document.querySelectorAll('.nav-link[data-toggle="tab"]').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });

            // Activate the last active tab
            document.querySelector(`.nav-link[data-target="${lastActiveTab}"]`).classList.add('active');
            document.querySelector(lastActiveTab).classList.add('show', 'active');
        }

        // Add click event to store the active tab in local storage
        document.querySelectorAll('.nav-link[data-toggle="tab"]').forEach(tab => {
            tab.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                localStorage.setItem('activeTab', target);
            });
        });
    });
    </script>

    </div>
  </div>

</body>

</html>
