<?php
include 'config.php';
session_start();
if($login == false){
    $_SESSION['username'] = "root";
} else{
    
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    $_SESSION['error'] = ['You must login first !'];
    exit;
}
}

$username = $_SESSION['username'];
include 'view/header.php';
include 'module/file.php';
include 'module/download.php';
$path = isset($_GET['path']) ? urldecode($_GET['path']) : $baseDir;


$listFiles = getFilesInDirectory($path);

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'dir':
            $dir = isset($_GET['dir']) ? $_GET['dir'] : '';
    
            if (strpos($dir, $baseDir) !== 0) {
                header('Location: index.php');
            } else {

                $listFiles = getFilesInDirectory($dir);
                include 'view/child.php';
            }
            case 'download':     
                if (isset($_GET['download'])) {
                    $pathToDownload = $_GET['download'];
                    echo $pathToDownload;
                    download($pathToDownload);
                    exit;
                } elseif (isset($_GET['downloadzip'])) {
                    $pathToDownloadZip = $_GET['downloadzip'];
                    echo $pathToDownload;
                    downloadZip($pathToDownloadZip);
                    exit;
                } elseif (isset($_GET['downloadallzip'])) {
                    $pathToDownloadAllZip = $_GET['downloadallzip'];
                    echo $pathToDownload;
                    downloadAllZip($pathToDownloadAllZip);
                    exit;
                }
                    break;
        case 'downloadall':
            $pathToDownloadAll = $_GET['downloadall'];
            downloadAllZip($pathToDownloadAll);
            break;
        case 'logout':
            session_destroy();
            header('Location: login.php');
            break;
        default:
            include 'view/body.php';
            break;
    }
} else {
    include 'view/body.php';
}

include 'view/footer.php';

?>
