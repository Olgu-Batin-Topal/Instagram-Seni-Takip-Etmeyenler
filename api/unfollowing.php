<?php
session_start();

if (!isset($_POST)) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$jsonFollowers = file_get_contents(__DIR__ . "/../uploads/{$_SESSION['name']}/followers_and_following/followers_1.json");
$jsonFollowers = json_decode($jsonFollowers);

$jsonFollowings = file_get_contents(__DIR__ . "/../uploads/{$_SESSION['name']}/followers_and_following/following.json");
$jsonFollowings = json_decode($jsonFollowings);

if (empty($jsonFollowers) || empty($jsonFollowings)) {
    $return = [
        'title' => 'Hata!',
        'text' => 'Dosyalar boş!',
        'icon' => 'error'
    ];
    echo json_encode($return);
    exit;
}

foreach ($jsonFollowers as $follower) {
    $followers[] = $follower->string_list_data[0]->value;
}

foreach ($jsonFollowings as $data) {
    foreach ($data as $following) {
        $followings[] = $following->string_list_data[0]->value;
    }
}

$unfollow = array_diff($followings, $followers);

foreach ($unfollow as $user) {
    $return[] = [
        'username' => $user,
        'url' => "https://instagram.com/{$user}"
    ];
}

$_SESSION['unfollow'] = $return;

function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}
deleteDirectory(__DIR__ . "/../uploads/{$_SESSION['name']}");
unlink(__DIR__ . "/../uploads/{$_SESSION['name']}.zip");

$return = [
    'title' => 'Başarılı!',
    'text' => 'Dosya başarıyla çıkarıldı!',
    'icon' => 'success'
];
echo json_encode($return);
exit;
