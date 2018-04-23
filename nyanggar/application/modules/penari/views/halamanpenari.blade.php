@layout('master_view')
@section('content')
<div class="wrap5">
  <div id="page">
    <div class="row" style="padding-bottom: 30px;">
      <div class="col-lg-4 col-md-4">
        <div id="left">
          <h4 style="font-weight: bold;color: #d8780a;">Dashboard</h4>
          <hr>
           <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab" <?php if (isset($penari['active']) and $penari['active'] == 'home') {
              # code...
              echo "class='active'";
            } ?>> Home</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" <?php if (isset($penari['active']) and $penari['active'] == 'profil') {
              # code...
              echo "class='active'";
            } ?>>Identitas</a></li>
            <li role="presentation"><a href="#bahan" aria-controls="bahan" role="tab" data-toggle="tab" <?php if (isset($penari['active']) and $penari['active'] == 'pelajaran') {
              # code...
              echo "class='active'";
            } ?>>Bahan Ajar</a></li>
            <li role="presentation"><a href="#pertunjukan" aria-controls="pertunjukan" role="tab" data-toggle="tab" <?php if (isset($penari['active']) and $penari['active'] == 'pertunjukan') {
              # code...
              echo "class='active'";
            } ?>>Pertunjukan</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" <?php if (isset($penari['active']) and $penari['active'] == 'ruangles') {
              # code...
              echo "class='active'";
            } ?>>Pesanan Les</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"  <?php if (isset($penari['active']) and $penari['active'] == 'ruangpertunjukan') {
              # code...
              echo "class='active'";
            } ?>>Pesanan Pertunjukan</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-8 col-md-8">
        <div id="right">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane <?php if (isset($penari['active']) and $penari['active'] == 'home') {
              # code...
              echo "active";
            } ?>" id="home">
            <h2><b>Selamat Datang <font style="color: #d8780a;"><?php echo $_SESSION['lstrpnr']['nama']; ?></font></b></h2>
            <p>Selamat datang di panel penari</p>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      Jumlah Les yang di Pesan
                    </div>
                    <div class="card-body">
                      <h2 class="card-title"><?php print_r($penari['jumlahles']); ?> Les</h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      Jumlah Pertunjukan yang di Pesan
                    </div>
                    <div class="card-body">
                      <h2 class="card-title"><?php print_r($penari['jumlahpertunjukan']); ?> Pertunjukan</h2>
                    </div>
                  </div>
                </div>
              </div>


            </div>
            <div role="tabpanel" class="tab-pane <?php if (isset($penari['active']) and $penari['active'] == 'profil') {
              # code...
              echo "active";
            } ?>" id="profile">
              
              <h2>Lengkapi Identitas Anda</h2>
              <p>Identitas anda akan digunakan untuk melakukan verifikasi terhadap profil anda. dengan identitas yang lengkap akan dapat lebih memudahkan anda dalam menawarkan jasa anda kepada client. Identitas yang bagus juga dapat menjadi branding anda kepada client.</p>
               <?php echo $this->session->flashdata('errorsprofil');
                     echo $this->session->flashdata('pesan');
                ?>
               @foreach($penari['user'] as $key)
              <form action="<?php echo site_url('penari/profil'); ?>" method="POST" enctype="multipart/form-data">
                <h4>Nama Lengkap <b style="color: #d8780a;">*</b></h4>
                <input type="hidden" name="id" value="{{$key['id_penari']}}">
                <input type="text" name="nama" class="form-control" required maxlength="50" value="{{$key['nama_lengkap']}}">
                <h4>E-Mail <b style="color: #d8780a;">*</b></h4>
                <input type="email" name="email" class="form-control" required maxlength="50" value="{{$key['email']}}">
                <h4>No HP <b style="color: #d8780a;">*</b></h4>
                <input type="text" name="nohp" class="form-control" required maxlength="50" value="{{$key['nohp']}}">
                <h4>Tanggal Lahir <b style="color: #d8780a;">*</b></h4>
                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="ttl" maxlength="50" value="{{ date('d/m/Y',strtotime($key['tanggal_lahir']))}}">
                <h4>Foto</h4>
                <input type="file" name="foto" class="form-control" maxlength="50">
                <?php 
                  if ($key['foto'] != '') {
                    # code...
                    ?>
                    <br>
                    <img src="<?php echo base_url(); ?>upload/penari/{{$key['foto']}}" width="200px">
                    <?php
                  }
                ?>
                <h4>Jenis Kelamin <b style="color: #d8780a;">*</b></h4>
                <select class="form-control" name="jkel">
                  <option value="Laki-Laki" <?php if ($key['jenis_kelamin'] == 'Laki-Laki') {
                    # code...
                    echo "selected";
                  } ?> >Laki-Laki</option>
                  <option value="Perempuan" <?php if ($key['jenis_kelamin'] == 'Perempuan') {
                    # code...
                    echo "selected";
                  } ?>>Perempuan</option>
                </select>
                <h4>Alamat <b style="color: #d8780a;">*</b></h4>
                <textarea name="alamat" class="form-control" >{{$key['alamat']}}</textarea>
                <h4>Nomor KTP </h4>
                <input type="text" name="nomor" class="form-control" maxlength="50" value="{{$key['nomor_ktp']}}">
                <h4>Nama Bank </h4>
                <input type="text" name="namabank" class="form-control" maxlength="50" value="{{$key['nama_bank']}}">
                <h4>Nomor Rekening </h4>
                <input type="text" name="nomorrekening" class="form-control" maxlength="50" value="{{$key['nomor_rekening']}}">
                <h4>Nama Pemilink Rekening </h4>
                <input type="text" name="namapemilik" class="form-control" maxlength="50" value="{{$key['nama_pemilik_rekening']}}">
                <h4>Tentang Saya </h4>
                <textarea class="form-control" name="tentang">{{$key['tentang_saya']}}</textarea><br>
                <input type="submit" class="btn btn-warning" style="color: #fff;" value="Simpan">
              </form>
              @endforeach
            </div>

            <div role="tabpanel" class="tab-pane <?php if (isset($penari['active']) and $penari['active'] == 'pelajaran') {
              # code...
              echo "active";
            } ?>" id="bahan" >
              <h2>Bahan Ajar Les Tari</h2>
              <p>Lengkapi bahan ajar anda sesuai kemampuan yang anda miliki dibidang tari-tarian. ayo tambah pundi-pundi rezeki dengan mengajar les Tari!</p>
              <?php
              echo $this->session->flashdata('hapusmengajar');
              echo $this->session->flashdata('hapuslokasi');
              echo $this->session->flashdata('pesanpelajaran');
              echo $this->session->flashdata('errors');
              echo $this->session->flashdata('pesanlokasi');
              echo $this->session->flashdata('errorslokasi');
               ?>
              <div class="row">
                <div class="col-lg-6 col-md-6">
                <h4><b>Mata Pelajaran:</b></h4>

                  <ul class="list-group">
                    <?php 
                      if (empty($penari['mengajar'])) {
                        # code...
                        ?>
                        <li class="list-group-item">- 
                        </li>
                        <?php
                      }
                    ?>
                    @foreach($penari['mengajar'] as $key)
                    <li class="list-group-item"><span class="badge badge-success">{{$key['mata_pelajaran']}} </span> <span class="badge badge-warning">Rp. {{$key['fee']}}/jam</span><div class="hapus">
                     <a href="#" data-toggle="modal" data-target="#modalhapus{{$key['id_mengajar']}}" style="color: #d8780a;"> <i class="fa fa-trash"></i></a>
                    </div> 
                    <div style="clear: both;"></div>
                    </li>
                    <div class="modal fade" id="modalhapus{{$key['id_mengajar']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <h4 class="modal-title" id="exampleModalLabel">Konfirmasi</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                             <input type="hidden" name="idhapus" id="idhapus">
                              Apakah anda yakin akan menghapus data ini ?  
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="<?php echo site_url('penari/deletemengajar/'.$key['id_mengajar']); ?>"><button type="submit" class="btn btn-primary">Hapus</button></a> 
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </ul>
                  <br>
                   <button class="btn btn-warning" style="color: #fff;" data-toggle="modal" data-target="#exampleModal">Tambah Mata Pelajaran</button>
                </div>
                <div class="col-lg-6 col-md-6">
                  <h4><b>Lokasi Mengajar:</b></h4>

                  <ul class="list-group">
                    <?php 
                      if (empty($penari['lokasi'])) {
                        # code...
                        ?>
                        <li class="list-group-item">- 
                        </li>
                        <?php
                      }
                    ?>
                    @foreach($penari['lokasi'] as $key)
                    <li class="list-group-item"><span class="badge badge-success">{{$key['nama_kabupaten']}} </span> <span class="badge badge-warning">{{$key['nama_kecamatan']}} </span> <div class="hapus">
                     <a href="#" data-toggle="modal" data-target="#modalhapuslokasi{{$key['id_lokasi_mengajar']}}" style="color: #d8780a;" > <i class="fa fa-trash"></i></a>
                    </div> 
                    <div style="clear: both;"></div>
                    </li>
                    <div class="modal fade" id="modalhapuslokasi{{$key['id_lokasi_mengajar']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <h4 class="modal-title" id="exampleModalLabel">Konfirmasi</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                             <input type="hidden" name="idhapus" id="idhapus">
                              Apakah anda yakin akan menghapus data ini  ?  
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="<?php echo site_url('penari/deletelokasimengajar/'.$key['id_lokasi_mengajar']); ?>"><button type="submit" class="btn btn-primary">Hapus</button></a> 
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    
                  </ul>
                  <br>
                   <button class="btn btn-warning" style="color: #fff;" data-toggle="modal" data-target="#tambahlokasi">Tambah Lokasi Mengajar</button>
                </div>
              </div>
            </div>
<!--pertunjukan ==========================================================================-->
            <div role="tabpanel" class="tab-pane <?php if (isset($penari['active']) and $penari['active'] == 'pertunjukan') {
              # code...
              echo "active";
            } ?>" id="pertunjukan" >
            <br><br>
              <h2>Pertunjukan</h2>
              <p>Lengkapi data pertunjukan anda untuk dapat dipesan dan dilihat oleh jutaan orang diluar sana. tambah jasa pertunjukan yang anda bisa untuk menambah pundi-pundi rupiah </p><br>
              <?php

              if ($this->session->flashdata('errorsupload')) {
                # code...
                  echo $this->session->flashdata('errorsupload');
              }else{
                  echo $this->session->flashdata('hapuspertunjukan');
                  echo $this->session->flashdata('pesanpertunjukan');
                  echo $this->session->flashdata('errorspertunjukan');  
              }
              
              
               ?>
              <button class="btn btn-warning" style="color: #fff;" data-toggle="modal" data-target="#tambahpertunjukan">Tambah Pertunjukan</button>
              <div class="row" style="margin-top: 10px;">
                
                <div class="col-lg-12 col-md-6">
                  
                  @foreach($penari['pertunjukan'] as $key)  
                  <div class="card" style="width: 40%;margin-top: 20px;float: left;margin-right: 20px;">
                    <div class="card-body">
                      <h4 class="card-title"><b>{{$key['nama_pertunjukan']}}</b></h4>
                      <h6 class="card-subtitle mb-2 text-muted">{{$key['nama_kategori']}}</h6>
                      <div class="img">
                        
                          <video class="video-js vjs-default-skin" width="100%" height="162"
                            data-setup='{"controls" : true, "autoplay" : false, "preload" : "auto"}'>
                            <source src="<?php echo base_url(); ?>upload/video/{{$key['video_pertunjukan']}}" type='video/mp4' />
                          </video>
                        
                      </div>
                      <p class="card-text">{{substr($key['detail_pertunjukan'],0,100)}}</p>
                      <h6 class="card-subtitle mb-2 text-muted"><b>Rp. {{$key['fee']}}</b></h6>
                      <a href="#" class="card-link" data-toggle="modal" data-target="#editpertunjukan{{$key['id_pertunjukan']}}">Edit</a>
                      <a href="#" class="card-link" data-toggle="modal" data-target="#modalhapuspertunjukan{{$key['id_pertunjukan']}}">Hapus</a>
                    </div>

                    <div class="modal fade" id="modalhapuspertunjukan{{$key['id_pertunjukan']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <h4 class="modal-title" id="exampleModalLabel">Konfirmasi</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                             <input type="hidden" name="idhapus" id="idhapus">
                              Apakah anda yakin akan menghapus data ini  ?  
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="<?php echo site_url('penari/deletepertunjukan/'.$key['id_pertunjukan']); ?>"><button type="submit" class="btn btn-primary">Hapus</button></a> 
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                  <div class="clear: both;"></div>
                  <div class="modal fade" id="editpertunjukan{{$key['id_pertunjukan']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          
                          <h4 class="modal-title" id="exampleModalLabel">Edit Jasa Pertunjukan</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>

                        </div>
                        <div class="modal-body">
                            <form action="<?php echo site_url('penari/editpertunjukan'); ?>" method="POST" enctype="multipart/form-data">
                            <?php
                            $criteria = array(
                              'id_pertunjukan' => $key['id_pertunjukan']
                              );
                            $pertunjukan = $penari['model']->get_where($criteria,'pertunjukan')->result_array();
                            ?>
                            @foreach($pertunjukan as $key2)
                            <p>Nama Pertunjukan:</p>
                            <input type="hidden" name="id" value="{{$key2['id_pertunjukan']}}">
                            <input type="text" name="nama" class="form-control" required value="{{$key2['nama_pertunjukan']}}">
                            <p>Kategori Pertunjukan</p>
                            <select class="form-control" name="kategori">
                              @foreach($penari['kategori'] as $key)
                              <option value="{{$key['id_kategori_tari']}}" <?php if ($key['id_kategori_tari'] == $key2['id_kategori_tari']) {
                                # code...
                                echo "selected";
                              } ?>>{{$key['nama_kategori']}}</option>
                              @endforeach
                            </select>
                            <p>Video Pertunjukan  <b style="color: #d8780a;font-size: 60%;">*.MP4 < 20 MB</b></p>
                            <input type="file" name="video" class="form-control">
                            <br>
                            <video class="video-js vjs-default-skin" width="50%" height="162"
                            data-setup='{"controls" : true, "autoplay" : false, "preload" : "auto"}'>
                              <source src="<?php echo base_url(); ?>upload/video/{{$key2['video_pertunjukan']}}" type='video/mp4' />
                            </video>
                            <p>Deskripsi Pertunjukan</p>
                            <textarea class="form-control" name="deskripsi" required>{{substr($key2['detail_pertunjukan'],9)}}</textarea>
                            <p>Fee Pertunjukan (Rupiah)</p>
                            <input type="number" name="fee" class="form-control" required value="{{$key2['fee']}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          </form>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>

                  @endforeach
                </div>




              </div>
            </div>
<!--/pertunjukan ==========================================================================-->
            
            <div role="tabpanel" class="tab-pane <?php if (isset($penari['active']) and $penari['active'] == 'ruangles') {
              # code...
              echo "active";
            } ?>" id="messages" >
              <h2><b>Pesanan Les Tari</b></h2>
              <p>Ayo cek daftar yang memesan jasa les tari dari dirimu, buat dirimu lebih produktif, cek juga status pesanananya.</p>
              <table class="table table-striped table-hover">
                <tr>
                  <th>Nama Client</th>
                  <th>Mata Pelajaran</th>
                  <th>Status Pesanan</th>
                  <th>Status Pembayaran</th>
                  <th colspan="3">Aksi</th>
                </tr>
                @foreach($penari['les'] as $key)
                <tr>
                  <td>{{$key['nama_lengkap']}}</td>
                  <td>{{$key['mata_pelajaran']}}</td>
                  <td>
                  <span class="badge <?php if ($key['status_pesan'] == 'ditolak') {
                    # code...
                    echo "badge-danger";
                  }else{
                    echo "badge-success";
                    } ?>">{{$key['status_pesan']}}</span></td>
                    <td>
                      <?php
                      if ($key['status_pembayaran'] == 'belum_bayar') {
                        # code...
                        ?>
                        <span class="badge badge-danger">{{$key['status_pembayaran']}}</span>
                        <?php
                      }elseif ($key['status_pembayaran'] == 'menunggu_validasi') {
                        # code...
                        ?>
                        <span class="badge badge-warning">{{$key['status_pembayaran']}}</span>
                        <?php
                      }else{
                        ?>
                        <span class="badge badge-success">{{$key['status_pembayaran']}}</span>
                        <?php
                      }
                       ?>
                      
                    </td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#les{{$key['id_pesan_les']}}"><button class="btn btn-default">Detail</button></a> </td>
                    <?php
                      if ($key['status_pembayaran'] != 'verified') {
                        # code...
                        ?>
                  <td><a href="#"><button class="btn btn-secondary">Terima</button></a></td>
                  <td><a href="#"><button class="btn btn-secondary">Tolak</button></a></td>
                        <?php
                      }else{
                    ?>
                  <td><a href="<?php echo site_url('penari/accept/'.$key['id_pesan_les']); ?>"><button class="btn btn-warning">Terima</button></a></td>
                  <td><a href="<?php echo site_url('penari/tolak/'.$key['id_pesan_les']); ?>"><button class="btn btn-danger">Tolak</button></a></td>
                  <?php
                    }
                  ?>
                </tr>
<div class="modal fade" id="les{{$key['id_pesan_les']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="exampleModalLabel">Detail Pesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row">
            <div class="col-lg-4 col-md-4">Nama Penari</div>
            <div class="col-lg-8 col-md-8">: <b>{{$key['nama_lengkap']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Mata Pelajaran</div>
           <div class="col-lg-8 col-md-8">: <b>{{$key['mata_pelajaran']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Jumlah Pertemuan</div>
           <div class="col-lg-8 col-md-8">: <b>{{$key['jumlah_pertemuan_minimal']}} Pertemuan</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Durasi Pertemuan</div>
           <div class="col-lg-8 col-md-8">: <b>{{$key['durasi_per_pertemuan']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Tanggal Pertemuan Pertama</div>
           <div class="col-lg-8 col-md-8">: <b>{{date("D, d-m-y", strtotime($key['tanggal_pertemuan_pertama'])) }}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Jumlah Pembayaran</div>
           <div class="col-lg-8 col-md-8">: <b>Rp. {{$key['jumlah_bayar']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Alamat</div>
           <div class="col-lg-8 col-md-8">: {{$key['alamat']}}</div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Pesan Client</div>
           <div class="col-lg-8 col-md-8">: {{$key['pesan']}}</div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>

                @endforeach
              </table>
            </div>
<!--/Ruang Les ==========================================================================-->
            <div role="tabpanel" class="tab-pane <?php if (isset($penari['active']) and $penari['active'] == 'ruangpertunjukan') {
              # code...
              echo "active";
            } ?>" id="settings">
  <h2><b>Pesanan Pertunjukan</b></h2>
              <p>Ayo cek daftar yang memesan jasa pertunjukan dari dirimu, buat dirimu lebih produktif, cek juga status pesanananya. </p>
              <table class="table table-striped table-hover">
                <tr>
                  <th>Nama Client</th>
                  <th>Nama Pertunjukan</th>
                  <th>Status Pemesanan</th>
                  <th>Status Pembayaran</th>

                  <th colspan="3">Aksi</th>
                </tr>
                @foreach($penari['pertunjukan2'] as $key)
                <tr>
                  <td>{{$key['nama_lengkap']}}</td>
                  <td>{{$key['nama_pertunjukan']}}</td>
                  <td>
                    <span class="badge <?php if ($key['status_pesan'] == 'ditolak') {
                    # code...
                    echo "badge-danger";
                  }else{
                    echo "badge-success";
                    } ?>">{{$key['status_pesan']}}</span>
                  </td>
                  <td><?php
                      if ($key['status_pembayaran'] == 'belum_bayar') {
                        # code...
                        ?>
                        <span class="badge badge-danger">{{$key['status_pembayaran']}}</span>
                        <?php
                      }elseif ($key['status_pembayaran'] == 'menunggu_validasi') {
                        # code...
                        ?>
                        <span class="badge badge-warning">{{$key['status_pembayaran']}}</span>
                        <?php
                      }else{
                        ?>
                        <span class="badge badge-success">{{$key['status_pembayaran']}}</span>
                        <?php
                      }
                       ?></td>
                  <td><a href="#" data-toggle="modal" data-target="#pertunjukan{{$key['id_pesan_pertunjukan']}}"><button class="btn btn-default">Detail</button></a> </td>
                  <?php
                      if ($key['status_pembayaran'] != 'verified') {
                        # code...
                        ?>
                  <td><a href="#"><button class="btn btn-secondary">Terima</button></a></td>
                  <td><a href="#"><button class="btn btn-secondary">Tolak</button></a></td>
                        <?php
                      }else{
                    ?>
                  <td><a href="<?php echo site_url('penari/acceptpertunjukan/'.$key['id_pesan_pertunjukan']); ?>"><button class="btn btn-warning">Terima</button></a></td>
                  <td><a href="<?php echo site_url('penari/tolakpertunjukan/'.$key['id_pesan_pertunjukan']); ?>"><button class="btn btn-danger">Tolak</button></a></td>
                  <?php
                    }
                  ?>
                </tr>

<div class="modal fade" id="pertunjukan{{$key['id_pesan_pertunjukan']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="exampleModalLabel">Detail Pesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-4 col-md-4">Nama Pemesan</div>
            <div class="col-lg-8 col-md-8">: <b>{{$key['nama_lengkap']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Kontak Pemesan</div>
           <div class="col-lg-8 col-md-8">: <b>{{$key['nohp']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Mata Pertunjukan</div>
           <div class="col-lg-8 col-md-8">: <b>{{$key['nama_pertunjukan']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Tanggal Acara</div>
           <div class="col-lg-8 col-md-8">: <b>{{date("D, d-m-y", strtotime($key['tanggal_acara'])) }}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Jumlah Pembayaran</div>
           <div class="col-lg-8 col-md-8">: <b>Rp. {{$key['total_bayar']}}</b></div>
          </div>
          <div class="row" style="margin-top: 10px;">
           <div class="col-lg-4 col-md-4">Alamat Lengkap</div>
           <div class="col-lg-8 col-md-8">: 
            Provinsi {{$key['nama_provinsi']}}<br>
            Kabupaten {{$key['nama_kabupaten']}}<br>
            Kecamatan {{$key['nama_kecamatan']}}<br>
            Alamat Lengkap
           {{$key['alamat']}}</div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>
                @endforeach
              </table>

            </div>
<!--/Ruang PErtunjukan ==========================================================================-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="<?php echo site_url('penari/pelajaran'); ?>" method="POST">
          <p>Mata Pelajaran Tari</p>
          <input type="text" name="mata" class="form-control" >
          <p>Kategori Tari</p>
          <select class="form-control" name="kategori">
            @foreach($penari['kategori'] as $kategori)
            <option value="{{$kategori['id_kategori_tari']}}">{{$kategori['nama_kategori']}}</option>
            @endforeach
          </select>
          <p>Tarif Per Jam (Rupiah):</p>
          <input type="number" name="tarif" class="form-control">
          <p>Jumlah Pertemuan Minimal</p>
          <input type="number" name="jumlah" class="form-control">
          <p>Deskripsi</p>
          <textarea class="form-control" name="deskripsi"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="tambahpertunjukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="exampleModalLabel">Tambah Jasa Pertunjukan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="<?php echo site_url('penari/pertunjukan'); ?>" method="POST" enctype="multipart/form-data">
          <p>Nama Pertunjukan:</p>
          <input type="text" name="nama" class="form-control" required>
          <p>Kategori Pertunjukan</p>
          <select class="form-control" name="kategori">
            @foreach($penari['kategori'] as $key)
            <option value="{{$key['id_kategori_tari']}}">{{$key['nama_kategori']}}</option>
            @endforeach
          </select>
          <p>Video Pertunjukan  <b style="color: #d8780a;font-size: 60%;">*.MP4 < 20 MB</b></p>
          <input type="file" name="video" class="form-control" required>
          <p>Deskripsi Pertunjukan</p>
          <textarea class="form-control" name="deskripsi" required></textarea>
          <p>Fee Pertunjukan (Rupiah)</p>
          <input type="number" name="fee" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tambahlokasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="exampleModalLabel">Tambah Lokasi Mengajar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="<?php echo site_url('penari/lokasi'); ?>" method="POST">
          <p>Provinsi:</p>
          <div class="prodselectbox">
              <div class="floatleft catid">
                  <select id="selectcat" name="provinsi" class="form-control">
                      <option value="" class="rhth">Select Provinsi</option>
                      @foreach($penari['provinsi'] as $key)
                      <option class="p{{$key['id']}}" value="{{$key['id']}}">{{$key['name']}}</option>
                      @endforeach()
                  </select>
              </div>
          </div>
          <p>Kabupaten:</p>
              <div class="floatleft selectarticle" > 
                  <select id="selectprod" name="kabupaten" class="form-control selectcat">
                      <option value="" class="rhth23">Select Kabupaten</option>
                      @foreach($penari['kabupaten'] as $key)
                      <option value="{{$key['id']}}" class="p{{$key['province_id']}}" id="k{{$key['id']}}">{{$key['name']}}</option>
                      @endforeach
                  </select>
              </div>
          <p>Kecamatan</p>
              <div class="floatleft selectarticle" > 
                  <select id="selectprod2" name="kecamatan" class="form-control">
                      <option value="" class="rhth23">Select Kecamatan</option>
                      @foreach($penari['kecamatan'] as $keys)
                      <option value="{{$keys['id']}}" class="selectors  k{{$keys['regency_id']}}">{{$keys['name']}}</option>
                      @endforeach
                  </select>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
      $(document).ready(function () {    
        var allOptions = $('#selectprod option')
        $('#selectcat').change(function () {
            $('#selectprod option').remove()
            var classN = $('#selectcat option:selected').prop('class');
            var opts = allOptions.filter('.' + classN);
            $.each(opts, function (i, j) {
                $(j).appendTo('#selectprod');
            });
        });
    });
    </script>
    <script type="text/javascript">
      $(document).ready(function () {    
        var allOptions = $('#selectprod2 option')
        $('.selectcat').change(function () {
            $('#selectprod2 option').remove()
            var classN = $('.selectcat option:selected').prop('id');
            var opts = allOptions.filter('.' + classN);
            $.each(opts, function (i, j) {
                $(j).appendTo('#selectprod2');
            });
        });
    });
    </script>
@endsection

