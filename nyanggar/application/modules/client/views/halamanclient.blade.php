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
            <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab" <?php if (isset($client['active']) and $client['active'] == 'home') {
              # code...
              echo "class='active'";
            } ?>> Home</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" <?php if (isset($client['active']) and $client['active'] == 'profil') {
              # code...
              echo "class='active'";
            } ?>>Identitas</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" <?php if (isset($client['active']) and $client['active'] == 'ruangles') {
              # code...
              echo "class='active'";
            } ?>>Ruang Les</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" <?php if (isset($client['active']) and $client['active'] == 'pertunjukan') {
              # code...
              echo "class='active'";
            } ?>>Ruang Pertunjukan</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-8 col-md-8">
        <div id="right">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane <?php if (isset($client['active']) and $client['active'] == 'home') {
              # code...
              echo "active";
            } ?>" id="home">
              <h2><b>Selamat Datang <font style="color: #d8780a;"><?php echo $_SESSION['lstrclnt']['nama']; ?></b> </font></h2>
              <div style="margin-left: 10px;">
              <div class="row" style="margin-top: 20px;">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      Jumlah Les yang anda Pesan
                    </div>
                    <div class="card-body">
                      <h2 class="card-title"><?php print_r($client['jumlahles']); ?> Les</h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      Jumlah Pertunjukan yang anda Pesan
                    </div>
                    <div class="card-body">
                      <h2 class="card-title"><?php print_r($client['jumlahpertunjukan']); ?> Pertunjukan</h2>
                    </div>
                  </div>
                </div>
              </div>
              </div>


            </div>
            <div role="tabpanel" class="tab-pane <?php if (isset($client['active']) and $client['active'] == 'profil') {
              # code...
              echo "active";
            } ?>" id="profile">
              <h2>Lengkapi Identitas Anda</h2>
              <p>Silahkan lengkapi identitas anda selengkap-lengkapnya. hal tersebut dapat memudahkan anda dalam bertransaksi dan beraktifitas di website LesTari.</p>
              <?php echo $this->session->flashdata('errorsclient');
                     echo $this->session->flashdata('pesan');
                ?>
              <form action="<?php echo site_url('client/profil'); ?>" method="POST" enctype="multipart/form-data">
                @foreach($client['user'] as $key)
                <h4>Nama Lengkap <b style="color: #d8780a;">*</b></h4>
                <input type="text" name="nama" required class="form-control" value="{{$key['nama_lengkap']}}">
                <h4>Tanggal Lahir <b style="color: #d8780a;">*</b></h4>
                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="ttl" maxlength="50"  value="{{ date('d/m/Y',strtotime($key['ttl']))}}">
                <h4>E-Mail <b style="color: #d8780a;">*</b></h4>
                <input type="email" name="email" required class="form-control" value="{{$key['email']}}">
                <h4>No HP <b style="color: #d8780a;">*</b></h4>
                <input type="text" name="nohp" required class="form-control" value="{{$key['nohp']}}">
                <h4>Foto</h4>
                <input type="file" name="foto" class="form-control">
                <?php 
                  if ($key['foto'] != '') {
                    # code...
                    ?>
                    <br>
                    <img src="<?php echo base_url(); ?>upload/client/{{$key['foto']}}" width="200px">
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
                <textarea class="form-control" name="alamat">
                  {{$key['alamat']}}
                </textarea>
                <h4>Tentang Saya</h4>
                <textarea class="form-control" name="tentang">
                  {{$key['tentang_saya']}}
                </textarea><br>
                <input type="submit" name="" value="Simpan" class="btn btn-warning" style="color: #fff;">
                @endforeach
              </form>
            </div>
            <div role="tabpanel" class="tab-pane <?php if (isset($client['active']) and $client['active'] == 'ruangles') {
              # code...
              echo "active";
            } ?>" id="messages" >
            
              <h2><b>Ruang Les Tari</b></h2>
              <p>Berisi daftar-daftar les tari yang anda pesan sebelumnya, anda dapat memantau perkembangan transaksi les anda disini.</p>

              <table class="table table-striped table-hover">
                <tr>
                  <th>Nama Penari</th>
                  <th>Mata Pelajaran</th>
                  <th>Status Pemesanan</th>
                  <th>Status Pembayaran</th>
                  <th colspan="2">Aksi</th>
                </tr>
                @foreach($client['pesanan'] as $key)
                <tr>
                  <td>{{$key['nama_lengkap']}}</td>
                  <td>{{$key['mata_pelajaran']}}</td>
                  <td>

                    <span class="badge badge-warning">{{$key['status_pesan']}}</span></td>
                  <td>
                    <?php
                    if ($key['status_pembayaran'] == 'belum_bayar') {
                      ?>
                      <a href="<?php echo site_url('ruangles/bayar/'.$key['id_pesan_les']); ?>"><button class="btn btn-danger">Bayar</button></a>
                      <?php
                    }else{
                      ?>
                      <span class="badge badge-warning">{{$key['status_pembayaran']}}</span>
                      <?php
                    }
                    ?>
                    </td>
                  <td><button class="btn btn-default"  data-toggle="modal" data-target="#modal{{$key['id_pesan_les']}}" >Detail</button> </td>
                  <td>
                    <?php
                      if ($key['status_pesan'] == 'diterima') {
                        # code...
                        ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalselesailes{{$key['id_pesan_les']}}">Akhiri Les</button> 
                        <?php
                      }else{
                        ?>
                        <button class="btn btn-secondary">Akhiri Les</button> 
                        <?php
                      }
                    ?>
                    </td>
                </tr>
                <div class="modal fade" id="modalselesailes{{$key['id_pesan_les']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
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
                              Apakah anda yakin akan mengahiri les ini  ? jika anda mengahiri les ini selanjutnya pembayaran akan disalurkan kepada penari. 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="<?php echo site_url('client/akhiriles/'.$key['id_pesan_les']); ?>"><button type="submit" class="btn btn-primary">Akhiri</button></a> 
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                <div class="modal fade" id="modal{{$key['id_pesan_les']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <h4 class="modal-title" id="exampleModalLabel">Detail Transaksi</h4>
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
                               <div class="col-lg-4 col-md-4">Tanggal Pertemuan Pertama</div>
                               <div class="col-lg-8 col-md-8">: <b>{{date("D, d-m-Y", strtotime($key['tanggal_pertemuan_pertama']))}}</b></div>
                             </div>
                             <div class="row" style="margin-top: 10px;">
                               <div class="col-lg-4 col-md-4">Waktu Pertemuan Pertama</div>
                               <div class="col-lg-8 col-md-8">: <b>{{$key['waktu_pertemuan_pertama']}}</b></div>
                             </div>
                             <div class="row" style="margin-top: 10px;">
                               <div class="col-lg-4 col-md-4">Jumlah Pertemuan Minimal</div>
                               <div class="col-lg-8 col-md-8">: <b>{{$key['jumlah_pertemuan_minimal']}} Pertemuan</b></div>
                             </div>
                             <div class="row" style="margin-top: 10px;">
                               <div class="col-lg-4 col-md-4">Total Pembayaran</div>
                               <div class="col-lg-8 col-md-8">: <b>Rp. {{$key['jumlah_bayar']}}</b></div>
                             </div>
                             <div class="row" style="margin-top: 10px;">
                               <div class="col-lg-4 col-md-4">Pesan</div>
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
            <div role="tabpanel" class="tab-pane <?php if (isset($client['active']) and $client['active'] == 'pertunjukan') {
              # code...
              echo "active";
            } ?>" id="settings">
              <h2><b>Ruang Pertunjukan</b></h2>
              <p>Berisi daftar-daftar jasa pertunjukan yang anda pesan sebelumnya, anda dapat memantau perkembangan transaksi les anda disini.</p>

              <table class="table table-striped table-hover">
                <tr>
                  <th>Nama Penari</th>
                  <th>Nama Pertunjukan</th>
                  <th>Status Pembayaran</th>
                  <th>Status Pemesanan</th>
                  <th colspan="2">Aksi</th>
                </tr>
                @foreach($client['pertunjukan'] as $key)
                <tr>
                  <td>{{$key['nama_lengkap']}}</td>
                  <td>{{$key['nama_pertunjukan']}}</td>
                  <td>
                    <?php
                    if ($key['status_pembayaran'] == 'belum_bayar') {
                      ?>
                      <a href="<?php echo site_url('ruangpertunjukan/view_pembayaran/'.$key['id_pesan_pertunjukan']); ?>"><button class="btn btn-danger">Bayar</button></a> 
                      <?php
                    }elseif($key['status_pembayaran'] == 'menunggu_validasi'){
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
                  <td><span class="badge badge-warning">{{$key['status_pesan']}}</span></td>
                  <td><button class="btn btn-default" data-toggle="modal" data-target="#modalp{{$key['id_pesan_pertunjukan']}}">Detail</button> </td>
                  <td><?php
                      if ($key['status_pesan'] == 'diterima') {
                        # code...
                        ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalselesaipertunjukan{{$key['id_pesan_pertunjukan']}}">Akhiri Pertunjukan</button> 
                        <?php
                      }else{
                        ?>
                        <button class="btn btn-secondary">Akhiri Pertunjukan</button> 
                        <?php
                      }
                    ?></td>
                </tr>
                <div class="modal fade" id="modalselesaipertunjukan{{$key['id_pesan_pertunjukan']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
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
                              Apakah anda yakin akan mengahiri les ini  ? jika anda mengahiri les ini selanjutnya pembayaran akan disalurkan kepada penari. 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="<?php echo site_url('client/akhiripertunjukan/'.$key['id_pesan_pertunjukan']); ?>"><button type="submit" class="btn btn-primary">Akhiri</button></a> 
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="modalp{{$key['id_pesan_pertunjukan']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <h4 class="modal-title" id="exampleModalLabel">Detail Transaksi</h4>
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
                               <div class="col-lg-4 col-md-4">Kontak Penari</div>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
