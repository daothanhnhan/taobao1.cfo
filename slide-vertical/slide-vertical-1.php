<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script>
<style>
body {
  background-color: #999;
}

.wrapper {
  margin: 0 auto;
  padding: 15px;
  width: 45em;
  height: 25em;
  background-color: #3E3E3E;
  box-shadow: 7px 5px 4px rgba(0,0,0,0.5);
}

.scrollbox {
  margin: 0 auto;
  padding: 25px 0;
  width: 100%;
  height: 100%;
  position: relative;
  overflow: hidden;
  background-color: #FFF;
  box-shadow: 7px 5px 4px rgba(0,0,0,0.5);
  border: 1px solid black;
  border-radius: 2px;
  box-sizing: border-box;
}

.scrollgroup {
  position: absolute;
  width: 100%;
  box-sizing: border-box;
  z-index: 0;
}

.scrollgroup .scrollitem {
  width: 100%;
  padding: 0;
  margin: 0 auto;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
</style>
<div class="wrapper"><!-- Main Container -->  
  <div class="scrollbox"><!-- Div that will hold the scroll -->
    <div class="scrollgroup">
      <div class="scrollitem">
        <div>1) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>2) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>3) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>4) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>5) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>6) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>7) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>8) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>9) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
      <div class="scrollitem">
        <div>10) Name</div>
        <div>Email Address</div>
        <div>Having something to say</div>
      </div>
    </div><!-- End scrollgroup -->
  </div><!-- End scrollbox -->  
</div><!-- End Main Container -->


<script>
(function(){

  var timerId = null;
  function startSetInterval() {
    timerId = setInterval(function(){
      $( ".scrollitem:first" ).slideUp();
      setTimeout(function() {
        $( ".scrollitem:first" ).fadeIn().appendTo( ".scrollgroup" )
      }, 300);
    }, 2000);
  }
  startSetInterval();

  $('.scrollitem').mouseover(function(){
    clearInterval(timerId);
  }).mouseout(function(){
    startSetInterval();
  });
  
})();

</script>