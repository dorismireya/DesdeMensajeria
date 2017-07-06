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
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="courseArchive_content">
          </div>
          <!-- end blog archive  -->
          <!-- start related post -->
          <div class="related_post">
            <h2>Avisos del Departamento</h2>
            <h2>Materias Nivel A</h2>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="single_blog_archive wow fadeInUp">
                  <div class="blogimg_container">
                    <a class="blog_img" href="#">
                      <img src="web/img/blog.jpg" alt="img">
                    </a>
                  </div>
                  <h2 class="blog_title"><a href="blog-single.html"> Curabitur ac dictum nisl eu hendrerit ante</a></h2>
                  <div class="blog_commentbox">
                    <p><i class="fa fa-clock-o"></i>Time: 7pm,15 March 2015</p>
                    <p><i class="fa fa-map-marker"></i>Location: London,UK</p>                      
                  </div>
                  <p class="blog_summary">Duis erat purus, tincidunt vel ullamcorper ut, consequat tempus nibh. Proin condimentum risus ligula, dignissim mollis tortor hendrerit vel. Aliquam...</p>
                  <a href="#" class="blog_readmore">Read More</a>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="single_blog_archive wow fadeInUp">
                  <div class="blogimg_container">
                    <a class="blog_img" href="#">
                      <img src="web/img/blog.jpg" alt="img">
                    </a>
                  </div>
                  <h2 class="blog_title"><a href="blog-single.html"> Curabitur ac dictum nisl eu hendrerit ante</a></h2>
                  <div class="blog_commentbox">
                    <p><i class="fa fa-clock-o"></i>Time: 7pm,15 March 2015</p>
                    <p><i class="fa fa-map-marker"></i>Location: London,UK</p>                      
                  </div>
                  <p class="blog_summary">Duis erat purus, tincidunt vel ullamcorper ut, consequat tempus nibh. Proin condimentum risus ligula, dignissim mollis tortor hendrerit vel. Aliquam...</p>
                  <a href="#" class="blog_readmore">Read More</a>
                </div>
              </div>
            </div> 
          </div> 
          <!-- start related post -->     
          <!-- start blog archive  -->
          <div class="row">
              <div class="single_blog_prevnext">
                <a class="prev_post wow fadeInLeft" href="#"><i class="fa fa-angle-left"></i>Previous Event</a>
                <a class="next_post wow fadeInRight" href="#">Next Event<i class="fa fa-angle-right"></i></a>
              </div>
            </div>
            <!-- End single blog -->                      
        </div>
      <!-- End course content -->
      <!-- start course archive sidebar -->
      @include('layouts.partials.archive_sidebar')
    </div>
  </div>
</section>
<!--=========== END COURSE BANNER SECTION ================-->   
@include('layouts.partials.footer')
@endsection