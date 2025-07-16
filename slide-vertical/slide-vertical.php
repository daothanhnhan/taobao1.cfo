<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="jquery.vticker.js" type="text/javascript" charset="utf-8" async defer></script>
<div id="example">
  <ul>
    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</li>
    <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut</li>
    <li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</li>
  </ul>
</div>

<script type="text/javascript">
    $(function () {
        $('#hotbdscontainer').vTicker({
            speed: 500,
            pause: 3000,
            animation: 'fade',
            mousePause: true,
            showItems: 8
        });

        $('#tinbdsmoicontainer').vTicker({
            speed: 500,
            pause: 5000,
            animation: 'fade',
            mousePause: true,
            showItems: 3
        });

        $('#doitaccontainer').vTicker({
            speed: 500,
            pause: 6000,
            animation: 'fade',
            mousePause: true,
            showItems: 4
        });
    });
</script>
<script>
$(function() {
  $('#example').vTicker();
});
</script>