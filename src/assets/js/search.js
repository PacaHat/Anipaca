document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.search-input');
    const searchSuggest = document.getElementById('search-suggest');
    const searchLoading = document.getElementById('search-loading');
    
    // Check if required elements exist before proceeding
    if (!searchInput || !searchSuggest || !searchLoading) {
        return; // Exit if search elements are not found on this page
    }
    
    const resultContainer = searchSuggest ? searchSuggest.querySelector('.result') : null;
    if (!resultContainer) {
        return; // Exit if result container is not found
    }
    
    let timeoutId;

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (query.length >= 2) {
            searchSuggest.style.display = 'block';
            searchLoading.style.display = 'block';
            resultContainer.style.display = 'none';

            clearTimeout(timeoutId);

            timeoutId = setTimeout(() => {
                fetchSearchResults(query);
            }, 300);
        } else {
            searchSuggest.style.display = 'none';
        }
    });

    document.addEventListener('click', function (e) {
        if (!searchSuggest.contains(e.target) && !searchInput.contains(e.target)) {
            searchSuggest.style.display = 'none';
        }
    });

    async function fetchSearchResults(query) {
        try {
            const response = await fetch(`/src/ajax/search-ajax.php?keyword=${encodeURIComponent(query)}`);
            const text = await response.text();

            let data;
            try {
                data = JSON.parse(text);
            } catch (parseError) {
                console.error('Invalid JSON response:', parseError);
                resultContainer.innerHTML = '<div class="no-results">Invalid server response</div>';
                searchLoading.style.display = 'none';
                resultContainer.style.display = 'block';
                return;
            }

            searchLoading.style.display = 'none';
            resultContainer.style.display = 'block';

            if (data.success && Array.isArray(data.results?.data) && data.results.data.length > 0) {
                const firstFive = data.results.data.slice(0, 5);

                const resultsHTML = firstFive.map(anime => {
                    return `
                        <a href="/details/${anime.id}" class="nav-item">
                            <div class="film-poster">
                                <img src="${anime.poster}" class="film-poster-img" alt="${anime.title}">
                            </div>
                            <div class="srp-detail">
                                <h3 class="film-name" data-jname="${anime.japanese_title || ''}">${anime.title || 'Untitled'}</h3>
                                <div class="alias-name">${anime.japanese_title || ''}</div>
                                <div class="film-infor">
                                    <span>${anime.tvInfo?.rating || ''}</span><i class="dot"></i>${anime.tvInfo?.showType || ''}<i class="dot"></i><span>${anime.duration || ''}</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    `;
                }).join('');

                const viewAll = `
                    <a href="/search?keyword=${encodeURIComponent(query)}" class="nav-item nav-bottom">
                        View all results<i class="fa fa-angle-right ml-2"></i>
                    </a>
                `;

                resultContainer.innerHTML = resultsHTML + viewAll;
            } else {
                resultContainer.innerHTML = '<div class="no-results">No results found. Please check your spelling.</div>';
            }

        } catch (error) {
            console.error('Search request failed:', error);
            resultContainer.innerHTML = '<div class="no-results">Something went wrong. Try again later.</div>';
            searchLoading.style.display = 'none';
            resultContainer.style.display = 'block';
        }
    }
});
