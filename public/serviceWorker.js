const staticShowcase = "Showcase_2023-01-20" ;// + new Date().getFullYear() + "-" + new Date().getMonth() + "-" + new Date().getDate();//2022-10-11";

//also load font awesome css!!
const assets = [
    "/images/logo.jpg",
    "/images/bgloginv2.png",
    "/images/logo.png",
    "/js/storage.js",
    "/js/pageLogic.js",
    "/js/app.js",
    "/js/swiper-bundle.min.js.map",
    "/js/theme-vendors.min.js",
    "/js/location.js",
    "/js/select2.min.js",
    "/js/retina.min.js.map",
    "/js/bootstrap.js",
    "/js/bootstrap.bundle.min.js.map",
    "/js/tilt.jquery.js.map",
    "/js/jquery.min.js",
    "/js/jquery.dataTables.min.js",
    "/js/render.js",
    "/js/main.js",
    "/js/chart.min.js",
    "/manifest.json",
    "/index.html",
    "/img/butterflies.png",
    "/img/moths.png",
    "/img/bumblebees.png",
    "/img/solitarybees.png",
    "/img/honeybees.png",
    "/img/hoverflies.png",
    "/img/flies.png",
    "/img/beetles.png",
    "/img/bugs.png",
    "/img/wasps.png",
    "/img/favicon.png",
    "/img/favicon_192.png",
    "/img/15-count-bg.svg",
    "/img/logo_Showcase_335x72.png",
    "/img/favicon_72.png",
    "/img/background_1920x1080.png",
    "/img/background_1920x1080_screen-01.png",
    "/img/favicon_384.png",
    "/img/transect-bg.svg",
    "/img/favicon_144.png",
    "/img/favicon_128.png",
    "/img/background_1920x1080_v2.png",
    "/img/logo_Showcase_169x36.png",
    "/img/favicon_96.png",
    "/img/flower-count-bg.svg",
    "/img/special-bg.svg",
    "/img/favicon_152.png",
    "/img/favicon_512.png",
    "/css/select2.css",
    "/css/bootstrap.min.css.map",
    "/css/jquery.dataTables.min.css",
    "/css/font-icons.min.css",
    "/css/simple-style.css",
    "/css/select2.min.css",
    "/css/all.min.css",
    "/css/responsive.css",
    "/css/app.css",
    "/css/theme-vendors.min.css",
    "/css/style.css",
    "/css/feature.css",
    "/css/login.css",
    "/css/fonts/Mulish-Light.ttf",
    "/css/fonts/Oswald-Regular.ttf",
    "/css/fonts/Mulish-Regular.ttf",
    "/css/fonts/Mulish-Bold.ttf",
    "/css/fonts/Oswald-Medium.ttf",
    "/fonts/fa-brands-400.eot",
    "/fonts/fa-solid-900.eot",
    "/fonts/Simple-Line-Icons.ttf",
    "/fonts/icomoon.ttf",
    "/fonts/icomoon.woff",
    "/fonts/fa-regular-400.woff",
    "/fonts/Simple-Line-Icons.woff",
    "/fonts/fa-brands-400.woff",
    "/fonts/Simple-Line-Icons.woff2",
    "/fonts/icomoon.svg",
    "/fonts/themify.woff",
    "/fonts/stopwatch.svg",
    "/fonts/feather.eot",
    "/fonts/icomoon-solid.svg",
    "/fonts/fa-brands-400.ttf",
    "/fonts/fa-solid-900.ttf",
    "/fonts/fa-solid-900.woff",
    "/fonts/icomoon-solid.eot",
    "/fonts/feather.svg",
    "/fonts/fa-solid-900.woff2",
    "/fonts/map-marker-alt.svg",
    "/fonts/fa-solid-900.svg",
    "/fonts/Simple-Line-Icons.svg",
    "/fonts/et-line.woff",
    "/fonts/et-line.eot",
    "/fonts/fa-regular-400.woff2",
    "/fonts/Simple-Line-Icons.eot",
    "/fonts/bug.svg",
    "/fonts/fa-brands-400.svg",
    "/fonts/et-line.svg",
    "/fonts/themify.eot",
    "/fonts/icomoon-solid.woff",
    "/fonts/icomoon-solid.ttf",
    "/fonts/icomoon.eot",
    "/fonts/fa-regular-400.ttf",
    "/fonts/themify.svg",
    "/fonts/fa-brands-400.woff2",
    "/fonts/feather.ttf",
    "/fonts/et-line.ttf",
    "/fonts/feather.woff",
    "/fonts/fa-regular-400.eot",
    "/fonts/fa-regular-400.svg",
    "/fonts/themify.ttf"
];

self.addEventListener("install", installEvent => 
{
    self.skipWaiting();
    installEvent.waitUntil(
        caches.open(staticShowcase).then(cache => 
        {
            cache.addAll(assets)
        })
    );
});
self.addEventListener("fetch", fetchEvent => 
{
    fetchEvent.respondWith((async()=>
    {
        const cachedResponse = await caches.match(fetchEvent.request);
      //  console.log(fetchEvent.request.url);
        if ((1==1) && (cachedResponse))
        {
       //     console.log("response from cache");
            return cachedResponse;
        }
     //   console.log("response from fetch");
        const response = await fetch(fetchEvent.request);
        return response;
    })());
    
    /*var theRes = "";
        if (fetchEvent.request.url.includes('index.html'))
        {
            console.log("I am part of the app");
            caches.match(fetchEvent.request).then(res => 
            {
                if (res)
                {
                    theRes = res;
                }
                else 
                {
                    theRes = fetch(fetchEvent.request).then((response) => 
                    {
                        return caches.open(staticShowcase).then((cache) => 
                        {
                            cache.put(fetchEvent.request, response.clone());
                            return response;
                        });
                    });
                }
            });
        }
        else 
        {
            console.log("I am not part of the app");

            await fetch(fetchEvent.request).then((response) => 
            {
                theRes = response;
            });
        }
    fetchEvent.respondWith(theRes);
    */
/*
    fetchEvent.respondWith(
        caches.match(fetchEvent.request).then(res => 
        {


            console.log("loading from cache");
            console.log(fetchEvent.request);
            var doFetch = false;
            if (res)
            {   
              /*  var res = staticShowcase.split('_');
                var theDate = res[1];
                var theLastDate = Date.parse(theDate);
                var theNowDate = new Date();
                var difference = theNowDate.getTime() - theLastDate.getTime();
                var diffDays = difference / (1000 * 3600 * 24);
                if (diffDays > 7)
                {
                    doFetch = true;
                }
                */ /*
                doFetch = true;
            }
            else 
            {
                doFetch = true;
            }
            if (doFetch)
            {
              //  caches.delete(staticShowcase).then(
               // {
                    fetch(fetchEvent.request).then((response) => 
                    {
                        return caches.open(staticShowcase).then((cache) => 
                        {
                            cache.put(fetchEvent.request, response.clone());
                            return response;
                        });
                    });
               // });
            }
            else 
            {
                return res;
            }
        })
    ); */
});

const deleteCache = async (key) => 
{
    await caches.delete(key);
};

const deleteOldCaches = async () => 
{
    const cacheKeepList = [staticShowcase];
    const keyList = await caches.keys();
    const cachesToDelete = keyList.filter((key) => !cacheKeepList.includes(key));
    await Promise.all(cachesToDelete.map(deleteCache));
};

self.addEventListener("activate", (event) => 
{
    event.waitUntil(deleteOldCaches());
});


/*

//working yet very sticky 

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

*/