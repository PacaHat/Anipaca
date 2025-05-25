// Load qTip2 library dynamically
(function() {
    // Load qTip2 CSS
    var cssLink = document.createElement('link');
    cssLink.rel = 'stylesheet';
    cssLink.href = 'https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.css';
    document.head.appendChild(cssLink);

    // Load qTip2 JS
    var script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/jquery.qtip.min.js';
    script.onload = initQtip;
    document.head.appendChild(script);
})();

function initQtip() {
    $(document).ready(function() {
        // Initialize qtip for anime items
        $('.item-qtip').each(function() {
            var element = $(this);
            var animeId = element.data('id');
            
            // Initialize qTip2
            element.qtip({
                content: {
                    text: function(event, api) {
                        // Fetch anime data using AJAX
                        $.ajax({
                            url: '/src/component/anime/qtip.php',
                            type: 'GET',
                            data: { id: animeId },
                            success: function(response) {
                                try {
                                    var data = JSON.parse(response);
                                    // Create tooltip content
                                    var content = `
                                        <div class="qtip-anime">
                                            <div class="qtip-header">
                                                <h3>${data.title || data.japanese}</h3>
                                                ${data.malscore ? `<div class="score">MAL: ${data.malscore}</div>` : ''}
                                            </div>
                                            <div class="qtip-body">
                                                <div class="info">
                                                    ${data.showType ? `<div>Type: ${data.showType}</div>` : ''}
                                                    ${data.status ? `<div>Status: ${data.status}</div>` : ''}
                                                    ${data.duration ? `<div>Duration: ${data.duration}</div>` : ''}
                                                    ${data.genres ? `<div>Genres: ${data.genres.join(', ')}</div>` : ''}
                                                </div>
                                                <div class="overview">${data.overview || 'No description available.'}</div>
                                            </div>
                                        </div>
                                    `;
                                    api.set('content.text', content);
                                } catch (e) {
                                    console.error('Error parsing anime data:', e);
                                    api.set('content.text', 'Error loading anime information');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX error:', error);
                                api.set('content.text', 'Error loading anime information');
                            }
                        });
                        return 'Loading...';
                    }
                },
                position: {
                    viewport: $(window),
                    my: 'left center',
                    at: 'right center',
                    adjust: {
                        method: 'flip shift'
                    }
                },
                style: {
                    classes: 'qtip-dark qtip-rounded qtip-shadow',
                    tip: {
                        corner: true
                    }
                },
                show: {
                    event: 'mouseenter',
                    solo: true,
                    effect: function(offset) {
                        $(this).fadeIn(200);
                    }
                },
                hide: {
                    fixed: true,
                    delay: 300,
                    effect: function(offset) {
                        $(this).fadeOut(200);
                    }
                }
            });
        });
    });
}

// Add custom styles for anime tooltips
const style = document.createElement('style');
style.textContent = `
    .qtip-anime {
        max-width: 300px;
        font-family: Arial, sans-serif;
    }
    .qtip-anime .qtip-header {
        padding: 8px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .qtip-anime .qtip-header h3 {
        margin: 0;
        font-size: 14px;
        color: #fff;
    }
    .qtip-anime .qtip-header .score {
        font-size: 12px;
        color: #ffd700;
        margin-top: 4px;
    }
    .qtip-anime .qtip-body {
        padding: 8px;
    }
    .qtip-anime .info {
        font-size: 12px;
        color: #ccc;
        margin-bottom: 8px;
    }
    .qtip-anime .overview {
        font-size: 12px;
        color: #fff;
        line-height: 1.4;
    }
`;
document.head.appendChild(style);
