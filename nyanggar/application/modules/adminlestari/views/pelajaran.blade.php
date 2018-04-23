@layout('master')
@section('content')
<section class="content-header">
      <h1>
        Mata Pelajaran
        <small>Nyanggar.id</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Mata Pelajaran</a></li>
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
                <i class="fa fa-plus"></i> Tambah Mata Pelajaran 
              </button>
            </div>
            <div class="col-lg-4 col-md-4">
               <form action="<?php echo site_url('adminlestari/searchpelajaran');?>" method="POST">
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
                  <th>Nama Mata Pelajaran</th>
                  <th>Deskripsi</th>
                  <th colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($isi['pelajaran'] as $key)
                <tr>
                  <td>{{$key['nama_pelajaran']}}</td>
                  <td>{{$key['keterangan']}}</td>
                  <td><a href="?id=<?php echo $key['id_pelajaran']; ?>"><button class="btn btn-default"><i class="fa fa-pencil"></i> Edit</button></a></td>
                  <td><a href="#" kode="{{$key['id_pelajaran']}}"  class="hapus"><button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button></a></td>
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
        <h4 class="modal-title" id="myModalLabel"> Mata Pelajaran Les Tari</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('adminlestari/addpelajaran');?>" method="POST">
        <h6>Nama Mata Pelajaran</h6>
        <input type="text" name="mapel" class="form-control" required maxlength="30">
        <h6>Deskripsi</h6>
        <textarea class="form-control" name="deskripsi" required>
          
        </textarea>
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
        <h4 class="modal-title" id="myModalLabel">Edit Mata Pelajaran <?php 
           
           foreach ($isi['update'] as $update) {
             # code...
           
          ?></h4>
        
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('adminlestari/editpelajaran');?>" method="POST">
          <input type="hidden" name="id" value="{{$update['id_pelajaran']}}">
          <h6>Nama Mata Pelajaran</h6>
          <input type="text" name="mapel" class="form-control" required maxlength="30" value="{{$update['nama_pelajaran']}}">
          <h6>Deskripsi</h6>
          <textarea class="form-control" name="deskripsi" required> 
          {{$update['keterangan']}}
          </textarea>
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
                url:"<?php echo site_url('adminlestari/deletepelajaran');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('adminlestari/pelajaran');?>";
                }
            });
        });
   })
    
    
</script>
@endsection