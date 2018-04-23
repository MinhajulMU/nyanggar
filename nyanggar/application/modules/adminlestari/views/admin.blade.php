@layout('master')
@section('content')
<section class="content-header">
      <h1>
        Administrator
        <small>Nyanggar.id</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Administrator</a></li>
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
              <button class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i> Tambah Admin 
              </button>
            </div>
            <div class="col-lg-4 col-md-4">
               <form action="<?php echo site_url('adminlestari/searchadmin');?>" method="POST">
              <div class="input-group input-group-sm">
               
                <input type="text" class="form-control" name="cari">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-warning">cari!</button>
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
                  <th>Alamat</th>
                  <th>Username</th>
                  <th colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($isi['admin'] as $key)
                <tr>
                  <td>{{$key['nama_lengkap']}}</td>
                  <td>{{$key['email']}}</td>
                  <td>{{$key['no_hp']}}</td>
                  <td>{{$key['alamat']}}</td>
                  <td>{{$key['username']}}</td>
                  <td><a href="?id=<?php echo $key['id_admin']; ?>"><button class="btn btn-default"><i class="fa fa-pencil"></i> Edit</button></a></td>
                  <td><a href="#" kode="{{$key['id_admin']}}"  class="hapus"><button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button></a></td>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"> Administrator Nyanggar.id</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('adminlestari/addadmin');?>" method="POST">
        <h6>Nama Lengkap</h6>
        <input type="text" name="nama" class="form-control" required maxlength="30">
        <h6>Email</h6>
        <input type="email" name="email" class="form-control" required maxlength="40">
        <h6>No HP</h6>
        <input type="text" name="nohp" class="form-control" required maxlength="30">
        <h6>Alamat</h6>
        <textarea class="form-control" name="alamat" required>
          
        </textarea>
        <h6>Username</h6>
        <input type="text" name="username" class="form-control" required maxlength="30">
        <h6>Password</h6>
        <input type="Password" name="password" class="form-control" required maxlength="30">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_GET['id'])) {
?>
<!-- Modal 1-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Data <?php 
           
           foreach ($isi['update'] as $update) {
             # code...
           
          ?></h4>
        
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('adminlestari/editadmin');?>" method="POST">
          <input type="hidden" name="id" value="{{$update['id_admin']}}">
          <h6>Nama Lengkap</h6>
          <input type="text" name="nama" class="form-control" required maxlength="30" value="{{$update['nama_lengkap']}}">
          <h6>Email</h6>
          <input type="email" name="email" class="form-control" required maxlength="40" value="{{$update['email']}}">
          <h6>No HP</h6>
          <input type="text" name="nohp" class="form-control" required maxlength="30" value="{{$update['no_hp']}}">
          <h6>Alamat</h6>
          <textarea class="form-control" name="alamat" required>
            {{$update['alamat']}}
          </textarea>
          <h6>Username</h6>
          <input type="text" name="username" class="form-control" required maxlength="30" value="{{$update['username']}}">
          <h6>Password</h6>
          <input type="Password" name="password" class="form-control" required maxlength="30" disabled="" > 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
        
      </div>
      
    </div>
  </div>
</div>
<?php
    } ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#myModal1").modal("show");
    });
  </script>

    <?php
  }
?>
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
                url:"<?php echo site_url('adminlestari/deleteadmin');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('adminlestari/admin');?>";
                }
            });
        });
   })
    
    
</script>
@endsection