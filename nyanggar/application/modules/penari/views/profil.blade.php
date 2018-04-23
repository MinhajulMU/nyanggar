<h2>Lengkapi Identitas Anda</h2>
              <p>Identitas anda akan digunakan untuk melakukan verifikasi terhadap profil anda. profil tanpa identitas yang lengkap akan memiliki skor rendah Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</p>
               <?php echo validation_errors(); ?>
              <form action="<?php echo site_url('penari/profil'); ?>" method="POST" enctype="multipart/form-data">
                <h4>Nama Lengkap <b style="color: #d8780a;">*</b></h4>
                <input type="text" name="nama" class="form-control" required maxlength="50">
                <h4>E-Mail <b style="color: #d8780a;">*</b></h4>
                <input type="email" name="email" class="form-control" required maxlength="50">
                <h4>No HP <b style="color: #d8780a;">*</b></h4>
                <input type="text" name="nohp" class="form-control" required maxlength="50">
                <h4>Tanggal Lahir <b style="color: #d8780a;">*</b></h4>
                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="ttl" maxlength="50">
                <h4>Foto</h4>
                <input type="file" name="foto" class="form-control" maxlength="50">
                <h4>Jenis Kelamin <b style="color: #d8780a;">*</b></h4>
                <select class="form-control" name="jkel">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                <h4>Alamat <b style="color: #d8780a;">*</b></h4>
                <textarea name="alamat" class="form-control" >                  
                </textarea>
                <h4>Nomor KTP </h4>
                <input type="text" name="nomor" class="form-control" maxlength="50">
                <h4>Nama Bank </h4>
                <input type="text" name="namabank" class="form-control" maxlength="50">
                <h4>Nomor Rekening </h4>
                <input type="text" name="nomorrekening" class="form-control" maxlength="50">
                <h4>Nama Pemilink Rekening </h4>
                <input type="text" name="namapemilik" class="form-control" maxlength="50">
                <h4>Tentang Saya </h4>
                <textarea class="form-control" name="tentang">
                  
                </textarea><br>
                <input type="submit" class="btn btn-warning" style="color: #fff;" value="Simpan">
</form>