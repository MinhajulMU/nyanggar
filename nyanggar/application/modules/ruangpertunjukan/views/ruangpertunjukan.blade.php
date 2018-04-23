@layout('master_view')
@section('content')
<section id="pertunjukan">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-3">
				<div class="menu2">
					<ul class="list-group">
   					  <li class="list-group-item"><a href="<?php echo site_url('ruangpertunjukan/index'); ?>" <?php if ($tunjuk['page'] == '5') { echo 'class="active"'; } ?> >Semua</a></li>
   					  <li class="list-group-item"><a href="<?php echo site_url('ruangpertunjukan/index/4'); ?>" <?php if ($tunjuk['page'] == '4') { echo 'class="active"'; } ?>>Tari Tradisional</a></li>
   					  <li class="list-group-item"><a href="<?php echo site_url('ruangpertunjukan/index/3'); ?>" <?php if ($tunjuk['page'] == '3') { echo 'class="active"'; } ?>>Tari Klasik</a></li>
   					  <li class="list-group-item"><a href="<?php echo site_url('ruangpertunjukan/index/2'); ?>" <?php if ($tunjuk['page'] == '2') { echo 'class="active"'; } ?>>Tari Kreasi</a></li>
   					  <li class="list-group-item"><a href="<?php echo site_url('ruangpertunjukan/index/1'); ?>" <?php if ($tunjuk['page'] == '1') { echo 'class="active"'; } ?>>Tari Kontemporer</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="cari-les" style="margin-top: 50px;">
					<form action="<?php echo site_url('ruangpertunjukan/index/'.$this->uri->segment('3')); ?>" method="POST">
						<input type="text" name="cari" class="form-control" style="width: 90%;float: left;" placeholder="Pertunjukan apa yang ingin anda cari ?">
						<input type="hidden" name="id" value="<?php echo $this->uri->segment('3') ?>">
						<input type="submit" name="" class="btn btn-warning" value="Cari" style="float: left;margin-left: 10px;">
					</form>

				</div>
				<div class="row">
					@foreach($tunjuk['tunjukan'] as $key)
					<div class="col-lg-4">
						<div class="box" style="border-radius: 5px; margin-top: 20px;box-shadow: 0 5px 3px #ddd;margin-bottom: 10px;">
							<video class="video-js vjs-default-skin" width="100%" height="162"
                            data-setup='{"controls" : true, "autoplay" : false, "preload" : "auto"}'>
                            <source src="<?php echo base_url(); ?>upload/video/{{$key['video_pertunjukan']}}" type='video/mp4' />
                          	</video>
                          <h4 style="padding: 0;margin-bottom: 10px;"><b><a href="<?php echo site_url('ruangpertunjukan/detail/'.$key['id_pertunjukan']); ?>">{{$key['nama_pertunjukan']}}</a></b></h4>
						  <span class="badge badge-warning" style="float: left;margin-right: 10px;">{{$key['nama_kategori']}}</span>
                          <span class="badge badge-success" style="float: left;">Rp {{$key['fee']}}</span>
                          <div style="clear: both;"></div>
						</div>
					</div>
					@endforeach
					<?php 
						if (empty($tunjuk['tunjukan'])) {
							# code...
							?>
							<div class="box" style="width: 97%;margin: 0 auto;min-height: 100px;">
								<h2>Pertunjukan yang anda cari tidak ada</h2>
							</div>
							<?php
						}
					 ?>

				</div>
				<div style="clear: both;"></div>
				<div class="row" style="display: block;">

					<br>
                    <div class="col-md-9"></div>
                    <div class="col-md-3" style="text-align: right;"><?php 
                    if (isset($tunjuk['pagination'])) {
                      # code...
                      echo $tunjuk['pagination'];  
                    }
                    ?></div>
            	</div>
			</div>
		</div>
	</div>
</section>
@endsection
