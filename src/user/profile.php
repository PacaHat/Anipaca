<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php'); 

// Ensure $conn is included
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if user is logged in
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $response = array();

    try {
        $username = mysqli_real_escape_string($conn, $_POST['name']);
        $avatar = isset($_POST['avatar_image']) ? mysqli_real_escape_string($conn, $_POST['avatar_image']) : null;

        if (empty($username)) {
            $response['status'] = 'error';
            $response['message'] = 'Username cannot be empty';
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        $update_stmt = $conn->prepare("UPDATE users SET username = ?, image = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $username, $avatar, $user_id);

        if ($update_stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Profile updated successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to update profile';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'An error occurred: ' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

?>

<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>Your Profile on <?= $websiteTitle ?> </title>

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
    <script src="<?= $websiteUrl ?>/src/assets/js/function.js"></script>
     
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
</head>


<body data-page="page_profile">
  <div id="sidebar_menu_bg"></div>
  <div id="wrapper" data-page="page_home">
    <?php include 'src/component/header.php'; ?>
    <div class="clearfix"></div>

    <div id="main-wrapper" class="layout-page layout-profile">
      <div class="profile-header">
        <div class="profile-header-cover"
          style="background-image: url(<?= htmlspecialchars($user['image']) ?>);"></div>
        <div class="container">
          <div class="ph-title">Hi, <?= htmlspecialchars($user['username']) ?></div>
          <div class="ph-tabs">
            <div class="bah-tabs">
              <ul class="nav nav-tabs pre-tabs">
                <li class="nav-item"><a class="nav-link active" href="<?= $websiteUrl ?>/profile"><i
                      class="fas fa-user mr-2"></i>Profile</a></li>
                <li class="nav-item"><a class="nav-link " href="<?= $websiteUrl ?>/continue-watching"><i class="fas fa-history mr-2"></i>Continue Watching
                      </a></li>
                <li class="nav-item"><a class="nav-link " href="<?= $websiteUrl ?>/watchlist"><i class="fas fa-heart mr-2"></i>Watch
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
          <div class="profile-box profile-box-account makeup">
            <h2 class="h2-heading mb-4"><i class="fas fa-user mr-3"></i>Edit Profile</h2>
            <div class="block_area-content">
              <div class="show-profile-avatar text-center mb-3">
                <div class="profile-avatar d-inline-block" data-toggle="modal" data-target="#modalavatars">
                <div class="pa-edit"><i class="fas fa-pen"></i></div>
                  <?php if (!empty($user['image'])): ?>
                      <img id="preview-avatar" src="<?= htmlspecialchars($user['image']) ?>" alt="Profile Picture">
                  <?php else: ?>
                      <img id="preview-avatar" src="<?= htmlspecialchars($user['avatar_url']) ?>" alt="Default Avatar">
                  <?php endif; ?>              
                  </div>
              </div>
              <form class="preform" method="post" id="profile-form">
                <input type="hidden" name="avatar_id" value="1">
                <input type="hidden" name="avatar_image" value="">
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <label class="prelabel" for="pro5-name">Your Name</label>
                      <input type="text" class="form-control" id="pro5-name" name="name" required value="<?= htmlspecialchars($user['username']) ?>">
                    </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <?php if (!empty($user['email'])): ?>
                        <label class="prelabel" for="pro5-email">Email address</label>
                        <input type="email" name="email" class="form-control" readonly id="pro5-email" value="<?= htmlspecialchars($user['email']) ?>">
                      <?php else: ?>
                        <label class="prelabel" for="pro5-email">User ID</label>
                        <input type="text" name="id" class="form-control" readonly id="pro5-id" value="<?= htmlspecialchars($user['id']) ?>">
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <label class="prelabel" for="pro5-join">Joined</label>
                      <input type="text" class="form-control" disabled id="pro5-join" value="<?= htmlspecialchars($user['created_at']) ?>">
                    </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                    <div class="form-group">
                      <button type="button" class="btn btn-outline-warning btn-lg" onclick="window.location.href='<?= $discord ?>'">
                        <i class="fas fa-bug"></i> Report a Bug or Feature Request
                      </button>
                    </div>
                  </div>
                  
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <div class="mt-4"></div>
                      <button type="submit" class="btn btn-block btn-primary">Update</button>
                      <div class="loading-relative" id="profile-loading" style="display:none">
                        <div class="loading">
                          <div class="span1"></div>
                          <div class="span2"></div>
                          <div class="span3"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <button type="button" class="btn btn-block btn-danger" onclick="window.location.href='<?= $websiteUrl ?>/logout'">Logout</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <?php include 'src/component/footer.php' ?>
    <?php include 'public/avatar/avatar.php' ?>
    <div id="mask-overlay"></div>
      
      <script type="text/javascript">
      function previewImage(event) {
          var reader = new FileReader();
          reader.onload = function() {
              var output = document.getElementById('preview-avatar');
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
      <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/movie.js?v=1.5"></script>
      <link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/jquery-ui.css?v=1.5">
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?v=1.5"></script>
      <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/function.js"></script>
      <script type="text/javascript" src="<?= $websiteUrl ?>/src/assets/js/app.min.js?v=1.4"></script>
      
      <script>
      $(document).ready(function() {
          $('.item-avatar').on('click', function() {
              $('.item-avatar').removeClass('active');
              $(this).addClass('active');
              var selectedAvatarImage = $(this).find('img').attr('src');
              $('input[name="avatar_image"]').val(selectedAvatarImage);

              $('#preview-avatar').attr('src', selectedAvatarImage);
          });

          $('#profile-form').on('submit', function(e) {
              e.preventDefault();

              $('#profile-loading').show();
              
          
              var formData = new FormData(this);
              formData.append('submit', 1); 
              $.ajax({
                  type: 'POST',
                  url: window.location.href,
                  data: formData,
                  processData: false, 
                  contentType: false, 
                  dataType: 'json',
                  success: function(response) {
                      $('#profile-loading').hide();
                      if(response.status === 'success') {
                          alert('Profile updated successfully!');
                          window.location.reload();
                      } else {
                          alert('Error: ' + (response.message || 'Unknown error occurred'));
                      }
                  },
                  error: function(xhr, status, error) {
                      $('#profile-loading').hide();
                      alert('An error occurred while updating profile: ' + error);
                  }
              });
          });
      });
      </script>
      
    </div>

</body>
</html>
