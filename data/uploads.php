<?php
session_start();

if (!isset($_POST)) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

if (isset($_FILES)) {
    $file = $_FILES['file'];

    if ($file['error'] !== 0) {
        $return = [
            'title' => 'Hata!',
            'text' => 'Dosya yüklenirken bir hata oluştu!',
            'icon' => 'error'
        ];
        echo json_encode($return);
        exit;
    }

    if ($file['type'] !== 'application/x-zip-compressed') {
        $return = [
            'title' => 'Hata!',
            'text' => 'Dosya formatı yanlış!',
            'icon' => 'error'
        ];
        echo json_encode($return);
        exit;
    }

    move_uploaded_file($file['tmp_name'], __DIR__ . '/../uploads/' . $file['name']);

    $_SESSION['file'] = $file['name'];

    $return = [
        'title' => 'Başarılı!',
        'text' => 'Dosya başarıyla yüklendi!',
        'icon' => 'success'
    ];
    echo json_encode($return);
    exit;
}
