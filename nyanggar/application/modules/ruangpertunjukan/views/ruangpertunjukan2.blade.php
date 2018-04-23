@layout('master_view')
@section('content')
<section id="pertunjukan">
@foreach($tunjuk['tunjukan'] as $key)
	<div class="wrap" style="padding-top: 50px;margin-bottom: 0px;padding-bottom: 50px;">
		<h1 style="margin-bottom: 0px;"><b>{{$key['nama_pertunjukan']}}</b></h1>
		
		<h4 style="padding: 0;margin-top: 0;padding-top: 5px;">{{$key['nama_kategori']}}</h4>
		<div class="row">
			<div class="col-lg-6">
				<video class="video-js vjs-default-skin" width="100%" height="362"
                            data-setup='{"controls" : true, "autoplay" : false, "preload" : "auto"}'>
            	<source src="<?php echo base_url(); ?>upload/video/{{$key['video_pertunjukan']}}" type='video/mp4' />
        		</video>				
			</div>
			<div class="col-lg-6">
				<div>
					<div class="rounded" style="overflow: hidden;width: 40px;height: 40px;float: left;margin-right: 10px;">
						<img src="<?php echo base_url(); ?>upload/penari/{{$key['foto']}}" width="40px">
					</div>
					<h2 style="float: left;margin-top: 0;padding-top: 0;"><b> {{$key['nama_lengkap']}}</b></h2>
					<div style="clear: both;"></div>	
				</div>
				
				<p>{{$key['detail_pertunjukan']}}</p>
				<span class="badge badge-success">Rp. {{$key['fee']}}</span><br><br>
				<a href="<?php echo site_url('ruangpertunjukan/pesan/'.$key['id_pertunjukan']); ?>"><button class="btn btn-warning"><i class="fa fa-mouse-pointer"></i> Pesan Pertunjukan</button></a> <a href="<?php echo site_url('ruangpertunjukan'); ?>"> <button class="btn btn-secondary" style="margin-left: 10px;"> <i class="fa fa-chevron-left"></i> Kembali</button></a>
			</div>
		</div>

	</div>
@endforeach
</section>
@endsection
