@layout('master_view')
@section('content')
      <section id="slider">
         <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?php echo base_url(); ?>assets/images/slide/9.jpg" alt="First slide">
              <div class="carousel-caption">
                <h1 class="judul">Ketika Budaya Bertemu Teknologi</h1>
                <p>Melestarikan budaya ditengah kemajuan zaman modern</p>
              </div>

            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url(); ?>assets/images/slide/2.jpg" alt="Second slide">
              <div class="carousel-caption">
                <h1 class="judul">Seni Tari untuk Indonesia</h1>
                <p>Mudah mencari pertunjukan budaya sebagai hiburan masyarakat</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url(); ?>assets/images/slide/3.jpg" alt="Third slide">
              <div class="carousel-caption">
                <h1 class="judul">Belajar kapan pun dan di mana pun</h1>
                <p>Belajar jadi mudah dan menyenangkan bersama LesTari</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo base_url(); ?>assets/images/slide/5.jpg" alt="Third slide">
              <div class="carousel-caption">
                <h1 class="judul">Sejahtera Penari Indonesia</h1>
                <p>Sebagai jembatan roda ekonomi bidang seni dan  budaya</p>
              </div>
            </div>
          </div>

          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </section>
      <section id="kenal">
        <div class="wrap2">
          <h1 class="judul2" style="padding-top: 110px;">Mengenal Nyanggar.id</h1>
          <br>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div style="width: 100%;overflow: hidden;" class="ii">
              <img src="<?php echo base_url(); ?>assets/images/aa.jpg" >
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <p>
                Nyanggar.id adalah suatu aplikasi untuk menghubungkan para penari dan seniman pertunjukan dengan masyarakat yang membutuhkan, sehingga dapat mempermudah interaksi diantara keduanya. Aplikasi ini adalah media aplikasi berbasis Web dengan tampilan sederhana namun menarik dan mudah digunakan (user friendly).</p><br>
                <p>
                   Aplikasi Nyanggar.id ini digunakan sebagai jembatan yang mempermudah para seniman dalam menawarkan karyanya, sehingga karya dan kearifan budaya tersebut dapat tetap eksis dan tidak tergerus oleh kemajuan zaman modern.<br>
                   #Nyanggar.id #lestaribudaya #lestaritariindonesia #IndonesiaKaya
              </p>
            </div>
          </div>
        </div>   
      </section>
      <section id="segera">
        <p>Segera daftar di Nyanggar.id, Mari Bergabung menjadi Generasi Lestari, Lestarikan Budaya Indonesia.</p>
      </section>
      <section id="apa">
        <div class="wrap2">
          <div >
            <h1 class="judul2" style="padding-top: 110px;">Apa yang dapat kamu lakukan di Nyanggar.id ?</h1>
          </div>
          <ul style="margin-top: 80px;">
            <li>
              <div class="circle">
                <img src="<?php echo base_url(); ?>assets/images/icon2/melestarikan budaya.png" style="width: 80px;">
              </div>
              <p><b>Melestarikan Budaya Bangsa</b></p>
            </li>
            <li>
              <div class="circle">
                <img src="<?php echo base_url(); ?>assets/images/icon2/membelajari budaya.png" style="width: 135px;padding-top: 20px;">
              </div>
              <p><b>Mempelajari Budaya Bangsa</b></p>
            </li>
            <li>
              <div class="circle">
                <img src="<?php echo base_url(); ?>assets/images/icon2/mencari guru les.png">
              </div>
              <p><b>Mencari Jasa Guru Les Tari</b></p>
            </li>
            <li>
              <div class="circle">
                <img src="<?php echo base_url(); ?>assets/images/icon2/mencari pertunjukan.png" style="width: 135px;padding-top: 15px;">
              </div>
              <p><b>Mencari Jasa Hiburan Pertunjukan</b></p>
            </li>
          </ul>
        </div>
      </section>
      <section id="gabung">
        <div class="wrap2">
          <h1 class="judul2" style="padding-top: 100px;">Bergabung di Program Nyanggar.id</h1>
          <div class="row">
            <div class="col-lg-2 col-md-2">
              
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="fitur">
                <h2><a href="<?php echo site_url('ruangles'); ?>"> Ruang Les</a></h2>
                <p>
                  Ingin belajar tari ? Mari cari guru les tari bersama Nyanggar.id
                </p>
              </div>  
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="fitur">
                <h2><a href="<?php echo site_url('ruangpertunjukan'); ?>">Ruang Pertunjukan</a> </h2>
                <p>
                  Pesan jasa pertunjukan tari untuk ramaikan eventmu
                </p>
              </div>  
            </div>
            <div class="col-lg-2 col-md-2">
              
            </div>

          </div>
        </div>
      </section>
      <section id="kota">
        <div class="wrap2">
          <h1 class="judul2" style="margin-top: 50px;">Daftar Daerah</h1>
          
          <div class="row">
            <div class="col-lg-4 col-md-4">
              <div class="kotabox">
                <div class="kotatop">
                  <img src="<?php echo base_url(); ?>assets/images/icon2/bali hitam.png">
                </div>
                <div class="kotabot">
                  <p>Bali</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4">
              <div class="kotabox">
                <div class="kotatop">
                  <img src="<?php echo base_url(); ?>assets/images/icon2/semarang hitam.png" style="width: 190px;margin-top: 0px;">
                </div>
                <div class="kotabot">
                  <p>Jawa Tengah</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4">
              <div class="kotabox">
                <div class="kotatop">
                  <img src="<?php echo base_url(); ?>assets/images/icon2/jakrtahitam.png">
                </div>
                <div class="kotabot">
                  <p>DKI Jakarta</p>
                </div>
              </div>
            </div> 
             
          </div>
          <!--<ul>
            <li>
              
            </li>
            <li></li>
            <li></li>
            <div style="clear: both;">
              
            </div>
          </ul>-->
        </div>
      </section>
@endsection
