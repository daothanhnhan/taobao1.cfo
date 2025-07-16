<script src="/plugin/sticky/jquery.sticky.js"></script>
<script>
    $(document).ready(function () {
        $(".sticky-menu").sticky({topSpacing:0});
    });
</script>

<script>
    $(document).ready(function () {
        //-----------------Sticky memu-----------------
        $(".sticky-menu").sticky({topSpacing:0});

        //-----------------scroll-------------------------------------
        var headerHeight = $('.gb-bottom-header').outerHeight();

        $('.slide-section').click(function (e) {
            var linkHref = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(linkHref).offset().top - headerHeight
            }, 1000);
        });

        $('.menu-mobile-nav').click(function () {
            $('.gb-bottom-header').slideToggle();
        });
    });
</script>

slug = slug.replace(/[^a-zA-Z0-9\-]+/gi, '');

;location.href = "'.$_SERVER['REQUEST_URI'].'";



async function copyToClipboard(textToCopy) {
    // Navigator clipboard api needs a secure context (https)
    if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(textToCopy);
    } else {
        // Use the 'out of viewport hidden text area' trick
        const textArea = document.createElement("textarea");
        textArea.value = textToCopy;
            
        // Move textarea out of the viewport so it's not visible
        textArea.style.position = "absolute";
        textArea.style.left = "-999999px";
            
        document.body.prepend(textArea);
        textArea.select();

        try {
            document.execCommand('copy');
        } catch (error) {
            console.error(error);
        } finally {
            textArea.remove();
        }
    }
}