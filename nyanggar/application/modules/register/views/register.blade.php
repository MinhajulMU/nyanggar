@layout('master_view')
@section('content')
        <div class="wrap3">
          <div id="box">
            <h1>Daftar Sebagai Penari</h1>
            <p class="reg">Lengkapi profil anda untuk mendapatkan job sebagai penari tradisional!</p>
            <br>
            <form action="<?php  echo site_url('register/daftarpenari');?>" method="post">
              <div>
                <?php echo validation_errors(); ?>
                <p>Nama Lengkap:</p>
                <input type="text" name="nama" class="form-control">
                <p>Jenis Kelamin:</p>
                <select class="form-control" name="jkel">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                <p>E-Mail:</p>
                <input type="email" name="email" class="form-control">
                <p>Nomor Handphone:</p>
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