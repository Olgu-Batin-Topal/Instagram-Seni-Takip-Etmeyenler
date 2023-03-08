<?php
session_start();

?>
<!DOCTYPE html>
<html lang="tr">

<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="authort" content="Olgu Batın TOPAL | yazilimdunyam.com">
    <meta name="description" content="Instagram'da sizi takip etmeyenlerinizi 3. parti bir uygulama kullanmadan bulabilirsiniz.">
    <meta name="keywords" content="instagram takip etmeyenler, instagram takip etmeyenler bulma, instagram takip etmeyenler listesi">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google" content="notranslate">

    <!-- Title -->
    <title>Instagram Takip Etmeyenler | yazilimdunyam.com</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="https://yazilimdunyam.com/assets/img/icon.png" type="image/x-icon">

    <!-- Style -->
    <link rel="stylesheet" href="./public/assets/css/main.min.css?v=<?= rand(1, 99999999999) ?>">
    <link rel="stylesheet" href="./public/assets/css/style.min.css?v=<?= rand(1, 99999999999) ?>">

</head>

<body class="container">

    <?php if (!isset($_SESSION['unfollow'])) : ?>
        <section class="uploadFile">
            <div class="uploadFile__form">
                <form action="" method="post" id="uploadForm" enctype="multipart/form-data">
                    <div class="uploadFile__form__input">
                        <input type="file" name="file" id="file" class="uploadFile__form__input__inputfile">
                        <progress id="progressBar" value="0" max="100" style="width: 100%;"></progress>
                    </div>
                </form>
            </div>
        </section>

        <section class="information">
            <div class="information__content">
                <h1 class="information__content__title">Instagram Takip Etmeyenler Nasıl Kullanılır?</h1>
                <p class="information__content__text">
                    <strong>1. Adım:</strong> İlk olarak bilgisayar üzerinden <a href="https://www.instagram.com/" target="_blank">Instagram</a> hesabınıza giriş yapın.
                </p>
                <p class="information__content__text">
                    <strong>2. Adım:</strong> Hesabınızın bilgilerini <a href="https://www.instagram.com/download/request/" target="_blank">buradan</a> JSON olarak indirin.
                </p>
                <p class="information__content__text">
                    <strong>3. Adım:</strong> İndirdiğiniz zip dosyasını bu sayfaya yükleyin.
                </p>
                <p class="information__content__text">
                    <strong>4. Adım:</strong> Sistem sizin takip ettiğiniz kişileri ve takip etmeyen kişileri ayırarak gösterecektir.
                </p>
                <p class="information__content__text">
                    <strong>5. Adım:</strong> Takip etmeyen kişileri takip etmeyi bırakın.
                </p>
                <p class="information__content__text">
                    <strong>6. Adım:</strong> Sistemde verileriniz asla kayıt altına alınmaz. Cihazınızda saklanır <small>(sadece sizi takip etmeyen kişilerin kullanıcı adları)</small>. Cihazınızdaki verileri silmek için 'Sistemi Temizle' butonuna tıklayabilirsiniz.
                </p>
            </div>
        </section>
    <?php endif; ?>

    <?php if (isset($_SESSION['unfollow'])) : ?>
        <section class="unfollowings">
            <h1 class="unfollowings__title">Takip etmeyenler</h1>
            <ul class="unfollowings__lists">
                <?php foreach ($_SESSION['unfollow'] as $unfollow) : ?>
                    <li class="unfollowings__lists__item">
                        <a href="<?= $unfollow['url'] ?>" target="_blank" class="unfollowings__lists__item__link"><span class="unfollowings__lists__item__name"><?= $unfollow['username'] ?></span></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="clearSession">
            <a href="reset"><button class="clearSession__button">Sistemi Temizle</button></a>
        </section>
    <?php endif; ?>

</body>

<!-- Cdn -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>

<!-- Script -->
<script src="./public/assets/js/main.js?v=<?= rand(1, 99999999999) ?>"></script>


</html>