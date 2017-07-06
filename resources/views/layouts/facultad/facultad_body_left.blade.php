<!-- PRODUCT LIST -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Carreras</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <ul class="products-list product-list-in-box">
      @foreach($carreras as $carrera)
        <li class="item">
          <!-- <div class="product-img">
            <img src="dist/img/default-50x50.gif" alt="Product Image">
          </div> -->
          <div class="product-info">
            <a href="#" class="product-title">{{$carrera->carrera}}</a>
          </div>
        </li><!-- /.item -->
      @endforeach
    </ul>
  </div><!-- /.box-body -->
</div><!-- /.box -->