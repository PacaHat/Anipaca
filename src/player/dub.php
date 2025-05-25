<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');

$id = $_GET['id'];
$server = $_GET['server'] ?? 'hd-1';
$useProxy = $server !== 'hd-1';
$isIframe = isset($_GET['embed']) && $_GET['embed'] === 'true';
$autoSkip = isset($_GET['skip']) && $_GET['skip'] === 'true';

$categories = ["dub"];
$data = null;

foreach ($categories as $category) {
    $api_url = "$zpi/stream?id=$id&server=$server&type=$category";
    $response = file_get_contents($api_url);
    if ($response !== false) {
        $data = json_decode($response, true);
        if ($data && $data['success'] && isset($data['results']['streamingLink'])) {
            break; // Stop if a successful response is found
        }
    }
}

if (!$data || !$data['success'] || !isset($data['results']['streamingLink'])) {
    die("Error: Unable to fetch episode sources or invalid response structure.");
}

// Process new API response structure
$streamingData = $data['results']['streamingLink'];

// Check if link exists and has file
if (!isset($streamingData['link']['file'])) {
    die("Error: No streaming link found in response.");
}

$m3u8_url = $streamingData['link']['file'];
$video_url = $server === 'HD-3' 
    ? "{$proxy}{$m3u8_url}&headers=%7B%22Referer%22%3A%22https%3A%2F%2Fmegacloud.club%2F%22%7D" 
    : ($useProxy ? $proxy . $m3u8_url : $m3u8_url);
    
// Set default values for intro/outro
$intro_start = $streamingData['intro']['start'] ?? 0;
$intro_end = $streamingData['intro']['end'] ?? 0;
$outro_start = $streamingData['outro']['start'] ?? 0;
$outro_end = $streamingData['outro']['end'] ?? 0;
$thumbnail_url = null;
$subtitles = [];

// Process tracks if they exist
if (isset($streamingData['tracks']) && is_array($streamingData['tracks'])) {
    foreach ($streamingData['tracks'] as $track) {
        if (!isset($track['kind'])) continue;
        
        if ($track['kind'] === 'thumbnails') {
            $thumbnail_url = $track['file'] ?? null;
        } elseif ($track['kind'] === 'captions') {
            $isEnglish = stripos($track['label'] ?? '', 'English') !== false || 
                         stripos($track['label'] ?? '', 'eng') !== false ||
                         (isset($track['default']) && $track['default'] === true);
            $subtitles[] = [
                'label' => $track['label'] ?? 'Unknown',
                'file' => $track['file'] ?? '',
                'default' => $isEnglish
            ];
        }
    }
}

// Rest of your code...

if ($isIframe) {
    ?>
    <div class="artplayer-app"></div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/artplayer.js"></script>
    <script src="js/hls.js"></script>
    <script src="js/artplayer-plugin-chromecast.js"></script>
    <script src="js/artplayer-plugin-dash-control.js"></script>
    <script src="js/artplayer-plugin-hls-control.js"></script>
    <script src="js/artplayer-plugin-chapter.js"></script>
    <link rel="stylesheet" href="css/artplayer.css">
   
    <script>
        const settings = {
            autoSkipIntro: <?= json_encode($autoSkip) ?>,
            autoSkipOutro: <?= json_encode($autoSkip) ?>,
            subtitleFontSize: '24px' // Default font size
        };

        function playM3u8(video, url, art) {
            if (Hls.isSupported()) {
                if (art.hls) art.hls.destroy();
                const hls = new Hls();
                hls.loadSource(url);
                hls.attachMedia(video);
                art.hls = hls;
                art.on('destroy', () => hls.destroy());
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = url;
            } else {
                art.notice.show = 'Unsupported playback format: m3u8';
            }
        }

        const art = new Artplayer({
            container: '.artplayer-app',
            theme: '#ff9a68',
            url: '<?= $video_url ?>',
            type: 'm3u8',
            customType: {
                m3u8: playM3u8,
            },
            icons: {
                play: '<img width="22" height="22" src="icons/play.svg">', 
                pause: '<img width="22" height="22" src="icons/pause.svg">',
                loading: '<img src="icons/loading.svg">',
                state: '<img  src="icons/play.svg">',
                indicator: '<img width="16" height="16" src="icons/indicator.svg">',
                setting: '<img src="icons/settings.svg" width="22" height="22" style="animation: rotate 1s infinite linear;">',
                screenshot: '<img width="22" height="22" src="icons/screenshot.svg">', 
                pip: '<img width="22" height="22" src="icons/pip.svg">',
                fullscreenOn: '<img width="22" height="22" src="icons/fullscreen.svg">',
                fullscreenOff: '<img width="22" height="22" src="icons/fullscreen-off.svg">',
                volume: '<img width="22" height="22" src="icons/volume.svg">',
                volumeClose: '<img width="22" height="22" src="icons/volume-off.svg">',
                
            },
            volume: 2,
            autoplay: true,
            pip: true,
            autoSize: false,
            autoMini: false,
            screenshot: false,
            setting: true,
            playbackRate: true,
            aspectRatio: true,
            fullscreen: true,
            autoOrientation: true,
            fullscreenWeb: false,
            lock: true,
            miniProgressBar: false,
            backdrop: true,
            playsInline: true,
            autoPlayback: true,
            airplay: true,
            screenshot: true,
            theme: '#ff545c',
            lang: navigator.language.toLowerCase(),
            moreVideoAttr: {
                crossOrigin: 'anonymous',
            },
            settings: [
                {
                    width: 200,
                    html: 'Subtitle',
                    tooltip: 'Bilingual',
                    icon: '<img width="22" height="22" src="icons/subtitle.svg">',
                    selector: [
                        {
                            html: 'Display',
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 256 256"><path fill="currentColor" d="M52.44 36a6 6 0 0 0-8.88 8L49 50H32a14 14 0 0 0-14 14v128a14 14 0 0 0 14 14h158.8l12.76 14a6 6 0 0 0 8.88-8.08ZM32 194a2 2 0 0 1-2-2V64a2 2 0 0 1 2-2h27.89l61.82 68H104a6 6 0 0 0 0 12h28.62l18.18 20H56a6 6 0 0 0 0 12h105.71l18.18 20Zm18-58a6 6 0 0 1 6-6h16a6 6 0 0 1 0 12H56a6 6 0 0 1-6-6m188-72v130.83a6 6 0 1 1-12 0V64a2 2 0 0 0-2-2H105.79a6 6 0 0 1 0-12H224a14 14 0 0 1 14 14m-59.48 78a6 6 0 1 1 0-12H200a6 6 0 0 1 0 12Z"/></svg>',
                            tooltip: 'Show',
                            switch: true,
                            onSwitch: function (item) {
                                item.tooltip = item.switch ? 'Hide' : 'Show';
                                art.subtitle.show = !item.switch;
                                return !item.switch;
                            },
                        },
                        <?php foreach ($subtitles as $subtitle): ?> {
                            html: '<?= $subtitle['label'] ?>',
                            url: '<?= $subtitle['file'] ?>',
                            default: <?= $subtitle['default'] ? 'true' : 'false' ?>,
                        },
                        <?php endforeach; ?>
                    ],
                    onSelect: function (item) {
                        art.subtitle.switch(item.url, {
                            name: item.html,
                        });
                        return item.html;
                    },
                },
                {
                    html: 'Font Size',
                    tooltip: 'Size',
                    icon: '<img width="22" height="22" src="icons/font-size.svg">',
                    selector: [
                        { html: '20%', value: '20px' },
                        { html: '40%', value: '24px'},
                        { html: '60%', value: '28px' },
                        { html: '80%', value: '32px', default: true  },
                        { html: '100%', value: '36px' },
                    ],
                    onSelect: function(item) {
                        settings.subtitleFontSize = item.value;
                        art.subtitle.style({
                            fontSize: settings.subtitleFontSize,
                        });
                        return item.html;
                    },
                },
                
            ],
            
            plugins: [

                artplayerPluginHlsControl({
                    quality: {
                        control: false,
                        setting: true,
                        icon: '<img width="22" height="22" src="icons/quality.svg">',
                        title: 'Quality',
                        auto: 'Auto',
                        
                    },
                }),
               
                artplayerPluginChapter({
                    chapters: [
                        <?php if ($intro_start > 0 && $intro_end > 0): ?>
                        {
                            start: <?= $intro_start ?>,
                            end: <?= $intro_end ?>,
                            title: 'Intro',
                            color: '#fdd253', // Changed color to match the new style
                            style: {
                                transform: 'scaleY(0.6)', // Added transform style
                            },
                        },
                        <?php endif; ?>
                        <?php if ($outro_start > 0 && $outro_end > 0): ?>
                        {
                            start: <?= $outro_start ?>,
                            end: <?= $outro_end ?>,
                            title: 'Outro',
                            color: 'red',
                        },
                        <?php endif; ?>
                    ],
                }),

                artplayerPluginChromecast({
                    media: {
                        type: 'application/x-mpegURL',
                        title: 'HLS Stream',
                        
                        src: '<?= $proxy . $m3u8_url ?>'
                    }
                }),
               
            ],
            layers: [
                {
            name: 'poster',
            html: `<img style="width: 35px" src="https://hianimez.to/images/share-icon.gif">`,
            tooltip: 'Poster Tip',
            style: {
                position: 'absolute',
                top: '20px',
                left: '18px',
            },
            click: function (...args) {
                console.info('click', args);
            },
            mounted: function (...args) {
                console.info('mounted', args);
            },
        },
            ],
            subtitle: {
                url: '<?= isset($subtitles[0]) ? $subtitles[0]['file'] : '' ?>',
                type: 'srt',
                encoding: 'utf-8',
                escape: false,
                style: {
                    fontSize: settings.subtitleFontSize,
                },
            },
        });


        

        const fastForwardLayer = art.layers.add({
            html: '<img width="22" height="22" src="icons/forward.svg">',
            style: {
                position: 'absolute', 
                top: '49%', 
                left: '75%', 
                transform: 'translate(-50%, -50%)',
                background: '#00000000', 
                padding: '5px 10px',   
                cursor: 'pointer',
                display: 'none',
                fontSize: '1.15rem' 
            },
            click: function() {
                art.currentTime += 10; 
            }
        });

        const skipIntroLayer = art.layers.add({
            html: 'Skip intro',
            style: {
                position: 'absolute',
                border: '2px solid #fff',
                bottom: '85px', 
                right: '10px', 
                background: '#00000000', 
                color: '#fff', 
                padding: '5px 10px', 
                borderRadius: '5px', 
                cursor: 'pointer',
                display: 'none',
                fontSize: '1.15rem' // Initially hidden
            },
            click: function() {
                art.currentTime = <?= $intro_end ?>; // Skip to the end of the intro
            }
        });

        const skipOutroLayer = art.layers.add({
            html: 'Skip outro',
            style: {
                position: 'absolute',
                border: '1px solid #fdd253',
                bottom: '85px', 
                right: '10px', 
                background: '#00000000', 
                color: '#fdd253', 
                padding: '5px 10px', 
                borderRadius: '5px', 
                cursor: 'pointer',
                display: 'none',
                fontSize: '1.15rem' 
            },
            click: function() {
                art.currentTime = <?= $outro_end ?>; 
            }
        });

        art.on('video:timeupdate', () => {
            const currentTime = art.currentTime;
            const skipElement = art.controls['skip'];
            if (skipElement) {
                if ((currentTime >= <?= $intro_start ?> && currentTime < <?= $intro_end ?>) ||
                    (currentTime >= <?= $outro_start ?> && currentTime < <?= $outro_end ?>)) {
                    skipElement.style.display = 'block';
                    if (settings.autoSkipIntro && currentTime < <?= $intro_end ?>) {
                        art.currentTime = <?= $intro_end ?>; // Skip to the end of the intro
                    } else if (settings.autoSkipOutro && currentTime >= <?= $outro_start ?>) {
                        art.currentTime = <?= $outro_end ?>; // Skip to the end of the outro
                    }
                } else {
                    skipElement.style.display = 'none';
                }
            }
        });

        art.controls.add({
            name: 'fast-forward',
            index: 10,
            position: 'right', 
            html: '<img width="22" height="22" src="icons/forward.svg">', 
            tooltip: 'Fast Forward 10 seconds',
            style: {
                color: 'red',
               
            },
            click: function() {
                art.currentTime += 10;
            },
            mounted: function(...args) {
                console.info('mounted', args);
            },
        });
        art.controls.add({
            name: 'rewind',
              index: 10,
               position: 'right',
              html: '<img width="22" height="22" src="icons/rewind.svg">',
              tooltip: 'Rewind 10 seconds',
              style: {
                  color: 'red',
                  
              },
            click: function() {
                art.currentTime -= 10; // Rewind 10 seconds
            },
            mounted: function(...args) {
                console.info('mounted', args);
            },
        });

        art.on('ready', () => {
    art.notice.show = 'Thanks for waiting';
})

art.on('ready', () => {
    const defaultSubtitle = <?= json_encode($subtitles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>.find(s => s.default);
    if (defaultSubtitle) {
        art.subtitle.url = defaultSubtitle.file;
    }
    art.subtitle.html = true;
    art.subtitle.escape = false;
});
        
        art.on('video:timeupdate', () => {
            const currentTime = art.currentTime;
            if (currentTime >= <?= $intro_start ?> && currentTime < <?= $intro_end ?>) {
                skipIntroLayer.style.display = 'block'; // Show the skip button during intro
                skipOutroLayer.style.display = 'none'; // Hide the outro skip button
                if (settings.autoSkipIntro) {
                    art.currentTime = <?= $intro_end ?>;
                }
            } else if (currentTime >= <?= $outro_start ?> && currentTime < <?= $outro_end ?>) {
                skipOutroLayer.style.display = 'block'; // Show the skip button during outro
                skipIntroLayer.style.display = 'none'; // Hide the intro skip button
                if (settings.autoSkipOutro) {
                    art.currentTime = <?= $outro_end ?>;
                }
            } else {
                skipIntroLayer.style.display = 'none'; // Hide the intro skip button otherwise
                skipOutroLayer.style.display = 'none'; // Hide the outro skip button otherwise
            }
        });


       

      
        // Add click event for subtitle selection
        art.on('subtitle:change', (item) => {
            console.log('Subtitle changed to:', item.html);
        });
      
        art.on('dblclick', (event) => {
    const rect = art.template.$player.getBoundingClientRect();
    const clickX = event.clientX;

    if (clickX > rect.width / 2) {
       
        art.currentTime = Math.min(art.currentTime + 10, art.duration);
    } else {
       
        art.currentTime = Math.max(art.currentTime - 10, 0);
    }

    console.info('dblclick', event, 'Current Time:', art.currentTime);
});


        art.on('ready', () => {
    const defaultSubtitle = <?= json_encode($subtitles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>.find(s => s.default);
    art.subtitle.url = defaultSubtitle ? defaultSubtitle.file : '';
    art.subtitle.html = true; // Ensure HTML rendering is enabled
    art.subtitle.escape = false; // Disable escaping for subtitle rendering
   
});


art.on("resize", () => {
      art.subtitle.style({
        fontSize:
          (art.width > 500 ? art.width * 0.02 : art.width * 0.03) + "px",
      });
    });
        


       
    </script>
    <?php
    exit;
}

?>
