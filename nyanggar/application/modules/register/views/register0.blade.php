@layout('master_view')
@section('content')

        <div class="wrap3">
          <div id="box" style="min-height: 450px;">
            <div style="width: 100%;text-align: center;padding-top: 20px;">
            <img src="<?php echo base_url(); ?>assets/images/logo2.png" style="width: 150px;text-align: center;margin: 0 auto;">
            </div>
            <h1>Mari bergabung menjadi Generasi Lestari bersama Nyanggar.id</h1>
            <p class="reg">Mari lestarikan kekayaan tari tradisional budaya indonesia</p>
            
            <div style="text-align: center;">
              <div class="btn btn-warning" style="margin-top: 20px;">
                <a href="<?php echo site_url('register/client'); ?>" style="color: #fff;">Daftar sebagai Client</a>
              </div> Atau 
              <div class="btn btn-primary" style="margin-top: 20px;">
                <a href="<?php echo site_url('register/penari'); ?>" style="color: #fff;">Daftar sebagai Penari</a>
              </div>
            </div><br>
            <p style="text-align: center;">Sudah punya akun Nyanggar.id ? silahkan masuk <a href="<?php echo site_url('masuk'); ?>" style="color: blue;">disini</a></p>
          </div>
        </div>
@endsection