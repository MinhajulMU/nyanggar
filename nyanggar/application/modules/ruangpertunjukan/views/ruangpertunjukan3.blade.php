@layout('master_view')
@section('content')
<section id="pertunjukan">
	<div class="wrap2" style="padding-top: 50px;margin-bottom: 0px;padding-bottom: 0;">
	<div class="box">
		<div style="width: 100%;
			padding: 20px;background-color: #d8780a;width: 100%;">
				<ul class="nav nav-tabs oo" role="tablist" style="border : none;width: 100%;">
				  <li ><a href="#home" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'home') { echo 'class="active"'; } ?> >Data Pesanan</a></li>
				  <li ><a href="#profile" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'profil') { echo 'class="active"'; } ?>>Pilih Rekening</a></li>
				  <li ><a href="#bayar" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'bayar') { echo 'class="active"'; } ?>>Pembayaran</a></li>

				 
				</ul>
		</div>
		<div>
			<div class="tab-content">
				 <div class="tab-pane <?php if ($pesan['page'] == 'home') { echo 'active'; } ?>" id="home">
				 <div style="padding: 10px;padding-top: 20px;">
				 	<h2><b>Data Pesanan {{$pesan['pertunjukan'][0]['nama_pertunjukan']}}</b></h2>
				 	<p>Lengkapi data pemesanan pertunjukan yang anda pesan untuk dapat memudahkan penari melayani pesanan anda.</p><br>
				 	<p>Tanggal Pesan Pertunjukan </p>
				 	<form action="<?php echo site_url('ruangpertunjukan/pesan2/'); ?>" method="POST">

				 		<input type="text" name="tanggal" id="datepicker" class="form-control" required=""
				 		<?php
				  		$tanggal = date('m/d/Y',strtotime($pesan['pertunjukan'][0]['tanggal_acara']));
				  		if ($tanggal != '01/01/1970') {
				  				echo 'value="'.date('m/d/Y',strtotime($pesan['pertunjukan'][0]['tanggal_acara'])).'"';}?> >
				 		<input type="hidden" name="ids" value="{{$pesan['pertunjukan'][0]['id_pesan_pertunjukan']}}">
				 	<p>Lokasi Pesanan</p>
				 	<div class="row" >
					  		<div class="col-lg-6">
					  			<p>Provinsi: </p>
					  			<select class="form-control form-provinsi" id="selectcat" name="provinsi" required>
									<option value="" class="rhth">Select Provinsi</option>
									@foreach($pesan['provinsi'] as $key)
									<option class="p{{$key['id']}}" value="{{$key['id']}}"<?php if ($pesan['pertunjukan'][0]['id_provinsi'] == $key['id']) {
										# code...
										echo "selected";
									}?> >{{$key['name']}}</option>
									@endforeach
								</select>
					  		</div>
					  		<div class="col-lg-6">
					  			<p>Kota:</p>
					  			<select class="form-control form-kabupaten selectcat" id="selectprod" name="kabupaten" required>
									<option value="" class="rhth23">Select Kabupaten</option>
					                @foreach($pesan['kabupaten'] as $key)
					                <option value="{{$key['id']}}" class="p{{$key['province_id']}}" id="k{{$key['id']}}" <?php if ($pesan['pertunjukan'][0]['id_kabupaten'] == $key['id']) {
										# code...
										echo "selected";
									}?> >{{$key['name']}}</option>
					                @endforeach
								</select>
					  			
					  		</div>
					  	</div>
					  	<div style="margin-top: 20px;">
					  		<p>Kecamatan:</p>
					  		<select class="form-control form-kecamatan" id="selectprod2" name="kecamatan" required>
				
				               <option value="" class="rhth23">Select Kecamatan</option>
				               @foreach($pesan['kecamatan'] as $keys)
				               <option value="{{$keys['id']}}" class="selectors  k{{$keys['regency_id']}}" <?php if ($pesan['pertunjukan'][0]['id_kecamatan'] == $keys['id']) {
										# code...
										echo "selected";
									}?> >{{$keys['name']}}</option>
				               @endforeach
				                
							</select>
					  	</div>	
					  	<div style="margin-top: 20px;">
					  		<p>Alamat Lengkap:</p>
					  		<input type="hidden" name="id" value="{{$this->uri->segment('3')}}">
					  		<textarea class="form-control" name="alamat" required>{{$pesan['pertunjukan']['0']['alamat_lengkap']}}</textarea>
					  	</div><br>
					  	<button type="submit" class="btn btn-warning" style="color: #fff;">Selanjutnya</button>
					</form>
				 </div>
				 </div>
				 <div class="tab-pane <?php if ($pesan['page'] == 'profil') { echo 'active'; } ?>" id="profile">
				 <div>
				 	<h2><b>Pilih Rekening Pembayaran</b></h2>
				 	<p>Pilih bank tujuan yang akan anda gunakan untuk melakukan transaksi pemesanan.</p>
				 	<form action="<?php echo site_url('ruangpertunjukan/pesan3'); ?>" method="POST">
				 	<input type="hidden" name="idh" value="{{$pesan['pertunjukan'][0]['id_pesan_pertunjukan']}}">
				 	@foreach($pesan['rekening'] as $key)
				 		<div class="card" style="margin-bottom: 20px;">
							  <div class="card-body">
							    <label><input type="radio" name="rekening"<?php if ($key['id_rekening'] == $pesan['pertunjukan'][0]['id_rekening']) {
							    	# code...
							    	echo "checked='checked'";
							    } ?> value="{{$key['id_rekening']}}">  <img src="<?php echo base_url(); ?>assets/images/{{$key['logo']}}" style="width: 50px;margin-left: 10px;"> </label>
							  </div>
						</div>
				 	@endforeach
				 	<input type="submit" value="Pilih" class="btn btn-warning">
				 	</form>
				 </div>
				 </div>

				 <div class="tab-pane <?php if ($pesan['page'] == 'bayar') { echo 'active'; } ?>" id="bayar">
				 <div>
				 	<br>
				 	<h2 style="margin-left: 20px;"><b>Petunjuk Pembayaran Transfer</b></h2>
				 	<p style="margin-left: 20px;">Ikuti instruksi pembayaran dibawah ini untuk melakukan transaksi pemesanan.</p>
				  		<ol>
				  			<li>
				  				<h4><b> Selesaikan pembayaran sebelum</b></h4>
				  				<div class="card" style="margin-bottom: 20px;">
								  <div class="card-body">
								    <h3 style="color: #555;"><b>{{date('D, d-m-Y',strtotime($pesan['pertunjukan'][0]['maks_pembayaran']))}}</b></h3>
								  </div>
								</div>
				  			</li>
				  			<li>
				  				<h4><b> Mohon Transfer Ke:</b></h4>
				  				<div class="card" style="margin-bottom: 20px;">
								  <div class="card-header">
								    {{$pesan['pertunjukan'][0]['nama_bank']}}
								  </div>
								  <div class="card-body">
								  	<p>Nomor Rekening:  <b>{{$pesan['pertunjukan'][0]['nomor_rekening']}}</b></p>
								  	<p>Nama Penerima: <b>{{$pesan['pertunjukan'][0]['nama_pemilik_rekening']}}</b></p>
								    
								  </div>
								  <div class="card-footer">
								    Jumlah Tranfer: <b><font style="color:#d8780a;">Rp. {{$pesan['pertunjukan'][0]['total_bayar']}}</font></b> 
								  </div>
								</div>
				  			</li>
				  			<li>
				  				<h4><b>Anda Sudah Membayar ?</b></h4>
				  				<div class="card">
							      <div class="card-body">
							        <p class="card-text">Setelah pembayaran anda dikonfirmasi, penari yang anda pesan akan menghubungi anda</p>
							        <form action="<?php echo site_url('ruangpertunjukan/upload'); ?>" method="POST" enctype="multipart/form-data">
							        <input type="file" name="foto" class="form-control">
							        <input type="hidden" name="id" value="{{$pesan['pertunjukan'][0]['id_pesan_pertunjukan']}}"><br>
							        <button type="submit" class="btn btn-warning">Upload</button>
							        </form>
							        
							      </div>
							    </div>
				  			</li>
				  		</ol>
				 </div>
				 </div>

			</div>
		</div>
	</div>
	</div>
</section>
<br><br><br>
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
