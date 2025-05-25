// Enhanced ShareThis integration with better error handling
(function() {
    // ShareThis initialization with error handling
    function initShareThis() {
        return new Promise((resolve, reject) => {
            if (window.sharethisInitialized) {
                resolve();
                return;
            }

            const script = document.createElement('script');
            script.src = 'https://platform-api.sharethis.com/js/sharethis.js';
            script.async = true;

            // Set timeout to detect if ShareThis is blocked
            const timeout = setTimeout(() => {
                reject(new Error('ShareThis load timeout'));
            }, 5000);

            script.onload = () => {
                clearTimeout(timeout);
                window.sharethisInitialized = true;
                resolve();
            };

            script.onerror = () => {
                clearTimeout(timeout);
                reject(new Error('ShareThis failed to load'));
            };

            // Configure ShareThis
            window.__sharethis__ = {
                property: '67521dcc10699f0019237fbb',
                product: 'inline-share-buttons',
                source: 'platform',
                load: function(callback) {
                    if (callback) callback();
                }
            };

            document.body.appendChild(script);
        });
    }

    // Enhanced fallback mechanism
    function initFallback(error) {
        console.log('ShareThis fallback activated:', error?.message || 'Unknown error');
        
        // Remove any existing ShareThis elements
        const existingButtons = document.querySelectorAll('.st-btn');
        existingButtons.forEach(btn => btn.remove());

        // Initialize fallback buttons
        const containers = document.querySelectorAll('.sharethis-inline-share-buttons');
        containers.forEach(container => {
            // Clear existing content
            container.innerHTML = '';
            
            const url = window.location.href;
            const title = document.title;
            const description = document.querySelector('meta[name="description"]')?.content || '';

            // Create modern sharing buttons
            const networks = [
                {
                    name: 'Facebook',
                    icon: '<i class="fab fa-facebook-f"></i>',
                    url: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`
                },
                {
                    name: 'Twitter',
                    icon: '<i class="fab fa-twitter"></i>',
                    url: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`
                },
                {
                    name: 'WhatsApp',
                    icon: '<i class="fab fa-whatsapp"></i>',
                    url: `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`
                },
                {
                    name: 'Copy',
                    icon: '<i class="fas fa-copy"></i>',
                    action: () => {
                        navigator.clipboard.writeText(url).then(() => {
                            const tooltip = document.createElement('div');
                            tooltip.className = 'copy-tooltip';
                            tooltip.textContent = 'Link copied!';
                            document.body.appendChild(tooltip);
                            setTimeout(() => tooltip.remove(), 2000);
                        });
                    }
                }
            ];

            const buttonsContainer = document.createElement('div');
            buttonsContainer.className = 'fallback-share-buttons';
            
            networks.forEach(network => {
                const button = document.createElement(network.action ? 'button' : 'a');
                if (!network.action) {
                    button.href = network.url;
                    button.target = '_blank';
                    button.rel = 'noopener noreferrer';
                } else {
                    button.onclick = network.action;
                }
                
                button.className = `fallback-share-button fallback-share-${network.name.toLowerCase()}`;
                button.innerHTML = `${network.icon} <span>${network.name}</span>`;
                buttonsContainer.appendChild(button);
            });

            container.appendChild(buttonsContainer);
        });

        // Add enhanced styles
        if (!document.getElementById('fallback-share-styles')) {
            const style = document.createElement('style');
            style.id = 'fallback-share-styles';
            style.textContent = `
                .fallback-share-buttons {
                    display: flex;
                    gap: 12px;
                    margin: 10px 0;
                    flex-wrap: wrap;
                }
                .fallback-share-button {
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    padding: 8px 16px;
                    border: none;
                    border-radius: 4px;
                    color: white;
                    cursor: pointer;
                    text-decoration: none;
                    font-size: 14px;
                    transition: opacity 0.2s;
                    background: #2d2d2d;
                }
                .fallback-share-button:hover {
                    opacity: 0.9;
                    color: white;
                    text-decoration: none;
                }
                .fallback-share-facebook { background: #1877f2; }
                .fallback-share-twitter { background: #1da1f2; }
                .fallback-share-whatsapp { background: #25d366; }
                .fallback-share-copy { background: #6c757d; }
                .copy-tooltip {
                    position: fixed;
                    bottom: 20px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: rgba(0,0,0,0.8);
                    color: white;
                    padding: 8px 16px;
                    border-radius: 4px;
                    z-index: 9999;
                    animation: fadeInOut 2s ease-in-out;
                }
                @keyframes fadeInOut {
                    0% { opacity: 0; }
                    15% { opacity: 1; }
                    85% { opacity: 1; }
                    100% { opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // Initialize sharing functionality
    function init() {
        initShareThis()
            .catch(error => {
                initFallback(error);
            });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
