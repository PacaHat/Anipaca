<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');

// Start session
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get all files from the /avatar directory
$avatarFiles = array(
    "https://cdn.noitatnemucod.net/avatar/100x100/demon_splayer/File15.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/jujutsu_kaisen/File1.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-01.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-02.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-03.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-04.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-05.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-06.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-07.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_normal/av-zz-08.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/chainsaw/01.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/chainsaw/02.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/chainsaw/03.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/chainsaw/04.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/chainsaw/05.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/chainsaw/06.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/chainsaw/07.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_chibi/avatar-10.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_chibi/avatar-11.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_chibi/avatar-12.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_chibi/avatar2-01.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_chibi/avatar2-02.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_chibi/avatar2-03.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/zoro_chibi/avatar2-04.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/user-10.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/user-11.jpeg",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/03.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/04.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/05.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/18.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/File1.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/one_piece/File2.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/spy_family/06.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/spy_family/07.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/spy_family/08.png",
    "https://cdn.noitatnemucod.net/avatar/100x100/tha/12.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/tha/13.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/tha/15.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/tha/16.jpg",
    "https://cdn.noitatnemucod.net/avatar/100x100/tha/17.jpg",
);

// Filter to include only valid image files (.jpg, .jpeg, .png, .gif)
$validImageExtensions = array('jpg', 'jpeg', 'png', 'gif');
$filteredImages = array_filter($avatarFiles, function($image) use ($validImageExtensions) {
    $fileExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    return in_array($fileExtension, $validImageExtensions);
});

// Randomly select a valid image
$randomImage = $filteredImages[array_rand($filteredImages)];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize input
    $username = isset($_POST['name']) ? trim($_POST['name']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $cpassword = isset($_POST['cpassword']) ? trim($_POST['cpassword']) : null;
    $image = $randomImage;

    // Validate inputs
    if (empty($username)) {
        $message[] = "Username cannot be empty.";
    }

    if (empty($email)) {
        $message[] = "Email cannot be empty.";
    }

    if (empty($password)) {
        $message[] = "Password cannot be empty.";
    }

    if ($password !== $cpassword) {
        $message[] = "Passwords do not match!";
    }

    // If no validation errors, proceed with registration
    if (!isset($message)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $check_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $message[] = "User already exists!";
        } else {
            // Get the next available ID
            $next_id_query = "SELECT MAX(id) as max_id FROM users";
            $next_id_result = $conn->query($next_id_query);
            $next_id_row = $next_id_result->fetch_assoc();
            $next_id = ($next_id_row['max_id'] ?? 0) + 1;

            // Insert user into database with the next available ID
            $insert_stmt = $conn->prepare("INSERT INTO users (id, username, email, password, image, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
            $insert_stmt->bind_param("issss", $next_id, $username, $email, $hashed_password, $image);

            try {
                if ($insert_stmt->execute()) {
                    $message[] = "Registration successful!";
                    header('location:/login');
                    exit();
                } else {
                    $message[] = "Registration failed: " . $insert_stmt->error;
                }
            } catch (mysqli_sql_exception $e) {
                $message[] = "Error: " . $e->getMessage();
            }

            $insert_stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - <?=$websiteTitle?></title>
  
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
    <!-- Enhanced ShareThis integration -->
    <script src="<?=$websiteUrl?>/src/assets/js/share-enhanced.js"></script>

    <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/search.css">
    <script src="<?=$websiteUrl?>/src/assets/js/search.js"></script>

</head>
<body data-page="page_register">
    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
    <?php include 'src/component/header.php'; ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" class="layout-page layout-page-404">
            <div class="container">
                <div class="container-404 text-center">
                    <div class="c4-medium">Register Your Account</div>
                    <div class="c4-big-img">
                        <form class="preform" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                                <label class="prelabel" for="re-username">Username</label>
                                <div class="col-sm-6" style="float:none;margin:auto;">
                                    <input type="text" class="form-control" name="name" placeholder="Username"
                                     required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="prelabel" for="email">Email address</label>
                                <div class="col-sm-6" style="float:none;margin:auto;">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="name@email.com" required="">
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="prelabel" for="password">Password</label>
                                <div class="col-sm-6" style="float:none;margin:auto;">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Password" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="prelabel" for="password">Confirm Password</label>
                                <div class="col-sm-6" style="float:none;margin:auto;">
                                    <input type="password" class="form-control" name="cpassword"
                                        placeholder="Password" required="">
                                </div>
                            </div>
                            <div class="mt-4">&nbsp;</div>
                            <div class="form-group login-btn mb-0">
                                <div class="col-sm-6" style="float:none;margin:auto;">
                                    <button id="btn-login" name="submit"
                                        class="btn btn-primary btn-block">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="c4-small">You already have an account? <a href="<?=$websiteUrl?>/login"
                            class="link-highlight register-tab-link" title="Login">Login</a></div>
                    <div class="c4-button">
                        <a href="<?=$websiteUrl?>" class="btn btn-radius btn-focus"><i class="fa fa-chevron-circle-left mr-2"></i>Back
                            to <?=$websiteTitle?></a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php include('src/component/footer.php')?>
        <div id="mask-overlay"></div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js?v=<?=$version?>"></script>
        
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js?v=<?=$version?>"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/src/assets/js/app.js?v=<?=$version?>"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/src/assets/js/comman.js?v=<?=$version?>"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/src/assets/js/movie.js?v=<?=$version?>"></script>
        <link rel="stylesheet" href="<?=$websiteUrl?>/src/assets/css/jquery-ui.css?v=<?=$version?>">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?v=<?=$version?>"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/src/assets/js/function.js?v=<?=$version?>"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js?v=<?=$version?>"></script>
        <?php
if(isset($message)){
   foreach($message as $msg){
      echo '<script type="text/javascript">swal({title: "Error!",text: "'.$msg.'",icon: "warning",button: "Close",})</script>;';
   }
}
      ?>
       
        <div style="display:none;">
        </div>
    </div>
</body>
</html>