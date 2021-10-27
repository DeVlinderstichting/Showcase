const staticShowcase = "Showcase_20211027120000";

//also load font awesome css!!
const assets = [
    "/",
    "/index.html",
    "/manifest.json",
    "/css/fonts/Mulish-Bold.ttf",
    "/css/fonts/Mulish-Light.ttf",
    "/css/fonts/Mulish-Regular.ttf",
    "/css/fonts/Oswald-Medium.ttf",
    "/css/fonts/Oswald-Regular.ttf",
    "/css/all.min.css",
    "/css/app.css",
    "/css/bootstrap.min.css.map",
    "/css/feature.css",
    "/css/font-icons.min.css", 
    "/css/jquery.dataTables.min.css", 
    "/css/login.css", 
    "/css/responsive.css",
    "/css/select2.css",
    "/css/select2.min.css",
    "/css/simple-style.css",
    "/css/style.css",
    "/css/theme-vendors.min.css", 
    "/img/favicon.png",
    "/img/favicon72.png",
    "/img/favicon96.png",
    "/img/favicon128.png",
    "/img/favicon144.png",
    "/img/favicon152.png",
    "/img/favicon192.png",
    "/img/favicon384.png",
    "/img/favicon512.png",
    "/js/app.js",
    "/js/bootstrap.js",
    "/js/jquery.min.js",
    "/js/location.min.js",
    "/js/main.min.js",
    "/js/pageLogic.min.js",
    "/js/pageLogic.js",
    "/js/render.js",
    "/js/select2.js",
    "/js/storage.js",
    "/js/theme-vendors.min.js",
    "/js/retina.min.js.map",
    "/js/swiper-bundle.min.js.map",
    "/js/tilt.jquery.js.map"
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
            return res || fetch(fetchEvent.request).then((response) => {
                return caches.open(staticShowcase).then((cache) => {
                  cache.put(fetchEvent.request, response.clone());
                  return response;
                });
            });
          })
        );
      });