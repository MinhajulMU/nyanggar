@layout('master')
@section('content')
<section class="content-header">
      <h1>
        Users
        <small>Nyanggar.id</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Users</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <!-- /.content -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-lg-8 col-md-8">
              
            </div>
            <div class="col-lg-4 col-md-4">
               <form action="<?php echo site_url('adminlestari/searchusers');?>" method="POST">
              <div class="input-group input-group-sm">
               
                <input type="text" class="form-control" name="cari">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-warning">Go!</button>
                    </span>
                
              </div>
              </form>
            </div>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        <div class="box-body">
        <?php echo validation_errors(); ?>
        <?php
            echo $this->session->flashdata('pesan');
            echo $this->session->flashdata('hapus');
        ?>
          <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>No Hp</th>
                  <th>Tanggal Lahir</th>
                  <th >Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($isi['admin'] as $key)
                <tr>
                  <td>{{$key['nama_lengkap']}}</td>
                  <td>{{$key['email']}}</td>
                  <td>{{$key['nohp']}}</td>
                  <td><?php echo date('d-M-Y',strtotime($key['ttl'])); ?></td>
                  
                  <td><a href="#" kode="{{$key['id_users']}}"  class="hapus"><button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button></a></td>
                </tr>
                @endforeach
                </tbody>
          </table>
          <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4" style="text-align: right;"><?php 
                    if (isset($isi['pagination'])) {
                      # code...
                      echo $isi['pagination'];  
                    }
                    ?></div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
</section>

<script>
   $(document).ready(function(){
          $(".hapus").click(function(){
            var kode=$(this).attr("kode");            
            $("#idhapus").val(kode);
            $("#myModalss").modal("show");
        });
        
        $("#konfirmasi").click(function(){
            var kode=$("#idhapus").val();
            
            $.ajax({
                url:"<?php echo site_url('adminlestari/deleteusers');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('adminlestari/users');?>";
                }
            });
        });
   })
    
    
</script>
@endsection