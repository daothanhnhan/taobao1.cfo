<div id="Header-Slide" class="gb-slide-destop">
        <div class="Center-Slide">  
            <div class="Infor-Slide">   
                <div id="mainSlide">
                                            <!-- height: 495px; overflow: hidden; -->
                    <div id="slider1_container" style="position: relative; width: 945px; height: 495px; overflow: hidden;"> 
                        <div u="slides" class="slider1_container-img" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 945px; height:495px;
                            overflow: hidden;"> 
                            <?php
                                $array = json_decode($rowConfig['slideshow_home'], true);
                                foreach ($array as $key => $val) {
                                    $img = json_decode($val, true);
                                    if ($img != '') {
                            ?>
                                <div> 
                                    <img  u="image" src="images/<?= $img['image']?>"  class="img-responsive"/>
                                </div>
                            <?php } } ?>
                            
                        </div>
                         
                        <style>
                        #slider1_container{
                            width: 100% !important;
                            height: 495px !important;
                        }
                        @media screen and (max-width: 991px){
                            #slider1_container{
                            height: 216px !important;
                                }
                        }
                        @media screen and (min-width: 991px){
                                #slider1_container > div{
                                transform: scale(1) !important;
                                }
                        }
                        
                        .slider1_container-img{
                            width: 100%;
                            height: 100%;
                        }
                            .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av{  overflow:hidden;  cursor: pointer; }
                            .jssorb03 div { background-position: -5px -4px; }
                            .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
                            .jssorb03 .av { background-position: -65px -4px; }
                            .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }
                        </style>
                        <div u="navigator" class="jssorb03" style="position: absolute; bottom: 16px; left: 6px;">
                            <div u="prototype" style="POSITION: absolute; WIDTH: 21px; HEIGHT: 21px; text-align:center; line-height:21px; color:White; font-size:12px;"><div u="numbertemplate"></div></div>
                        </div>
                        <style>            
                            .jssora20l, .jssora20r, .jssora20ldn, .jssora20rdn{position: absolute; cursor: pointer; display: block; background:url(image/a20.png) no-repeat; overflow:hidden; }
                            .jssora20l { background-position: -3px -33px; }
                            .jssora20r { background-position: -63px -33px; }
                            .jssora20l:hover { background-position: -123px -33px; }
                            .jssora20r:hover { background-position: -183px -33px; }
                            .jssora20ldn { background-position: -243px -33px; }
                            .jssora20rdn { background-position: -303px -33px; }
                        </style>
                        <div class="shadowSlideL"></div>
                        <div class="shadowSlideR"></div>
                        <span u="arrowleft" class="jssora20l" style="width: 55px; height: 55px; top: 123px; left: 140px;">
                        </span>
                        <span u="arrowright" class="jssora20r" style="width: 55px; height: 55px; top: 123px; right: 140px;">
                        </span>
                    </div>
                </div>
                <script type="text/javascript" src="/plugin/jsonslide/jssor.js"></script>
                <script type="text/javascript" src="/plugin/jsonslide/jssor.slider.js"></script>
                <script type="text/javascript" src="/plugin/jsonslide/Main-Slide-Effect.js"></script> 
            </div>
        </div>
    </div>