<!--=========== BEGIN OUR COURSES SECTION ================-->
<section id="ourCourses">
  <div class="container">
   <!-- Our courses titile -->
    <div class="row">
      <div class="col-lg-12 col-md-12"> 
        <div class="title_area">
          <h2 class="title_two">Nuetras Carreras</h2>
          <span></span> 
        </div>
      </div>
    </div>
    <!-- End Our courses titile -->
    <!-- Start Our courses content -->
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="ourCourse_content">
          <ul class="course_nav">

            @foreach($carreras as $carrera)

              <li>
                <div class="single_course">
                  <div class="singCourse_imgarea">
                    <img src="web/img/course-1.jpg" />
                    <div class="mask">                         
                      <a href="{{route('carrera',['id_carrera' => $carrera->id_carrera])}}" class="course_more">Ver Carrera</a>
                    </div>
                  </div>
                  <div class="singCourse_content">
                  <h5 class="singCourse_carrera"><a href="#">{{$carrera->carrera}}</a></h5>
                  <p>{{$carrera->detalle}}</p>
                  </div>
                </div>
              </li>

            @endforeach

            
          </ul>
        </div>
      </div>
    </div>
    <!-- End Our courses content -->
  </div>
</section>
<!--=========== END OUR COURSES SECTION ================-->  
