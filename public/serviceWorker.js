const staticShowcase = "Showcase";
const assets = [
    "/",
    "/index.html",
    "/css/style.css",
    "/js/app.js",
    "/images/bf1.jpg",
    "/images/bf2.jpg",
    "/images/bf3.jpg",
    "/images/bf4.jpg",
    "/images/bf5.jpg",
    "/images/bf6.jpg",
];

self.addEventListener("install", installEvent => 
{
    installEvent.waitUntil(
        caches.open(staticShowcase).then(cache => 
        {
            cache.addAll(assets)
        })
    );
});
self.addEventListener("fetch", fetchEvent => 
{
    fetchEvent.respondWith(
        caches.match(fetchEvent.request).then(res => 
        {
            return res || fetch(fetchEvent.request)
        })
    );
});
