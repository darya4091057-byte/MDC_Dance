const CACHE_NAME = 'mdc-cache-v1';
const urlsToCache = [
  '/mdc-dancing/',
  '/mdc-dancing/index.html',
  '/mdc-dancing/styles.html',
  '/mdc-dancing/choreographers.html',
  '/mdc-dancing/booking.html',
  '/mdc-dancing/todo.html',
  '/mdc-dancing/css/style.css',
  '/mdc-dancing/js/main.js'
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