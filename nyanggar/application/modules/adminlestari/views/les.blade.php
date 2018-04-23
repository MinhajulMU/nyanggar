@layout('master')
@section('content')
<section class="content-header">
      <h1>
        Pemesanan Les
        <small>Nyanggar.id</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Transaksi Les</a></li>
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
               <form action="<?php echo site_url('adminlestari/searchles');?>" method="POST">
              <div class="input-group input-group-sm">
               
                <input type="text" class="form-control" name="cari">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-warning">Cari</button>
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
                  <th>Nama Client</th>
                  <th>Total Bayar</th>
                  <th>Bank</th>
                  <th>Status Pesanan</th>
                  <th>Maksimal Pembayaran</th>
                  <th>Bukti Pembayaran</th>
                  
                  <th colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($isi['admin'] as $key)
                <tr>
                  <td>{{$key['nama_lengkap']}}</td>
                  <td>Rp. {{$key['jumlah_bayar']}}</td>
                  <td>{{$key['nama_bank']}}</td>
                  <td>
                    <?php
                    if ($key['status_pembayaran'] == 'verified') {
                      # code...
                      ?>
                    <span class="label label-success">{{$key['status_pembayaran']}}</span>
                      <?php
                    }else if($key['status_pembayaran'] == 'belum_bayar'){
                      ?>
                      <span class="label label-danger">{{$key['status_pembayaran']}}</span>
                      <?php
                    }else{
                      ?>
                      <span class="label label-warning">{{$key['status_pembayaran']}}</span>
                      <?php
                    }
                    ?>
                  </td>
                  <td><?php echo date('d-M-Y H:i',strtotime($key['maks_pembayaran'])); ?></td>
                  <td>
                    <div style="width: 200px;height: 100px;overflow: hidden;">
                    <?php
                    if ($key['bukti_pembayaran'] != '') {
                     ?>
                     <img src="<?php echo base_url(); ?>upload/bukti/{{$key['bukti_pembayaran']}}" width="200px">
                     <?php
                    }else{
                      echo "belum ada";
                    }
                    ?>
                    
                    </div>
                  </td>
                  <td><a href="<?php echo site_url('adminlestari/accept/'.$key['id_pesan_les']); ?>"><button class="btn btn-default"><i class="fa fa-check"></i> Accept</button></a> </td>
                  <td><a href="#" kode="{{$key['id_pesan_les']}}"  class="hapus"><button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button></a></td>
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
                url:"<?php echo site_url('adminlestari/deleteles');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('adminlestari/les');?>";
                }
            });
        });
   })
    
    
</script>
@endsection