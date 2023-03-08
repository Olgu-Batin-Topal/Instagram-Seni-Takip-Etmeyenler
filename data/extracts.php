<?php
session_start();

if (!isset($_POST)) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$zip = new ZipArchive;
if ($zip->open("../uploads/{$_SESSION['file']}") === TRUE) {
    list($name, $extension) = explode('.', $_SESSION['file']);

    if (!is_dir("../uploads/{$name}"))
        mkdir("../uploads/{$name}", 0777, true);

    $zip->extractTo("../uploads/{$name}");
    $zip->close();

    $_SESSION['name'] = $name;

    $return = [
        'title' => 'Başarılı!',
        'text' => 'Dosya başarıyla çıkarıldı!',
        'icon' => 'success'
    ];
    echo json_encode($return);
    exit;
} else {
    $return = [
        'title' => 'Hata!',
        'text' => 'Dosya çıkarılırken bir hata oluştu!',
        'icon' => 'error'
    ];
    echo json_encode($return);
    exit;
}
