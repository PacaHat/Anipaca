<?php
// Include the global configuration file
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

// Serve static files directly if they exist
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$requestedFile = $_SERVER['DOCUMENT_ROOT'] . $uri;
if ($uri !== '/' && file_exists($requestedFile) && !is_dir($requestedFile)) {
    return false; // Serve the requested resource as-is.
}

// Get the URI without query strings and leading/trailing slashes
$uri = trim($uri, '/');

// Define routes with regex patterns and associated files
$routes = [
  // Main Pages
  '/^home$/' => 'home.php',
  '/^filter$/' => 'filter.php',
  '/^search$/' => 'search.php',
  '/^az-list(?:\/[a-zA-Z0-9-]+)?$/' => 'src/pages/anime/az-list.php',

  // Anime Pages
  '/^details$/' => 'src/pages/anime/details.php',
  '/^random$/' => 'src/component/anime/random.php', 
  '/^anime$/' => 'src/pages/anime/anime.php',
  '/^details\/([a-zA-Z0-9\-]+)$/' => 'src/pages/anime/details.php',
  '/^anime\/([a-zA-Z0-9\-]+)$/' => 'src/pages/anime/anime.php',
  '/^watch\/([a-zA-Z0-9\-]+)$/' => 'src/pages/anime/watch.php',
  '/^genre\/([a-zA-Z0-9\-]+)$/' => 'src/pages/anime/genre.php',
  '/^producer\/([a-zA-Z0-9\-\.]+)\/?$/' => 'src/pages/anime/producer.php',
  '/^actors\/([a-zA-Z0-9\-]+)$/' => 'src/pages/anime/actors.php',
  '/^character\/([a-zA-Z0-9\-]+)\/?$/' => 'src/pages/anime/character.php',

  // User Pages
  '/^login$/' => 'src/user/login.php',
  '/^register$/' => 'src/user/register.php', 
  '/^logout$/' => 'src/user/logout.php',
  '/^profile$/' => 'src/user/profile.php',
  '/^watchlist$/' => 'src/user/watchlist.php',
  '/^watchlist\.php(?:\?.*)?$/' => 'src/user/watchlist.php',
  '/^changepass$/' => 'src/user/changepass.php',
  '/^continue-watching$/' => 'src/user/continue-watching.php',

  // Extra Pages
  '/^dmca$/' => 'src/pages/extra/dmca.php',
  '/^terms$/' => 'src/pages/extra/terms.php',

  // Sitemap Routes
  '/^sitemaps\/popular\.xml$/' => 'public/sitemap/sitemappopular.xml',
  '/^sitemaps\/movie\.xml$/' => 'public/sitemap/sitemapmovie.xml',
  '/^sitemaps\/airing\.xml$/' => 'public/sitemap/sitemapairing.xml',
  '/^sitemaps\/ongoing-sitemap\.xml$/' => 'public/sitemap/sitemapongoing.xml',
  '/^sitemaps\/allanime-sitemap\.xml$/' => 'public/sitemap/sitemapallanime.xml',
  '/^sitemaps\/sitemap\.xml$/' => 'public/sitemap/sitemap.php',
  '/^sitemap\.xml$/' => 'public/sitemap/sitemap.php',
];

// Route matching
$handled = false;

foreach ($routes as $pattern => $file) {
    if (preg_match($pattern, $uri, $matches)) {
        // Pass captured groups as GET parameters
        if (!empty($matches[1])) {
            $_GET['slug'] = $matches[1];
        }
        include $file;
        $handled = true;
        break;
    }
}

// Fallback to 404 if no route matches
if (!$handled) {
    http_response_code(404);
    include '404.php';
}
?>
