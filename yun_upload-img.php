<?php

header('Content-Type: application/json');

$output = [
    'filename' => '',
    'files' => $_FILES, // 除錯用的
];
//
# echo json_encode($_FILES);

if(! empty($_FILES['avatar'])){
    $filename = sha1($_FILES['avatar']['name']. uniqid()). '.jpg';

    if(move_uploaded_file($_FILES['avatar']['tmp_name'], "./imgs/{$filename}")){
        $output['filename'] = $filename;
    } else {
        $output['error'] = 'cannot move files';
    }

}
echo json_encode($output);