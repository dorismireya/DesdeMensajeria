@extends('layouts.app')

@section('htmlheader_title')
  
  Inicio
@endsection

@section('main-content')

@include('layouts.partials.mainheader')

<!--=========== BEGIN COURSE BANNER SECTION ================-->
<section id="imgBanner">
  <h2>Contacto</h2>
</section>
<!--=========== END COURSE BANNER SECTION ================-->

<!--=========== BEGIN CONTACT SECTION ================-->
<section id="contact">
  <div class="container">
   <div class="row">
      <div class="col-lg-12 col-md-12"> 
        <div class="title_area">
          <h2 class="title_two">Nosotros Somos la {{$facultad->facultad}}</h2>
          <span></span> 
          <p>El Portal Web es un instrumento de comunicación para dar a conocer toda la información de la Facultad Politécnica del Valle Alto (FPVA) y su oferta académica,  como  ser  proyectos,  objetivos,  noticias, cursos, talleres, seminarios, eventos y otros,  teniendo  por objetivo  brindar  al estatuto docente, estatuto administrativo y estatuto estudiantil  en  general  información  útil  de  la FPVA  y    mostrar  los  logros  obtenidos  en la Facultad  detallando  los  beneficios  que  se  otorgan;  y  de esta manera, proporcionar oportunidades de participación y accesibilidad a los diferentes estatutos.</p>
        </div>
      </div>
   </div>
   <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8">
       <div class="contact_form wow fadeInLeft">
          <img src="web/img/mapa_fpva.jpg" class="Responsive image img-thumbnail" alt=""/> 
       </div>
     </div>
     <div class="col-lg-4 col-md-4 col-sm-4">
       <div class="contact_address wow fadeInRight">
         <h3>Dirección</h3>
         <div class="address_group">
           <p>{{$facultad->direccion}}</p>
           <p>Telefónos: (591-4) {{$facultad->telefono}}</p>
           <p>Fax: (591-4) {{$facultad->fax}}</p>
           <p>Email:contact@fpva.umss.edu.bo</p>
         </div>
         <div class="address_group">
          <ul class="footer_social">
            <li><a href="#" class="soc_tooltip" title="" data-placement="top" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" class="soc_tooltip" title="" data-placement="top" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" class="soc_tooltip" title="" data-placement="top" data-toggle="tooltip" data-original-title="Google+"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#" class="soc_tooltip" title="" data-placement="top" data-toggle="tooltip" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#" class="soc_tooltip" title="" data-placement="top" data-toggle="tooltip" data-original-title="Youtube"><i class="fa fa-youtube"></i></a></li>
            </ul>
         </div>
       </div>
     </div>
   </div>
  </div>
</section>
<!--=========== END CONTACT SECTION ================-->

<!--=========== BEGIN GOOGLE MAP SECTION ================-->
<section id="googleMap">
  <iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Av.Mayor Rocha,+Punata,+Cochabamba,+Bolivia&amp;aq=&amp;sll=-17.543142170660154,-65.84324918815611&amp;sspn=42.157377,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Av.Mayor Rocha,+Punata,+Cochabamba+93901-2639&amp;t=m&amp;z=14&amp;ll=-17.543142170660154,-65.84324918815611&amp;output=embed"></iframe>
</section>
<!--=========== END GOOGLE MAP SECTION ================-->

  @include('layouts.partials.footer')
@endsection