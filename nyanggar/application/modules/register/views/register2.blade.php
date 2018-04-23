@layout('master_view')
@section('content')
        <div class="wrap3">
          <div id="box">
            <h1>Daftar Sebagai Client</h1>
            <p class="reg">Daftarkan diri anda sebagai client untuk dapat mempelajari dan mencari jasa pertunjukan tari tradisional di Indonesia.</p>
            <br>
            <form action="<?php echo site_url('register/daftarclient'); ?>" method="POST">
              <div>
                <?php echo validation_errors(); ?>
                <p>Nama Lengkap:</p>
                <input type="text" name="nama" class="form-control">
                <p>Tanggal Lahir</p>
                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="ttl">
                <p>Email</p>
                <input type="email" name="email" class="form-control">
                <p>No Hp:</p>
                <input type="text" name="nohp" class="form-control">
                <p>Kata Sandi:</p>
                <input type="password" name="password" class="form-control"><br>
                <input type="submit" value="Daftar" class="btn btn-warning" style="color :#fff;">
                <br><br><br>
              </div>  
            </form>
            
          </div>
        </div>
@endsection
