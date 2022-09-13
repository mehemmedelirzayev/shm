<?php
session_start();
ob_start();

include 'baglanti.php';

$sorgu = "SELECT * FROM muellimler"; //muellim tablosunun secilmesi
$muellimer = $db->query($sorgu)->fetchAll(PDO::FETCH_ASSOC);  //butun verileri getirir

$sorgu2 = "SELECT * FROM sagirdler"; //muellim tablosunun secilmesi
$sagirdler = $db->query($sorgu2)->fetchAll(PDO::FETCH_ASSOC);  //butun verileri getirir

if (isset($_POST)) {
    @$_SESSION['ad'] = $_POST['ad'];
    @$_SESSION['pass'] = $_POST['pass'];
    @$_SESSION['bolum'] = $_POST['bolum'];



    if ($_SESSION['bolum'] == "valideyin") {
        $dbpass;
        $dbyetki = 5;
        $dbisnomresi=0;
        foreach ($sagirdler as $muellim) {
            if ($muellim['is_nomresi'] == $_SESSION['ad']) {
                $dbpass = $muellim['pass'];
                $dbyetki = $muellim['yetki'];
                $dbisnomresi = $muellim['is_nomresi'];
            }
        }


        if ($dbyetki == 5 && $_SESSION['ad'] == $dbisnomresi && $_SESSION['pass'] == $dbpass) {
            header('Location: http://localhost/ems/valideyin/quiz.php');
            exit;
        }
    }


    if ($_SESSION['bolum'] == "muellim") {

        $dbpass;
        $dbyetki = 0;
        $dbad;
        foreach ($muellimer as $muellim) {
            if ($muellim['ad_soyad'] == $_SESSION['ad']) {
                $dbpass = $muellim['pass'];
                $dbyetki = $muellim['yetki'];
                $dbad = $muellim['ad_soyad'];
            }
        }


        if ($dbyetki == 1 && $_SESSION['ad'] == $dbad && $_SESSION['pass'] == $dbpass) {
            header('Location: http://localhost/ems/admin/admin.php');
            exit;
        } elseif ($dbyetki == 2 && $_SESSION['ad'] == $dbad && $_SESSION['pass'] == $dbpass) {
            header('Location: http://localhost/ems/idare.php');
            exit;
        } elseif ($dbyetki == 3 && $_SESSION['ad'] == $dbad && $_SESSION['pass'] == $dbpass) {
            header('Location: http://localhost/ems/sinif_rehberi.php');
            exit;
        } elseif ($dbyetki == 4 && $_SESSION['ad'] == $dbad && $_SESSION['pass'] == $dbpass) {
            header('Location: http://localhost/ems/muellim/quiz.php');
            exit;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'style.php'  ?>

    <title>Giriş</title>
    <?php include 'style.php'  ?>



</head>

<body>

    <div class="header">
        <h1 style="text-align: center;">Şəki Hazırlıq Mərkəzi</h1>
        <h2 style="text-align: center;">Elektron Məktəb Sistemi</h2>

    </div>



    <div class="row">
        <div class="card">

            <div class="login">
                <form action="" method="post" class="form">

                    <label class="container">Valideyin Girişi
                        <input value="valideyin" type="radio" checked="checked" name="bolum">
                        <span class="checkmark"></span>
                    </label>
                    <br>
                    <label class="container">Müəllim Girişi
                        <input type="radio" value="muellim" name="bolum">
                        <span class="checkmark"></span>
                    </label>
                    <br>

                    <input name="ad" type="text" required class="ad" placeholder="Adınızı Yazın"> <br>
                    <input name="pass" type="password" required class="soyad" placeholder="Şifrənizi Yazın"> <br>
                    <button type="submit" class="btn">Giris </button>
                    <br>
                </form>
            </div>


        </div>

    </div>

</body>

</html>




</html>
