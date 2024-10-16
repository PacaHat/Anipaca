<div id="anime-trending">
    <div class="container">
        <section class="block_area block_area_trending">
            <div class="block_area-header">
                <div class="bah-heading">
                    <h2 class="cat-heading">Trending</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="block_area-content">
                <div class="trending-list" id="trending-home">
                    <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                        <div class="swiper-wrapper">

                            <?php 
                                $d=  date("d");
                                $json = file_get_contents("$api/popular?page=1");
                                $json = json_decode($json, true);
                                foreach($json as $key => $popular) { ?>

                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="number">
                                        <span><?=$key+1?></span>
                                        <div class="film-title dynamic-name" data-jname="<?=$popular['animeTitle']?>">
                                            <?=$popular['animeTitle']?>
                                        </div>
                                    </div>
                                    <a href="/anime/<?=$popular['animeId']?>" class="film-poster"
                                        title="<?=$popular['animeTitle']?>">
                                        <img data-src="<?=$popular['imgUrl']?>"
                                            src="https://anikatsu.me/files/images/no_poster.jpg"
                                            class="film-poster-img lazyload" alt="<?=$popular['animeTitle']?>">
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php } ?>



                        </div>
                        <div class="clearfix"></div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                    <div class="trending-navi">
                        <div class="navi-next swiper-button-disabled" tabindex="-1" role="button"
                            aria-label="Next slide" aria-disabled="true"><i class="fas fa-angle-right"></i>
                        </div>
                        <div class="navi-prev swiper-button-disabled" tabindex="-1" role="button"
                            aria-label="Previous slide" aria-disabled="true"><i class="fas fa-angle-left"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>