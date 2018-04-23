@layout('master_view')
@section('content')
        <div class="wrap3">
          <div id="box" style="min-height: 450px;">
          <div style="width: 100%;text-align: center;padding-top: 50px;">
            <img src="<?php echo base_url(); ?>assets/images/logo2.png" style="width: 150px;text-align: center;margin: 0 auto;">
            </div><br>
            <p style="text-align: center;">Selamat, anda telah berhasil membuat akun pada portal Nyanggar.id. silahkan masuk dapat berinteraksi lebih lanjut.</p>
            <a href="<?php echo site_url('masuk'); ?>"><button class="btn btn-warning" style="color: #fff;width: 100%;">Masuk</button></a>
          </div>
        </div>
@endsection
