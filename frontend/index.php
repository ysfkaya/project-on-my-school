<?php echo !defined("GUVENLIK") ? die("Geçersiz istek") : null;?>
<!DOCTYPE html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$ayar['site_baslik'];?></title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet" media="screen" title="no title">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" media="screen" title="no title">
    <!-- Bootstrap -->
    <link href="<?=asset("css/bootstrap.min.css")?>" rel="stylesheet" media="screen" title="no title">
    <!-- Font Awesome -->
    <link href="<?=asset("vendor/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet" media="screen" title="no title">
    <!-- Simple İcons -->
    <link href="<?=asset("css/simple-line-icons.css")?>" rel="stylesheet" media="screen" title="no title">
    <!-- Sweet Alert   -->
    <link rel="stylesheet" href="<?=asset("css/sweetalert.css");?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=asset("css/custom.css")?>" media="screen" title="no title">
    <link rel="stylesheet" href="<?=asset("css/video.css")?>" media="screen" title="no title">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <div id="loading" class="hidden"></div>
  <body data-spy="scroll" data-target="#navbar-scroll">
    <header>
      <nav class="navbar navbar-default p-nav navbar-fixed-top" id="navbar-scroll">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#toggle" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button> 
            <a class="navbar-brand page-scroll" href="#home">
               <?= !empty($ayar['site_anasayfa_logo']) ? '<img src="'.$ayar['site_anasayfa_logo'].'" width=75 height=50 style="position:relative;bottom:10px" alt="proje takibim" title="Proje Takibim">' : 'Proje Takibim';?>
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="toggle">
            <ul class="nav navbar-nav navbar-right">
              <li><a class="page-scroll" href="#about">HAKKIMIZDA</a></li>
              <li><a class="page-scroll" href="#works">NASIL ÇALIŞIR ?</a></li>
              <!-- <li><a class="page-scroll" href="#contact">İLETİŞİM</a></li> -->
              <li><a href="#" data-toggle="modal" data-target="#myModal">GİRİŞ YAP</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <div class="banner section">
      <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-6 pull-right">
                <!-- kayıt ol -->
                <?php require_once 'inc/kayit.php'; ?>
                <!-- /kayıt ol-->
            </div>
            <div class="col-md-8 col-sm-6 pull-left banner-form">
                <div class="banner-header">
                  <h4>Kayıt Olduktan Sonra</h4>
                </div>
                <div class="banner-body">
                  <ul>
                    <li><i class="icon-check"></i> Proje gönderme işlemi</li>
                    <li><i class="icon-check"></i> Proje durum kontrolü</li>
                  </ul>
                </div>
            </div>
          </div>
      </div>
    </div>
    <div class="about section" id="about">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 col-md-7 col-xs-12">
                <div class="about-left">
                  <img src="<?=asset("images/about-image.jpg");?>" class="responsive about-img" alt="">
                </div>
              </div>
              <div class="col-lg-6 col-md-5 col-xs-12">
                <div class="about-right">
                  <h3>
                    HAKKIMIZDA
                  </h3>
                  <p><?=$ayar['site_hakkimizda']?></p>
                </div>
              </div>
          </div>
      </div>
    </div>
    <div class="works section" id="works">
      <div class="container">
        <div class="works-title text-center">
            <h2>NASIL ÇALIŞIR ?</h2>
            <p>Bu sitenin nasıl çalıştığı hakkında sizin için kısa bir videomuz var.</p>
        </div>
        <span class="btn-play" data-toggle="modal"  data-target="#modal-video">
          <i class="fa fa-play"></i>
        </span>
      </div>
    </div>


    <!-- MODAL -->
    <div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-video">
                        <div class="embed-responsive embed-responsive-16by9">
                          <video width="320" height="240" controls>
                              <source src="video/proje-takibim.mp4" type="video/mp4">
                          </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="contact section text-center" id="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <h3>İLETİŞİM</h3>
            <div class="form">
                <form class="contact-form" action="" method="post" >
                    <div class="form-group">
                        <input type="text" name="isim" placeholder="İsim" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="eposta" placeholder="Eposta Adresi" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <textarea name="mesaj" style="height: auto !important;" placeholder="Mesajınız" class="form-control" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LeqFxsUAAAAAM1Kc2Fyb7ngqDTceE8DqRxojPiu" style="margin-bottom: 10px"></div>
                    <button type="submit" name="button" class="btn btn-custom btn-lg btn-block">Gönder</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
 -->
    <?php require_once 'inc/giris.php'; ?>


    <footer class="text-center">
      <div class="container">
        <div class="copyright">
          <span>&copy; 2017 Kırkağaç Celal Bayar Üniversitesi</span>
          <a href="#">Yusuf Kaya</a>
          <a href="#">Tayfun Serin</a>
        </div>
      </div>
    </footer>

    <script src="<?=asset("js/jquery.min.js");?>"></script>
    <script src="<?=asset("js/bootstrap.min.js");?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?=asset("js/jquery.easing.min.js");?>"></script>
    <script src="<?=asset("js/sweetalert.min.js");?>"></script>
    <script>
      var URL = "<?=URL;?>";
    </script>
    <script src="<?=asset("js/custom.js");?>"></script>

  </body>
</html>
