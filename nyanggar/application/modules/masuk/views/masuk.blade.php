@layout('master_view')
@section('content')
        <div class="wrap4">
          <div id="box" style="min-height: 470px;">
            <h1>Masuk ke Akun Nyanggar.id</h1>
            <br>
            
              <div>
                <ul class="nav nav-tabs login-tab" role="tablist">
                  <li>
                  <a href="#home" role="tab" data-toggle="tab" class="active">Client</a></li>
                  <li><a href="#profile" role="tab" data-toggle="tab">Penari</a></li>
                </ul>
              <?php 
                  if (validation_errors()) {
                    # code...
                    echo "<br>";
                    echo validation_errors();
                  }
                  
                  if ($this->session->flashdata('ggl')) {
                    # code...
                    echo "<br>";
                    echo $this->session->flashdata('ggl');
                  }if ($this->session->flashdata('lgtclnt')) {
                    # code...
                    echo "<br>";
                    echo $this->session->flashdata('lgtclnt');
                  }if ($this->session->flashdata('lgtpnr')) {
                    # code...
                    echo "<br>";
                    echo $this->session->flashdata('lgtpnr');
                  }

              ?> 
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active" id="home">
                    <h5 style="padding-bottom: 10px;margin-bottom: 0;">E-Mail:</h5>
                    <form action="<?php echo site_url('masuk/authclient'); ?>" method="POST">
                    <input type="email" name="email" class="form-control">
                    <h5 style="padding-bottom: 10px;margin-bottom: 0;">Kata Sandi:</h5>
                    <input type="password" name="password" class="form-control"><br>
                    <input type="submit"  value="Masuk" class="btn btn-warning" style="width: 100%;color: #fff;">
                    </form>
                  </div>
                  <div class="tab-pane fade" id="profile" >
                    <form action="<?php echo site_url('masuk/authpenari'); ?>" method="POST">
                      <h5 style="padding-bottom: 10px;margin-bottom: 0;">E-Mail:</h5>
                      <input type="email" name="email" class="form-control">
                      <h5 style="padding-bottom: 10px;margin-bottom: 0;">Kata Sandi:</h5>
                      <input type="password" name="password" class="form-control"><br>
                      <input type="submit"  value="Masuk" class="btn btn-warning" style="width: 100%;color: #fff;">
                    </form>
                  </div>
                </div>
              </div>  
            
          </div>
        </div>
@endsection