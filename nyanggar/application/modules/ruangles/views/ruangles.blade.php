@layout('master_view')
@section('content')

<section id="ruang">
	<div class="wrap">
		<div style="" class="judul3">
			<h1 style="font-weight: bolder;">Ruang Les</h1>
			<p>Cari guru Les Tari di Daerah Kamu, Mari Lestarikan Budaya Lokal Bersama Penari Lokal Daerah !</p>
		</div>

		<div class="formcari">
		<?php
		echo $this->session->flashdata('errorslokasi');
		?>
			<form action="<?php echo site_url('ruangles/daerah'); ?>" method="POST">
			<select class="form-control form-provinsi" id="selectcat" name="provinsi">
				<option value="" class="rhth">Select Provinsi</option>
				@foreach($les['provinsi'] as $key)
				<option class="p{{$key['id']}}" value="{{$key['id']}}">{{$key['name']}}</option>
				@endforeach
			</select>
			<select class="form-control form-kabupaten selectcat" id="selectprod" name="kabupaten">
				<option value="" class="rhth23">Select Kabupaten</option>
                @foreach($les['kabupaten'] as $key)
                <option value="{{$key['id']}}" class="p{{$key['province_id']}}" id="k{{$key['id']}}">{{$key['name']}}</option>
                @endforeach
			</select>
			<select class="form-control form-kecamatan" id="selectprod2" name="kecamatan">
				
               <option value="" class="rhth23">Select Kecamatan</option>
               @foreach($les['kecamatan'] as $keys)
               <option value="{{$keys['id']}}" class="selectors  k{{$keys['regency_id']}}">{{$keys['name']}}</option>
               @endforeach
                
			</select>
			<input type="submit" name="" class="btn btn-warning" value="Cari" >
			</form>
			<div style="clear: both;"></div>
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
