// Define a cache name
const CACHE_NAME = 'anime-site-cache-v1';

// ShareThis domains to bypass
const BYPASS_DOMAINS = [
    'platform-api.sharethis.com',
    'l.sharethis.com',
    'buttons-config.sharethis.com'
];

// List of URLs to cache - updated with existing project files
const urlsToCache = [
    '/index.php',
    '/home.php',
    '/search.php',
    '/src/assets/css/styles.min.css',
    '/src/assets/css/bootstrap.min.css',
    '/src/assets/css/search.css',
    '/src/assets/js/app.min.js',
    '/src/assets/js/search.js',
    '/src/assets/js/function.js',
    '/public/logo/favicon.png',
    '/public/logo/logo.png',
    '/public/logo/favicon.ico'  // Added favicon
];

// Install event - caching the assets with error handling
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Cache opened successfully');
                // Cache files individually to handle failures gracefully
                return Promise.all(
                    urlsToCache.map(url => {
                        return cache.add(url).catch(error => {
                            console.error('Failed to cache:', url, error);
                            // Continue caching other files even if one fails
                            return Promise.resolve();
                        });
                    })
                );
            })
            .catch(error => {
                console.error('Service Worker installation failed:', error);
            })
    );
});

// Fetch event - serving cached content when offline with improved error handling
self.addEventListener('fetch', event => {
    // Check if the request is for ShareThis domains
    const url = new URL(event.request.url);
    if (BYPASS_DOMAINS.some(domain => url.hostname.includes(domain))) {
        // Don't interfere with ShareThis requests
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // Cache hit - return response
                if (response) {
                    return response;
                }

                // Clone the request because it can only be used once
                const fetchRequest = event.request.clone();

                return fetch(fetchRequest).then(response => {
                    // Check if we received a valid response
                    if (!response || response.status !== 200 || response.type !== 'basic') {
                        return response;
                    }

                    // Clone the response because it can only be used once
                    const responseToCache = response.clone();

caches.open(CACHE_NAME)
    .then(cache => {
        // Only cache successful GET responses
        if (event.request.method === 'GET' && response.status === 200) {
            cache.put(event.request, responseToCache);
        }
    });

                    return response;
                }).catch(() => {
                    // Return a custom offline page or fallback content
                    if (event.request.headers.get('accept').includes('text/html')) {
                        return caches.match('/offline.html');
                    }
                    // For other resources, return a simple error response
                    return new Response('Offline content not available');
                });
            })
    );
});

// Activate event - cleaning up old caches
self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});
