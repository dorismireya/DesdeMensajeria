@extends('layouts.app')

@section('htmlheader_title')
  
  Inicio
@endsection

@section('main-content')

@include('layouts.partials.mainheader')
    
<!--=========== BEGIN COURSE BANNER SECTION ================-->
<br><br>
<section id="courseArchive">
  <div class="container">
    <div class="row">
      <!-- start course content -->
      <div class="col-lg-9 col-md-9 col-sm-9">
        <h2>Información <span class="fa fa-angle-double-right"></span></h2>
        <div class="courseArchive_content">
          <!-- start blog archive  -->
          <div class="row">
            <!-- start single blog archive -->
            <div class="col-lg-12 col-12 col-sm-12">
              <div class="single_blog_archive wow fadeInUp">
                <div class="blogimg_container">
                  <a href="#" class="blog_img">
                    <img alt="img" src="web/img/blog.jpg">
                  </a>
                </div>
                <h2 class="blog_title"><a href="events-single.html"> Curabitur ac dictum nisl eu hendrerit ante</a></h2>
                <div class="blog_commentbox">
                  <p><i class="fa fa-clock-o"></i>Time: 7pm,15 March 2015</p>
                  <p><i class="fa fa-map-marker"></i>Location: London,UK</p>                      
                </div>
                <p class="blog_summary">Duis erat purus, tincidunt vel ullamcorper ut, consequat tempus nibh. Proin condimentum risus ligula, dignissim mollis tortor hendrerit vel. Aliquam...</p>
                <a class="blog_readmore" href="events-single.html">Read More</a>
              </div>
            </div>
            <!-- End single blog archive -->
            <!-- start single blog archive -->
            <div class="col-lg-12 col-12 col-sm-12">
              <div class="single_blog_archive wow fadeInUp">
                <div class="blogimg_container">
                  <a href="#" class="blog_img">
                    <img alt="img" src="img/blog.jpg">
                  </a>
                </div>
                <h2 class="blog_title"><a href="events-single.html"> Curabitur ac dictum nisl eu hendrerit ante</a></h2>
                <div class="blog_commentbox">
                  <p><i class="fa fa-clock-o"></i>Time: 7pm</p>
                  <p><i class="fa fa-map-marker"></i>Location: London,UK</p>                      
                </div>
                <p class="blog_summary">Duis erat purus, tincidunt vel ullamcorper ut, consequat tempus nibh. Proin condimentum risus ligula, dignissim mollis tortor hendrerit vel. Aliquam...</p>
                <a class="blog_readmore" href="events-single.html">Read More</a>
              </div>
            </div>
            <!-- End single blog archive -->
            <!-- start single blog archive -->
            <div class="col-lg-12 col-12 col-sm-12">
              <div class="single_blog_archive wow fadeInUp">
                <div class="blogimg_container">
                  <a href="#" class="blog_img">
                    <img alt="img" src="img/blog.jpg">
                  </a>
                </div>
                <h2 class="blog_title"><a href="events-single.html"> Curabitur ac dictum nisl eu hendrerit ante</a></h2>
                <div class="blog_commentbox">
                  <p><i class="fa fa-clock-o"></i>Time: 7pm</p>
                  <p><i class="fa fa-map-marker"></i>Location: London,UK</p>                      
                </div>
                <p class="blog_summary">Duis erat purus, tincidunt vel ullamcorper ut, consequat tempus nibh. Proin condimentum risus ligula, dignissim mollis tortor hendrerit vel. Aliquam...</p>
                <a class="blog_readmore" href="events-single.html">Read More</a>
              </div>
            </div>
            <!-- start single blog archive -->
          </div>
          <!-- end blog archive  -->
         
          <!-- start previous & next button -->
          <div class="single_blog_prevnext">
            <a href="#" class="prev_post wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"><i class="fa fa-angle-left"></i>Previous</a>
            <a href="#" class="next_post wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">Next<i class="fa fa-angle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- End course content -->
      @include('layouts.partials.sidebar_uti')
     
    </div>
  </div>
</section>
<!--=========== END COURSE BANNER SECTION ================-->
    
 @include('layouts.partials.footer')
@endsection