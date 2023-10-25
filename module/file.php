<?php
function getFilesInDirectory($dir)
{
    $files = scandir($dir);
    $files = array_diff($files, ['.', '..']);
    return $files;
}
function showarray($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
function getFileSize($filepath) {
    if (is_file($filepath)) {
        $size = filesize($filepath);
        $unit = '';

        if ($size >= 1073741824) { // 1 GB
            $size = round($size / 1073741824, 2);
            $unit = ' GB';
        } elseif ($size >= 1048576) { // 1 MB
            $size = round($size / 1048576, 2);
            $unit = ' MB';
        } elseif ($size >= 1024) { // 1 KB
            $size = round($size / 1024, 2);
            $unit = ' KB';
        } elseif ($size > 1) {
            $unit = ' bytes';
        } else {
            $size = '0';
            $unit = ' bytes';
        
        }
    } else {
        echo "File not found";
    }
    return $size . $unit;
}


?>