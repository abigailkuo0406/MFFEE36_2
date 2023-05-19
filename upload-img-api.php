<?php

header('Content-Type: application/json');

$output = [
    'filename' => '',
    'files' => $_FILES, // 除錯用的
];
//hhd
# echo json_encode($_FILES);

if (!empty($_FILES['avatar'])) {
    $filename = sha1($_FILES['avatar']['name'] . uniqid()) . '.jpg';
    // $filename = 'pgg.jpg' ;

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], "./parts/john_parts/back/imgs/{$filename}")) {
        $output['filename'] = $filename;
    } else {
        $output['error'] = 'cannot move files';
    }
}
echo json_encode($output);
