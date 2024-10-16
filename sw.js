// On install - caching the application shell
self.addEventListener('install', function(event) {
    event.waitUntil(
      caches.open('sw-cache').then(function(cache) {
        // cache any static files that make up the application shell
        return cache.add('http://localhost/anikatsu/files/css/style.css');
      })
    );
  });
  
  // On network request
  self.addEventListener('fetch', function(event) {
    event.respondWith(
      // Try the cache
      caches.match(event.request).then(function(response) {
        //If response found return it, else fetch again
        return response || fetch(event.request);
      })
    );
  });