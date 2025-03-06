<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php'); // Make sure config.php is included
session_start();

if(isset($_COOKIE['userID'])){
  header('location:../../home');
  exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include reCAPTCHA secret key from your _config.php...Dont Be Dumb Now LMAO
$secretKey = $google_recap_secret_key;  // Your secret key from Google reCAPTCHA

if (isset($_POST['submit']) || isset($_POST['anilist_login'])) {
    // Get the reCAPTCHA response
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Psssst!! Verify reCAPTCHA
    $recaptchaVerifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaVerifyResponse = file_get_contents(
        $recaptchaVerifyUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse
    );
    $recaptchaVerifyResult = json_decode($recaptchaVerifyResponse);

    if ($recaptchaVerifyResult->success) {
        // Proceed with your login logic :-P

        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $_POST['login'], $_POST['login']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION['userID'] = $row['id'];
                setcookie('userID', $row['id'], time() + 60 * 60 * 24 * 30 * 12, '/');
                
                if (isset($_GET['animeId'])) {
                    $animeId = $_GET['animeId'];
                    header('location:../anime/' . $animeId);
                    exit();
                } elseif (isset($_GET['redirect'])) {
                    $redirectUrl = $_GET['redirect'];
                    header('location:' . $redirectUrl);
                    exit();
                } else {
                    header('location:../../home');
                    exit();
                }
            } else {
                $message[] = 'Incorrect password!';
            }
        } else {
            $message[] = 'User not found!';
        }
    } else {
        $message[] = 'reCAPTCHA verification failed!';
    }
}
?>

<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Login - <?=$websiteTitle?></title>

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
<link rel="stylesheet" href="<?= $websiteUrl ?>/files/css/min.css?v=<?= $version ?>">
<link rel="apple-touch-icon" href="<?= $websiteUrl ?>/favicon.png?v=<?= $version ?>" />
<link rel="shortcut icon" href="<?= $websiteUrl ?>/favicon.png?v=<?= $version ?>" type="image/x-icon" />
<link rel="apple-touch-icon" sizes="180x180" href="<?= $websiteUrl ?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= $websiteUrl ?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $websiteUrl ?>/favicon-16x16.png">
<link rel="mask-icon" href="<?= $websiteUrl ?>/safari-pinned-tab.svg" color="#5bbad5">
<link rel="icon" sizes="192x192" href="<?= $websiteUrl ?>/files/images/touch-icon-192x192.png?v=<?= $version ?>">
<link rel="stylesheet" href="<?= $websiteUrl ?>/src/assets/css/new.css?v=<?= $version ?>">
 
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
  <scripts></scripts>
  
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body data-page="page_login">
  <div id="sidebar_menu_bg"></div>
  <div id="wrapper" data-page="page_home">
    <?php include 'src/component/header.php'; ?>
    <div class="clearfix"></div>
    <div id="main-wrapper" class="layout-page layout-page-404">
      <div class="container">
        <div class="container-404 text-center">
          <div class="c4-medium">Login Your Account</div>
          <div class="c4-big-img">
            <!-- Regular Email Login Form -->
            <form class="preform" method="post" action="" id="email-login-form">
                <div class="form-group">
                    <label class="prelabel" for="email">Username Or Email address</label>
                    <div class="col-sm-6" style="float:none;margin:auto;">
                        <input type="text" class="form-control" name="login"
                            placeholder="user69 or name@email.com" required="">
                    </div>
                </div>
<div class="form-group">
    <label class="prelabel" for="password">Password</label>
    <div class="col-sm-6" style="float:none;margin:auto;">
        <input type="password" class="form-control" name="password" placeholder="Password" required="">
    </div>
</div>

<!-- Add reCAPTCHA v2 here -->
<div class="form-group">
    <div class="col-sm-6" style="float:none;margin:auto;">
        <div class="g-recaptcha" data-sitekey="<?= $google_recap_site_key ?>"></div>
    </div>
</div>

<div class="mt-4">&nbsp;</div>

                <div class="form-group login-btn mb-0">
                    <div class="col-sm-6" style="float:none;margin:auto;">
                        <button id="btn-login" name="submit" class="btn btn-primary btn-block">Login with Email</button>
                    </div>
                </div>
            </form>
          </div>
          <div class="c4-small">Don't have an account? <a href="<?=$websiteUrl?>/register" class="link-highlight register-tab-link"
              title="Register">Register</a></div>
          <div class="c4-button">
            <a href="/" class="btn btn-radius btn-focus"><i class="fa fa-chevron-circle-left mr-2"></i>Back to
              <?=$websiteTitle?></a>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <?php include 'src/component/footer.php'; ?>
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
    </div>
    <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<script type="text/javascript">swal({title: "Error!",text: "Incorrect Email or Password!",icon: "warning",button: "Close",})</script>;';
         }
      }
      ?>
    <div style="display:none;">
    </div>
  </div>

  <script>
  document.getElementById('email-login-form').addEventListener('submit', function(e) {
     
  });
  </script>
</body>

</html>
