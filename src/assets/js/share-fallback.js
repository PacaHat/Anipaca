// ShareThis fallback mechanism
(function() {
    // Check if ShareThis is blocked
    function isShareThisBlocked() {
        return !window.__sharethis__;
    }

    // Create fallback sharing buttons
    function createFallbackButtons(container, url, title) {
        // First try Web Share API
        if (navigator.share) {
            const shareButton = document.createElement('button');
            shareButton.className = 'fallback-share-button';
            shareButton.textContent = 'Share';
            shareButton.onclick = () => {
                navigator.share({
                    title: title,
                    url: url
                }).catch(console.error);
            };
            container.appendChild(shareButton);
            return;
        }

        // Fallback to direct share links
        const networks = [
            {
                name: 'Facebook',
                url: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`
            },
            {
                name: 'Twitter',
                url: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`
            },
            {
                name: 'WhatsApp',
                url: `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`
            }
        ];

        const buttonsContainer = document.createElement('div');
        buttonsContainer.className = 'fallback-share-buttons';
        
        networks.forEach(network => {
            const button = document.createElement('a');
            button.href = network.url;
            button.className = `fallback-share-button fallback-share-${network.name.toLowerCase()}`;
            button.textContent = `Share on ${network.name}`;
            button.target = '_blank';
            button.rel = 'noopener noreferrer';
            buttonsContainer.appendChild(button);
        });

        container.appendChild(buttonsContainer);
    }

    // Initialize fallback
    function initFallback() {
        if (isShareThisBlocked()) {
            console.log('ShareThis appears to be blocked, initializing fallback...');
            const containers = document.querySelectorAll('.sharethis-inline-share-buttons');
            containers.forEach(container => {
                const url = window.location.href;
                const title = document.title;
                createFallbackButtons(container, url, title);
            });

            // Add fallback styles
            const style = document.createElement('style');
            style.textContent = `
                .fallback-share-buttons {
                    display: flex;
                    gap: 10px;
                    margin: 10px 0;
                }
                .fallback-share-button {
                    padding: 8px 16px;
                    border: none;
                    border-radius: 4px;
                    color: white;
                    cursor: pointer;
                    text-decoration: none;
                    font-size: 14px;
                }
                .fallback-share-facebook {
                    background-color: #3b5998;
                }
                .fallback-share-twitter {
                    background-color: #1da1f2;
                }
                .fallback-share-whatsapp {
                    background-color: #25d366;
                }
            `;
            document.head.appendChild(style);
        }
    }

    // Check after a delay to allow ShareThis to load
    setTimeout(initFallback, 2000);
})();
