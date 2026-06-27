define(['jquery', 'slick'], function($) {
    'use strict';

    return function(config) {
        $(document).ready(function() {
            var slider = $('#product-slider');
            if (slider.length) {
                slider.slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: config.maxProducts,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: true
                            }
                        }
                    ]
                });
            }
        });
    };
});