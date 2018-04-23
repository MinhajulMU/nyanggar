@layout('master_view')
@section('content')
<section id="les3">
	<div class="wrap2">
		<div class="box2" style="padding-bottom: 50px;margin-bottom: 100px;">
			<div style="width: 100%;
			padding: 20px;background-color: #d8780a;padding-bottom: ">
				<ul class="nav nav-tabs oo" role="tablist">
				  <li ><a href="#home" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'home') { echo 'class="active"'; } ?> >Data Belajar</a></li>
				  <li><a href="#profile" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'jadwal') { echo 'class="active"'; } ?>>Jadwal</a></li>
				  <li><a href="#messages" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'lokasi') { echo 'class="active"'; } ?>>Lokasi</a></li>
				 
				</ul>
			</div>

			<div>
				<div class="tab-content">
				  <div class="tab-pane <?php if ($pesan['page'] == 'home') { echo 'active'; } ?>" id="home">
				  	<form action="<?php echo site_url('ruangles/detailpesanan'); ?>" method="POST">
				  	<div class="wrap">
				  		<h3><b>Lengkapi Data Pemesanan Anda</b></h3>
				  		<p>Lengkapi data pemesanan anda untuk dapat memberikan info pemesanan yang detail kepada penari yang akan anda pesan. </p>
				  		<h4><b>Detail Guru</b></h4>
				  		<div class="rounded" style="padding: 20px;border: solid 1px #ddd; ">
				  			<div class="row">
				  				<div class="col-lg-2">
				  					<div class="img" style="width: 100%;height: 100px; overflow: hidden;">
				  						<?php
										if ($pesan['pesanan'][0]['foto'] != '') {
											# code...
												?>
										<img src="<?php echo base_url(); ?>upload/penari/{{$pesan['pesanan'][0]['foto']}}" width="100%">
												<?php
											}else{
										?>
										<img src="<?php echo base_url(); ?>assets/images/Torchic.png">
										<?php
											}
										?>
				  					</div>

				  				</div>
				  				<div class="col-lg-10">
				  					<h4><b>{{$pesan['pesanan'][0]['nama_lengkap']}}</b></h4>
				  					<p>{{$pesan['pesanan'][0]['tentang_saya']}}</p>
				  				</div>
				  			</div>
				  		</div>
				  		<div>

				  			<h4><b>Mata Pelajaran</b></h4>
				  			<h4 style="color:#d8780a;margin-top: -15px; "><b>{{$pesan['pesanan'][0]['mata_pelajaran']}} Rp. {{$pesan['pesanan'][0]['fee']}}/Jam</b></h4>
				  		</div>
				  		<div class="row">

				  			<div class="col-lg-6">
				  				<input type="hidden" name="id" value="{{$this->uri->segment('3')}}">
				  				<b>Durasi Per Pertemuan : </b>

				  				<select class="form-control" name="durasi">
				  					
				  					<option value="1" <?php if ($pesan['pesanan'][0]['durasi_per_pertemuan'] == '1') {echo "selected";} ?>>1 Jam</option>
				  					<option value="2" <?php if ($pesan['pesanan'][0]['durasi_per_pertemuan'] == '2') {echo "selected";} ?>>2 Jam</option>
				  					<option value="3" <?php if ($pesan['pesanan'][0]['durasi_per_pertemuan'] == '3') {echo "selected";} ?>>3 Jam</option>
				  					<option value="4" <?php if ($pesan['pesanan'][0]['durasi_per_pertemuan'] == '4') {echo "selected";} ?>>4 Jam</option>
				  					<option value="5" <?php if ($pesan['pesanan'][0]['durasi_per_pertemuan'] == '5') {echo "selected";} ?>>5 Jam</option>
				  					
				  				</select>
				  			</div>
				  			<div class="col-lg-6">
				  				<b>Jumlah Pertemuan: </b>
				  				<select class="form-control" name="jumlah">
				  					<?php
				  						for ($i=$pesan['pesanan'][0]['jumlah_pertemuan']; $i < $pesan['pesanan'][0]['jumlah_pertemuan']+5; $i++) { 
				  							# code...
				  							?>
				  							<option value="{{$i}}" <?php if ($pesan['pesanan'][0]['jumlah_pertemuan_minimal'] == $i) {echo "selected";} ?>>{{$i}}</option>
				  							<?php
				  						}
				  					?>	
				  				</select>
				  			</div>
				  		</div>
				  		<div><br>
				  			<b>Pesan Tambahan</b>
				  			<textarea class="form-control" name="pesan">{{$pesan['pesanan'][0]['pesan']}}</textarea>
				  		</div><br>
				  		<button class="btn btn-warning" style="color: #fff;" type="submit">Selanjutnya</button>
				  	</div>
				  	</form>
				  </div>
				  <div class="tab-pane <?php if ($pesan['page'] == 'jadwal') { echo 'active'; } ?>" id="profile" >
				  	<div class="wrap" style="padding-top: 30px;">
				  		<form action="<?php echo site_url('ruangles/detailjadwal'); ?>" method="POST">
				  		<b>Tanggal Pertemuan Pertama:</b><br><br>
				  		<input type="text" name="tanggal" class="form-control" id="datepicker" required 
				  		<?php
				  		$tanggal = date('m/d/Y',strtotime($pesan['pesanan'][0]['tanggal_pertemuan_pertama']));
				  		if ($tanggal != '01/01/1970') {
				  				echo 'value="'.date('m/d/Y',strtotime($pesan['pesanan'][0]['tanggal_pertemuan_pertama'])).'"';}?>
				  		
				  		><br>
				  		<b>Waktu Pertemuan Pertama:</b><br><br>
				  		<input type="hidden" name="id" value="{{$this->uri->segment('3')}}">
				  		<select class="form-control" name="waktu">
				  			<option value="Pagi (09:00 - 14:00)" <?php if ($pesan['pesanan'][0]['waktu_pertemuan_pertama'] == 'Pagi (09:00 - 14:00)') { echo "selected";} ?>>Pagi (09:00 - 14:00)</option>
				  			<option value="Siang (14:00 - 18:00)" <?php if ($pesan['pesanan'][0]['waktu_pertemuan_pertama'] == 'Siang (14:00 - 18:00)') { echo "selected";} ?>>Siang (14:00 - 18:00)</option>
				  			<option value="Malam (18:00 - 22:00)" <?php if ($pesan['pesanan'][0]['waktu_pertemuan_pertama'] == 'Malam (18:00 - 22:00)') { echo "selected";} ?>>Malam (18:00 - 22:00)</option>
				  		</select><br>
				  		<input type="submit" name="lokasi" value="Selanjutnya" class="btn btn-warning" style="color: #fff;">
				  		</form>
				  	</div>
				  </div>
				  <div class="tab-pane <?php if ($pesan['page'] == 'lokasi') { echo 'active'; } ?>" id="messages">
				  	<div class="wrap">
				  	<form action="<?php echo site_url('ruangles/detaillokasi'); ?>" method="POST">
				  		<div class="row" style="margin-top: 40px;">
					  		<div class="col-lg-6">
					  			<p>Provinsi: </p>
					  			<select class="form-control form-provinsi" id="selectcat" name="provinsi" required>
									<option value="" class="rhth">Select Provinsi</option>
									@foreach($pesan['provinsi'] as $key)
									<option class="p{{$key['id']}}" value="{{$key['id']}}" <?php if ($pesan['pesanan'][0]['id_provinsi'] == $key['id']) { echo "selected";} ?>>{{$key['name']}}</option>
									@endforeach
								</select>
					  		</div>
					  		<div class="col-lg-6">
					  			<p>Kota:</p>
					  			<select class="form-control form-kabupaten selectcat" id="selectprod" name="kabupaten" required>
									<option value="" class="rhth23">Select Kabupaten</option>
					                @foreach($pesan['kabupaten'] as $key)
					                <option value="{{$key['id']}}" class="p{{$key['province_id']}}" id="k{{$key['id']}}" <?php if ($pesan['pesanan'][0]['id_kabupaten'] == $key['id']) { echo "selected";} ?>>{{$key['name']}}</option>
					                @endforeach
								</select>
					  			
					  		</div>
					  	</div>
					  	<div style="margin-top: 20px;">
					  		<p>Kecamatan:</p>
					  		<select class="form-control form-kecamatan" id="selectprod2" name="kecamatan" required>
				
				               <option value="" class="rhth23">Select Kecamatan</option>
				               @foreach($pesan['kecamatan'] as $keys)
				               <option value="{{$keys['id']}}" class="selectors  k{{$keys['regency_id']}}" <?php if ($pesan['pesanan'][0]['id_kecamatan'] == $keys['id']) { echo "selected";} ?>>{{$keys['name']}}</option>
				               @endforeach
				                
							</select>
					  	</div>	
					  	<div style="margin-top: 20px;">
					  		<p>Alamat Lengkap:</p>
					  		<input type="hidden" name="id" value="{{$this->uri->segment('3')}}">
					  		<textarea class="form-control" name="alamat" required></textarea>
					  	</div><br>
					  	<button class="btn btn-warning" style="color: #fff;">Selanjutnya</button>
				  	</div>
				  	</form>
				  </div>
				  <div class="tab-pane" id="settings">
				  	
				  </div>

				</div>
			</div>
		</div>
	</div>
</section>

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
