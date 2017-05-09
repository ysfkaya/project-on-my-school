<?php
    require '../system/backend.php';
    require '../system/system.php';
    if (isLogin() && isAdmin()){
        go(url());
    }else if(isLogin() && isUser()){
        go("javascript:history.go(-1)");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Proje Takibim - Admin Paneli</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,900" rel="stylesheet" media="screen" title="no title">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" media="screen" title="no title">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" media="screen" title="no title">
    <!-- Simple İcons -->
    <link href="css/simple-line-icons.css" rel="stylesheet" media="screen" title="no title">


    <!-- Datatables -->
    <link href="vendor/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="vendor/datatable/css/jquery.dataTables_themeroller.css" rel="stylesheet">
    <link href="vendor/datatable/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="vendor/datatable/css/responsive.dataTables.min.css" rel="stylesheet">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="css/admin.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container" style="margin-top:30px">
    <div class="col-md-12">
        <div class="modal-dialog" style="margin-bottom:0">
            <div class="modal-content">
                <div class="panel-heading">
                    <h3 class="panel-title">Giriş Yap</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <?php
                        if (isPost()){
                            $kullanici = post('kullanici');
                            $sifre = md5(post('sifre'));
                            if (empty($kullanici) || empty($sifre)){
                                warning('Lütfen e-posta ve şifre bölümlerini boş bırakmayınız.');
                            }else{
                                $query = $db->prepare("SELECT * FROM ogretmenler WHERE (ogretmen_eposta = :eposta OR ogretmen_kullaniciadi = :kullaniciadi) AND ogretmen_sifre = :sifre ");
                                $query->execute(array(
                                    'eposta' => $kullanici,
                                    'kullaniciadi' => $kullanici,
                                    'sifre' => $sifre
                                ));
                                if ($query->rowCount() > 0){
                                    $user = $query->fetch(PDO::FETCH_ASSOC);
                                    $sesion = array(
                                        'ogretmen_id' => $user['ogretmen_id'],
                                        'eposta' => $user['ogretmen_eposta'],
                                        'kullaniciadi' => $user['ogretmen_kullaniciadi'],
                                        'login' => true,
                                        'user' => 'admin'
                                    );
                                    create_session($sesion);
                                    $login = true;
                                    $today = date("Y-m-d H:i:s");
                                    $update = $db->prepare("UPDATE ogretmenler SET ogretmen_giris = :giris WHERE ogretmen_id = :id");
                                    $update->execute(array(
                                        'id' => $user['ogretmen_id'],
                                        'giris' => $today
                                    ));
                                }else{
                                    warning('Böyle bir öğretmen bulunmuyor');
                                }

                            }
                        }
                        ?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-posta veya Kullanıcı Adı" name="kullanici" type="text" autofocus="" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Şifre" name="sifre" type="password" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Giriş Yap</button>
                        </fieldset>
                    </form>
                </div>
                <?php if ($login == true){success('Giriş Gerçekleştirildi');go(url('index.php'),2);}?>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

