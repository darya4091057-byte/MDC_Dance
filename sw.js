const CACHE_NAME = 'mdc-cache-v1';
const urlsToCache = [
  'index.html',
  'styles.html',
  'choreographers.html',
  'booking.html',
  'todo.html',
  'css/style.css',
  'js/main.js'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});
