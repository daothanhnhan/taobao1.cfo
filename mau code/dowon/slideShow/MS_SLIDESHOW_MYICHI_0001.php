<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-slideshow_myichi gb-slide-mobile">
    <div class="gb-slideshow_myichi-slide owl-carousel owl-theme">
        <?php
            $array = json_decode($rowConfig['slideshow_home'], true);
            foreach ($array as $key => $val) {
                $img = json_decode($val, true);
                if ($img != '') {
        ?>
            <div class="item">
                <img src="images/<?= $img['image']?>" alt="" class="img-responsive">
            </div>
        <?php } } ?>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        var owl = $('.gb-slideshow_myichi-slide');
        owl.owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:true,
            dots:false,
            autoplay: true,
            rewind: true,
            navText:[],
            items:1,
            responsive:{
                0:{
                    nav:false
                },
                600:{
                    nav:true
                }
            }
        });
        function setAnimation ( _elem, _InOut ) {
            var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

            _elem.each ( function () {
                var $elem = $(this);
                var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                $elem.addClass($animationType).one(animationEndEvent, function () {
                    $elem.removeClass($animationType);
                });
            });
        }
        owl.on('change.owl.carousel', function(event) {
            var $currentItem = $('.owl-item', owl).eq(event.item.index);
            var $elemsToanim = $currentItem.find("[data-animation-out]");
            setAnimation ($elemsToanim, 'out');
        });
        var round = 0;
        owl.on('changed.owl.carousel', function(event) {

            var $currentItem = $('.owl-item', owl).eq(event.item.index);
            var $elemsToanim = $currentItem.find("[data-animation-in]");

            setAnimation ($elemsToanim, 'in');
        });

        owl.on('translated.owl.carousel', function(event) {
            console.log (event.item.index, event.page.count);

            if (event.item.index == (event.page.count - 1))  {
                if (round < 1) {
                    round++;
                    console.log (round);
                } else {
                    owl.trigger('stop.owl.autoplay');
                    var owlData = owl.data('owl.carousel');
                    owlData.settings.autoplay = false;
                    owlData.options.autoplay = false;
                    owl.trigger('refresh.owl.carousel');
                }
            }
        });

    });
</script>