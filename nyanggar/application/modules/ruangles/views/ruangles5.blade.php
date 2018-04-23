@layout('master_view')
@section('content')
<section id="les3">
	<div class="wrap2">
		<div class="box2" style="padding-bottom: 50px;margin-bottom: 100px;">
			<div style="width: 100%;
			padding: 20px;background-color: #d8780a;padding-bottom: ">
				<ul class="nav nav-tabs oo" role="tablist" style="width: 60%;">
				  <li ><a href="#home" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'home') { echo 'class="active"'; } ?> >Pilih Rekening</a></li>
				  <li><a href="#profile" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'review') { echo 'class="active"'; } ?>>Review</a></li>
				  <li><a href="#messages" role="tab" data-toggle="tab" <?php if ($pesan['page'] == 'upload') { echo 'class="active"'; } ?>>Upload Bukti Pembayaran</a></li>
				</ul>
			</div>

			<div>
				<div class="tab-content">
				  <div class="tab-pane <?php if ($pesan['page'] == 'home') { echo 'active'; } ?>" id="home">
				  	<div class="wrap">
				  		<div class="wrap" style="margin-top: 40px;">
							<form action="<?php echo site_url('ruangles/bayar2/'.$this->uri->segment('3')); ?>" method="POST">
							<h2><b>Lakukan Pembayaran Atas Pesanan Anda</b></h2>
					  		<b>Pilih Rekening Tujuan</b><br><br>
					  		
					  		@foreach($pesan['bank'] as $key)
					  		<div class="card" style="margin-bottom: 20px;">
							  <div class="card-body">
							    <label><input type="radio" name="rekening"<?php if ($key['id_rekening'] == $pesan['pesanan'][0]['id_rekening_tujuan']) {
							    	echo "checked='checked'";
							    } ?> value="{{$key['id_rekening']}}">  <img src="<?php echo base_url(); ?>assets/images/{{$key['logo']}}" style="width: 50px;margin-left: 10px;"> </label>
							  </div>
							</div>
							@endforeach
							
							<br>
							<input type="submit" name="" value="Bayar" class="btn btn-warning" >
							</form>
					  	</div>
				  	</div>
				  </div>
				  <div class="tab-pane <?php if ($pesan['page'] == 'review') { echo 'active'; } ?>" id="profile">
				  	<div class="wrap" style="padding-top: 30px;">
				  		<b>Petunjuk Pembayaran Transfer</b>
				  		<ol>
				  			<li>
				  				<h4><b> Selesaikan pembayaran sebelum</b></h4>
				  				<div class="card" style="margin-bottom: 20px;">
								  <div class="card-body">
								    <h3 style="color: #555;"><b><?php echo date("D, d-M-Y H:i",strtotime($pesan['pesanan'][0]['maks_pembayaran'])); ?></b></h3>
								  </div>
								</div>
				  			</li>
				  			<li>
				  				<h4><b> Mohon Transfer Ke:</b></h4>
				  				<div class="card" style="margin-bottom: 20px;">
								  <div class="card-header">
								    {{$pesan['pesanan'][0]['nama_bank']}}
								  </div>
								  <div class="card-body">
								  	<p>Nomor Rekening:  {{$pesan['pesanan'][0]['nomor_rekening']}}</p>
								  	<p>Nama Penerima: {{$pesan['pesanan'][0]['nama_pemilik_rekening']}}</p>
								    
								  </div>
								  <div class="card-footer">
								    Jumlah Tranfer: <b><font style="color:#d8780a;">Rp. {{$pesan['pesanan'][0]['jumlah_bayar']}}</font></b> 
								  </div>
								</div>
				  			</li>
				  			<li>
				  				<h4><b>Anda Sudah Membayar ?</b></h4>
				  				<div class="card">
							      <div class="card-body">
							        <p class="card-text">Setelah pembayaran anda dikonfirmasi, penari yang anda pesan akan menghubungi anda</p>
							        <a href="<?php echo site_url('ruangles/bayar3/'.$this->uri->segment('3')); ?>" class="btn btn-primary">Upload Bukti Pembayaran</a>
							      </div>
							    </div>
				  			</li>
				  		</ol>
				  	</div>
				  </div>
				  <div class="tab-pane <?php if ($pesan['page'] == 'upload') { echo 'active'; } ?>" id="messages">
				  	<div class="wrap" style="margin-top: 40px;">
				  		<h3><b>Unggah Bukti Pembayaran</b></h3>
				  		<div class="card" style="margin-bottom: 20px;">
						  <div class="card-body">
						    <h5 class="card-title"><b>Pemesanan Anda Sekarang dalam Tahap</b></h5>
					        <p class="card-text">Menunggu Bukti Pembayaran</p>
						  </div>
						</div>

						<div class="card">
						  <div class="card-body">
						    <p class="card-text">Silahkan upload bukti pembayaran anda untuk mempercepat proses verifikasi</p>
						    <form action="<?php echo site_url('ruangles/bayar4'); ?>" method="POST" enctype="multipart/form-data">
						    <input type="hidden" name="id" value="{{$this->uri->segment('3')}}">
						    <input type="file" name="foto" class="form-control" required><br>
					        <button class="btn btn-primary" type="submit">Upload</button><br> 
					        </form>
					      </div>
						</div>


				  	</div>
				  	
				  </div>


				</div>
			</div>
		</div>
	</div>
</section>
@endsection
