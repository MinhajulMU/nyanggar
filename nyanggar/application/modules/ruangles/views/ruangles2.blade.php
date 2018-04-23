@layout('master_view')
@section('content')
<section id="judul4">
	<div class="wrap">
		<h4>Daftar Guru Les Tari </h4>
	</div>
</section>
<section id="les2">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-3">
				<div class="menu2">
					<ul class="list-group">
   					  <li class="list-group-item"><a href="<?php echo site_url('ruangles/searchpenari/5'); ?>"  <?php if ($this->les['kategori'] =='5') {echo "class='active'";} ?>>
   					  	Semua</a></li>
					  <li class="list-group-item"><a href="<?php echo site_url('ruangles/searchpenari/4'); ?>" <?php if ($this->les['kategori'] =='4') {echo "class='active'";} ?>>Tari Tradisional</a></li>
					  <li class="list-group-item"><a href="<?php echo site_url('ruangles/searchpenari/3'); ?>" <?php if ($this->les['kategori'] =='3') {echo "class='active'";} ?>>Tari Klasik</a></li>
					  <li class="list-group-item"><a href="<?php echo site_url('ruangles/searchpenari/2'); ?>" <?php if ($this->les['kategori'] =='2') {echo "class='active'";} ?>>Tari Kreasi</a></li>
					  <li class="list-group-item"><a href="<?php echo site_url('ruangles/searchpenari/1'); ?>" <?php if ($this->les['kategori'] =='1') {echo "class='active'";} ?>>Tari Kontemporer</a></li>
					</ul>
				</div>
			</div>
			
			<div class="col-lg-9">
				<div class="cari-les">
					<form action="<?php echo site_url('ruangles/cari/'.$les['kategori']); ?>" method="POST">
						<input type="text" name="cari" class="form-control" style="width: 90%;float: left;" placeholder="Apa yang ingin anda pelajari ?">
						<input type="submit" name="" class="btn btn-warning" value="Cari" style="float: left;margin-left: 10px;">
					</form>
				</div>
				<?php
				if ($les['daerah'] == 'tidak ada') {
					# code...
					?>
					<div class="guru">
						<div class="row">
							<div class="wrap">
								<h3>Tidak Ditemukan Guru Les di Daerah yang Anda Cari</h3>	
							</div>
							
						</div>
					</div>

					<?php
				}else{

				?>
				@foreach($les['daerah'] as $key)
				<div class="guru">
					<div class="row">
						<div class="col-lg-2">
							<div class="aa">
								<div class="pp">
									<?php
										if ($key['foto'] != '') {
											# code...
											?>
									<img src="<?php echo base_url(); ?>upload/penari/{{$key['foto']}}">
											<?php
										}else{
									?>
									<img src="<?php echo base_url(); ?>assets/images/Torchic.png">
									<?php
										}
									?>
								</div>
								<h4 style="font-weight: bolder;"><a href="">{{$key['nama_lengkap']}}</a></h4>								
							</div>

						</div>
						<div class="col-lg-8">
							<h4 class="bb"><a href="<?php echo site_url('ruangles/profil/'.$key['id_mengajar']); ?>">{{$key['mata_pelajaran']}}</a></h4>
							<h5>{{$key['nama_kategori']}}</h5>
							<p>{{substr($key['detail'],0,200)}} ...</p>
						</div>
						<div class="col-lg-2">
							<p style="font-weight: bold;color: #666;margin: 0;margin-top: 40%;">Harga:</p>
							<h4 style="color: #d8780a;font-weight: bold;margin: 0;padding: 0;">Rp. {{$key['fee']}} / Jam</h4>
						</div>
					</div>
				</div>
				@endforeach
				<?php
					}
				?>
				<div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3" style="text-align: right;"><?php 
                    if (isset($les['pagination'])) {
                      # code...
                      echo $les['pagination'];  
                    }
                    ?></div>
            	</div>

			</div>

		</div>
	</div>
</section>
@endsection
