<?php
require('../_config.php');

$id = $_GET['id'];

$json = file_get_contents("$api/vidcdn/watch/$id");
$video = json_decode($json, true);

$json1 = file_get_contents("$api/getEpisode/$id");
$anime = json_decode($json1, true);

if (isset($video['sources']) && !empty($video['sources'])) {
    $highest_quality_index = count($video['sources']) - 1;
    $m3u8_url = $video['sources'][$highest_quality_index]['file'];
    // Adding the proxy before fetching m3u
} else {
    echo "Error: M3U8 URL not found in API response";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta name="robots" content="noindex, nofollow" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>


    <style>

    .btn-primary:hover,
    .btn-tab.active:hover {
        background: #53FF86 !important;
        border-color: #53FF86 !important
    }
    .wrap #player {
        position: absolute;
        height: 100% !important;
        width: 100% !important;
    }

    .wrap .btn {
        position: absolute;
        top: 15%;
        left: 90%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        background-color: #53FF86; /* Changed to theme green */
        color: #201f31; /* Changed to dark background color for contrast */
        font-size: 12px;
        padding: 6px 12px;
        border: 1px solid #53FF86; /* Matching border */
        cursor: pointer;
        border-radius: 5px;
        transition: all 0.3s ease; /* Smooth transition for hover */
    }

    .wrap .btn:hover {
        background-color: #201f31;
        color: #53FF86;
        border-color: #53FF86;
    }

    @media screen and (max-width:600px) and (orientation: landscape) {
        .wrap .btn {
            font-size: 08px;
        }
    }
    </style>
    <div class="wrap">

        <div id="player"></div>
        <div id="skipIntro"></div>

    </div>




    <script src='jw.js'></script>
    <script>
  
        const playerInstance = jwplayer("player").setup({
        controls: true,
        displaytitle: true,
        displaydescription: true,
        abouttext: "Anipaca",
        aboutlink: "//anipaca.fun",
        autostart: true, 
        skin: {
            controlbar: {
                background: "rgba(32,31,49,0.8)", // Using your dark background with opacity
                icons: "rgba(255,255,255,0.8)",
                iconsActive: "#53FF86", // Using your theme green for active icons
                text: "#FFFFFF"
            },
            menus: {
                background: "#201f31", // Your dark background
                text: "rgba(255,255,255,0.8)",
                textActive: "#53FF86" // Theme green for active text
            },
            timeslider: {
                progress: "#53FF86", // Theme green for progress bar
                rail: "rgba(255,255,255,0.3)"
            },
            tooltips: {
                background: "#201f31", // Dark background for tooltips
                text: "#FFFFFF"
            }
        },
        
        logo: {
            file: "https://i.postimg.cc/fT1SkFgk/20241123-004354.png",
            link: "<?=$websiteUrl?>",
            width: 10, // Changed from 20 to 10
            height: 10, // Changed from 20 to 10
            position: "top-left", // Moved the logo to top left
            hide: true // Hide the logo with player controls
        },

        playlist: [{
            title: "<?= $anime['title'] ?>",
            description: "<?= $anime['description'] ?>",
            image: "<?= $anime['image'] ?>",
             sources: [{"file": `https://proxy-pink-three.vercel.app/cors?url=<?php echo $m3u8_url; ?>`}],
        }],
        advertising: {
            client: "vast",
            schedule: [{
                offset: "pre",
                tag: ""
            }]
        }
    })

    
    
    playerInstance.on("ready", function() {
        


        // Move the timeslider in-line with other controls
       function _0x4f2a(){const _0xfa02f3=['insertBefore','Backward\x2010\x20Seconds','transform','5625728xhvJDv','676207iRnOYL','none','getContainer','nextElementSibling','forEach','.jw-spacer','6VEpRzT','2190088RRBjkd','9JxBILB','3030461FPaPlN','display','.jw-button-container','ariaLabel','seek','2991576pDJDBo','4516835sGtOCF','2piCEpC','getPosition','replaceChild','714032PzqJKY','Forward\x2010\x20Seconds','querySelector','.jw-display-icon-next','.jw-icon-rewind','scaleX(-1)','.jw-display-icon-rewind','100uIMjWu','parentNode','style'];_0x4f2a=function(){return _0xfa02f3;};return _0x4f2a();}const _0x3bbac1=_0x4544;(function(_0xc446d7,_0x24dc21){const _0x32891b=_0x4544,_0x1c51b3=_0xc446d7();while(!![]){try{const _0x1c92a8=-parseInt(_0x32891b(0x111))/0x1*(-parseInt(_0x32891b(0x100))/0x2)+parseInt(_0x32891b(0x11f))/0x3+parseInt(_0x32891b(0x118))/0x4+parseInt(_0x32891b(0xff))/0x5*(-parseInt(_0x32891b(0x117))/0x6)+-parseInt(_0x32891b(0x11a))/0x7+-parseInt(_0x32891b(0x110))/0x8*(parseInt(_0x32891b(0x119))/0x9)+parseInt(_0x32891b(0x10a))/0xa*(parseInt(_0x32891b(0x103))/0xb);if(_0x1c92a8===_0x24dc21)break;else _0x1c51b3['push'](_0x1c51b3['shift']());}catch(_0x702cd1){_0x1c51b3['push'](_0x1c51b3['shift']());}}}(_0x4f2a,0xcac47));function _0x4544(_0x5017e7,_0x1e2523){const _0x4f2a22=_0x4f2a();return _0x4544=function(_0x454450,_0x118037){_0x454450=_0x454450-0xff;let _0x207852=_0x4f2a22[_0x454450];return _0x207852;},_0x4544(_0x5017e7,_0x1e2523);}const playerContainer=playerInstance[_0x3bbac1(0x113)](),buttonContainer=playerContainer[_0x3bbac1(0x105)](_0x3bbac1(0x11c)),spacer=buttonContainer[_0x3bbac1(0x105)](_0x3bbac1(0x116)),timeSlider=playerContainer['querySelector']('.jw-slider-time');buttonContainer[_0x3bbac1(0x102)](timeSlider,spacer);const player=playerInstance,rewindContainer=playerContainer[_0x3bbac1(0x105)](_0x3bbac1(0x109)),forwardContainer=rewindContainer['cloneNode'](!![]),forwardDisplayButton=forwardContainer['querySelector'](_0x3bbac1(0x107));forwardDisplayButton[_0x3bbac1(0x10c)]['transform']='scaleX(-1)',forwardDisplayButton[_0x3bbac1(0x11d)]=_0x3bbac1(0x104);const nextContainer=playerContainer[_0x3bbac1(0x105)](_0x3bbac1(0x106));nextContainer['parentNode'][_0x3bbac1(0x10d)](forwardContainer,nextContainer),playerContainer[_0x3bbac1(0x105)](_0x3bbac1(0x106))[_0x3bbac1(0x10c)][_0x3bbac1(0x11b)]=_0x3bbac1(0x112);const rewindControlBarButton=buttonContainer[_0x3bbac1(0x105)](_0x3bbac1(0x107));rewindControlBarButton[_0x3bbac1(0x11d)]=_0x3bbac1(0x10e);const forwardControlBarButton=rewindControlBarButton['cloneNode'](!![]);forwardControlBarButton[_0x3bbac1(0x10c)][_0x3bbac1(0x10f)]=_0x3bbac1(0x108),forwardControlBarButton['ariaLabel']=_0x3bbac1(0x104),rewindControlBarButton[_0x3bbac1(0x10b)]['insertBefore'](forwardControlBarButton,rewindControlBarButton[_0x3bbac1(0x114)]),[forwardDisplayButton,forwardControlBarButton][_0x3bbac1(0x115)](_0x57fe75=>{_0x57fe75['onclick']=()=>{const _0x364d9b=_0x4544;player[_0x364d9b(0x11e)](player[_0x364d9b(0x101)]()+0xa);};});
        // New Features
    
    });
   
   
    
     </script>


</body>

</html>

