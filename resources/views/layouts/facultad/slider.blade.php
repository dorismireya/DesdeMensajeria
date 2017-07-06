<!--=========== BEGIN SLIDER SECTION ================-->
<section id="slider">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="slider_area">
        <!-- Start super slider -->
        <div id="slides">
          <ul class="slides-container">                          
            <li>
              <img src="web/img/slider/2.jpg" alt="img">
               <div class="slider_caption slider_right_caption">
                
                <br><br><br>
                {!!$facultad->detalle!!}
              </div>
              </li>
            <!-- Start single slider-->
            <li>
              <img src="web/img/slider/3.jpg" alt="img"> 
               <div class="slider_caption" >
                  {!!$facultad->mision!!}
    
              </div>
            </li>
            <!-- Start single slider-->
            <li>
              <img src="web/img/slider/4.jpg" alt="img">
               <div class="slider_caption">
                
                {!!$facultad->vision!!}
                
                <!-- <a class="slider_btn" href="#">Know More</a> -->
              </div>
            </li>

            <li>
              <img src="web/img/slider/5.jpg" alt="img">
               <div class="slider_caption">
                <br><br><br>
                {!!$facultad->autoridad!!}
                
                <!-- <a class="slider_btn" href="#">Know More</a> -->
              </div>
            </li>
          </ul>
          <nav class="slides-navigation">
            <a href="#" class="next"></a>
            <a href="#" class="prev"></a>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>
<!--=========== END SLIDER SECTION ================-->