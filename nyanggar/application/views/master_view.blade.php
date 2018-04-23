<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/media.css">
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/icon.jpg">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pushy.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/video-js.min.css" type="text/css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js" ></script>

    <title>Nyanggar.id</title>
  </head>

  <body>
    <nav class="pushy pushy-right" data-focus="#first-link">
        <div class="pushy-content">
          <ul>
             <li class="pushy-link"><a href="<?php echo base_url(); ?>">Home</a></li>
             <li class="pushy-link"><a href="<?php echo site_url('ruangles'); ?>">Ruang Les</a></li>
             <li class="pushy-link"><a href="<?php echo site_url('ruangpertunjukan'); ?>">Ruang Pertunjukan</a></li>
             <li class="pushy-link"><a href="<?php echo site_url('tentang'); ?>">Tentang Kami</a></li>
        </ul>
      </div>
    </nav>
    <div class="site-overlay"></div>

    <div class="contain push">
              <!-- Site Overlay -->
    <section id="top">
        <div class="wrap">
          <div class="row">
            <div class="col col-lg-3 col-md-3 col-sm-2 col-xs-4" >
              <div id="logos">
                <a href="<?php echo base_url(); ?>">
                  <img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="logos">
                </a>
              </div>    
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-5 col-xs-4" style="text-align: center;">
              <nav id="menu" class="d-none d-md-block">
                <ul>
                  <li><a href="<?php echo base_url(); ?>">Home</a></li>
                  <li><a href="<?php echo site_url('ruangles'); ?>">Ruang Les</a></li>
                  <li><a href="<?php echo site_url('ruangpertunjukan'); ?>">Ruang Pertunjukan</a></li>
                  <li><a href="<?php echo site_url('tentang'); ?>">Tentang Kami</a></li>
                </ul>
              </nav>
              <button class="menu-btn d-block d-sm-block d-md-none" style="text-align: center;">&#9776; Menu</button>          
            </div>
            <div class="col col-lg-3 col-md-3 col-sm-5 col-xs-4">
              <?php
                if (isset($_SESSION['lstrclnt']) || isset($_SESSION['lstrpnr'])) {
                  # code...
                }else{?>

                <?php
               ?>
              <div id="usermenu" class="d-block d-sm-block d-md-none" style="float: right;" >
                <img src="<?php echo base_url(); ?>assets/images/user.png">
                <nav id="menus" class="hidden" style="float: right;">
                <ul>
                  <li><a href="<?php echo site_url('register/'); ?>">Daftar</a></li>
                  <li><a href="<?php echo site_url('masuk/'); ?>">Masuk</a></li>
                </ul>
              </nav>
              <div style="clear: both;"></div>
              </div>
              <div style="clear: both;"></div>
              <?php 
            }
              ?>
              <?php 
                if (isset($_SESSION['lstrclnt'])) {
                  # code...
                  ?>
                  <div class="profile1">
                    
                  
                  <div class="profile">
                    <a href="#">
                      <?php
                        if ($_SESSION['lstrclnt']['foto'] != '') {
                          # code...
                          ?>
                          <img src="<?php echo base_url(); ?>upload/client/<?php echo $_SESSION['lstrclnt']['foto']; ?>">
                          <?php
                        }else{
                          ?>
                          <img src="<?php echo base_url(); ?>assets/images/Torchic.png">
                          <?php
                        }
                      ?>
                      
                    </a>
                  </div>
                  <nav id="menus" class="hidden2">
                    <ul>
                      <?php
                        $nama = explode(" ",$_SESSION['lstrclnt']['nama']);
                      ?>
                      <li>Hi <?php echo $nama['0']; ?></li>
                      <li><a href="<?php echo site_url('client'); ?>">Dashboard</a></li>
                      <li><a href="<?php echo site_url('masuk/logoutclient'); ?>">Log Out</a></li>
                    </ul>
                  </nav>
                  
                  </div>
                  <div style="clear: both;"></div>
                  <?php
                }if (isset($_SESSION['lstrpnr'])) {
                  # code...
                  ?>
                  <div class="profile1">
                    
                  
                  <div class="profile">
                    <a href="#">
                      <?php
                        if ($_SESSION['lstrpnr']['foto'] != '') {
                          # code...
                          ?>
                          <img src="<?php echo base_url(); ?>upload/penari/<?php echo $_SESSION['lstrpnr']['foto']; ?>">
                          <?php
                        }else{
                          ?>
                          <img src="<?php echo base_url(); ?>assets/images/Torchic.png">
                          <?php
                        }
                      ?>
                      
                    </a>
                  </div>
                  <nav id="menus" class="hidden2">
                    <ul>
                      <?php
                        $nama = explode(" ",$_SESSION['lstrpnr']['nama']);
                      ?>
                      <li>Hi <?php echo $nama['0']; ?></li>
                      <li><a href="<?php echo site_url('penari'); ?>">Dashboard</a></li>
                      <li><a href="<?php echo site_url('masuk/logoutpenari'); ?>">Log Out</a></li>
                    </ul>
                  </nav>
                  
                  </div>
                  <div style="clear: both;"></div>
                  <?php
                }
                if (isset($_SESSION['lstrclnt']) or isset($_SESSION['lstrpnr'])) {
                  # code...

                }else{
              ?>
              <div id="daftar" class="d-none d-md-block">
                <nav>
                  <ul>
                    <li><a href="<?php echo site_url('register/'); ?>">Daftar</a></li>
                    <li><a href="<?php echo site_url('masuk/'); ?>">Masuk</a></li>
                  </ul>
                </nav>
              </div>
              <?php
                }
              ?>
            </div>
          </div>
          
        </div>
      </section>
      <section id="contain">
      @yield('content')
      </section>

    </div>
    <footer>
      <div class="wrap">
        <div class="row">
          <div class="col-lg-3 col-md-3">
            <h2>Hubungi Kami</h2>
            <p>
              Kantor Nyanggar.id<br>
              Gunungpati Semarang, 59263<br>
              Tlp : 021-78836417<br>
              Mobile : 085726882962 ( Bapak Danang )<br>
              Email : program@nyanggar.id
            </p>
          </div>
          <div class="col-lg-3 col-md-3">
            <h2>Nyanggar.id</h2>
            <ul style="font-size: 90%;">
              <li><a href="<?php echo base_url(); ?>">Home</a></li>
              <li><a href="<?php echo site_url('ruangles'); ?>">Ruang Les</a></li>
              <li><a href="<?php echo site_url('ruangpertunjukan'); ?>">Ruang Pertunjukan</a></li>
              <li><a href="<?php echo site_url('tentang'); ?>">Tentang Kami</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3">
            <h2>Ikuti Kami di</h2>
            <ul id="socmed">
              <li>
                <div>
                 <a href="#">
                   <img src="<?php echo base_url(); ?>assets/images/socmed/facebook.png">
                 </a> 
                </div>
              </li>
              <li>
                <div>
                 <a href="#">
                   <img src="<?php echo base_url(); ?>assets/images/socmed/instagram.png">
                 </a> 
                </div>
              </li>
              <li>
                <div>
                 <a href="#">
                   <img src="<?php echo base_url(); ?>assets/images/socmed/twitter.png">
                 </a> 
                </div>
              </li>
              <li>
                <div>
                 <a href="#">
                   <img src="<?php echo base_url(); ?>assets/images/socmed/youtube.png">
                 </a> 
                </div>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3">
            
          </div>
        </div>  
      </div>
      
      <div class="copy">
        <div class="wrap">
          Copyright &copy; 2018 I-Secret Project
        </div> 
      </div>
    </footer>
    <div id="stop" class="scrollTop">
      <span><a href="#"><img src="<?php echo base_url(); ?>assets/images/up-arrow.png"></a></span>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="<?php echo base_url(); ?>assets/js/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.inputmask.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js" ></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" ></script>
    <script src="<?php echo base_url(); ?>assets/js/pushy.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/swiper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/video.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.contain #top #usermenu').click(function(){
          $('.contain #top .hidden').toggle();
        });
        $('.contain #top .profile1').click(function(){
          $('.contain #top .hidden2').toggle();
        });
      });
    </script>
    <script>
      var swiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    </script>
        <script type="text/javascript">
       // BY KAREN GRIGORYAN

$(document).ready(function() {
  /******************************
      BOTTOM SCROLL TOP BUTTON
   ******************************/
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
  // declare variable
      $('[data-mask]').inputmask();
  var scrollTop = $(".scrollTop");

  $(window).scroll(function() {
    // declare variable
    var topPos = $(this).scrollTop();

    // if user scrolls down - show scroll to top button
    if (topPos > 100) {
      $(scrollTop).css("opacity", "0.5");

    } else {
      $(scrollTop).css("opacity", "0");
    }

  }); // scroll END

  //Click event to scroll to top
  $('.scrollTop').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 800);
    return false;

  }); // click() scroll top EMD

    $('#datepicker').datepicker({
      autoclose: true
    });
}); // ready() END
    </script>
    <script>
            videojs.options.flash.swf = "js/video-js.swf";
    </script>
  </body>
</html>