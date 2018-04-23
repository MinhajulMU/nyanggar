@layout('master')
@section('content')
<section class="content-header">
      <h1>
        Dashboard
        <small>Nyanggar.id</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <!-- /.content -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php print_r($jumlah['jumlahpenari']); ?></h3>
                  <p>Penari</p>
                </div>
                <div class="icon">
                  <i class="fa fa-male"></i>
                </div>
                <a href="<?php echo site_url('adminlestari/penari'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php print_r($jumlah['jumlahuser']); ?></h3>
                  <p>User</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-md"></i>
                </div>
                <a href="<?php echo site_url('adminlestari/users'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php print_r($jumlah['jumlahpesanles']); ?></h3>
                  <p>Pesanan Les</p>
                </div>
                <div class="icon">
                  <i class="fa fa-signing"></i>
                </div>
                <a href="<?php echo site_url('adminlestari/les'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php print_r($jumlah['jumlahpesanpertunjukan']); ?></h3>
                  <p>Pesanan Pertunjukan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-star"></i>
                </div>
                <a href="<?php echo site_url('adminlestari/pertunjukan'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
</section>

@endsection