@layout('master_view')
@section('content')
<section id="les3">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-8">
				<div class="box">
					<div class="row">
						<div class="col-lg-3">
							<div class="gamp">
								<?php
										if ($isi['profil'][0]['foto'] != '') {
											# code...
											?>
									<img src="<?php echo base_url(); ?>upload/penari/{{$isi['profil'][0]['foto']}}">
											<?php
										}else{
									?>
									<img src="<?php echo base_url(); ?>assets/images/Torchic.png">
									<?php
										}
									?>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="prof">
								<h2 style="font-weight: bold;">{{$isi['profil'][0]['nama_lengkap']}}</h2>
								<p>{{$isi['profil'][0]['tentang_saya']}}</p><br>
								<h3 style="font-weight: bold;">Alamat:</h3>
								<p>{{$isi['profil'][0]['alamat']}}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="box" style="margin-top: 20px;margin-bottom: 50px;">
					<div class="row">
						<div class="col-lg-9">
							<h2 style="font-weight: bold;padding: 0;margin-bottom: 0;">{{$isi['profil'][0]['mata_pelajaran']}}</h2>
							<p style="margin: 0;padding: 0;font-size: 90%;">{{$isi['profil'][0]['nama_kategori']}}</p>
							<p>{{$isi['profil'][0]['detail']}}</p>		
						</div>
						<div class="col-lg-3">
							<p style="font-weight: bold;color: #666;margin: 0;margin-top: 40%;">Harga:</p>
							<h4 style="color: #d8780a;font-weight: bold;margin: 0;padding: 0;">Rp. {{$isi['profil'][0]['fee']}} / Jam</h4>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-lg-4">
				<div class="box">
					<h2 style="font-weight: bold;">Pesan Guru</h2>
					<p>Tetarik dengan profil dan portofolio guru ? ayo pesan dan belajar bareng si dia.</p>
					<a href="<?php echo site_url('ruangles/insert_pesanan/'.$isi['profil'][0]['id_mengajar']); ?>"><button class="btn btn-warning btn-lg" style="color: #fff;" >Pesan Guru</button></a> 
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
