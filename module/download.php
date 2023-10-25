<?php
function download($path) {
    // Kiểm tra xem tệp tồn tại và có quyền truy cập không
    if (file_exists($path) && is_readable($path)) {
        // Thiết lập các header để tải xuống tệp
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header('Content-Length: ' . filesize($path));
        
        // Đọc và gửi nội dung của tệp
        readfile($path);
        exit;
    } else {
        // Hiển thị thông báo lỗi nếu tệp không tồn tại hoặc không thể truy cập
        echo "Cannot download this file.";
    }
}

function downloadZip($path) {
    // Tạo tên tệp zip dựa trên tên thư mục
    $zipFileName = basename($path) . '.zip';

    // Tạo đối tượng ZipArchive
    $zip = new ZipArchive();

    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        // Đệ quy thêm tất cả các tệp và thư mục vào tệp zip
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $itemPath = $item->getRealPath();
            $relativePath = substr($itemPath, strlen($path) + 1);

            if ($item->isDir()) {
                $zip->addEmptyDir($relativePath);
            } else {
                $zip->addFile($itemPath, $relativePath);
            }
        }

        // Đóng tệp zip
        $zip->close();

        // Thiết lập các header để tải xuống tệp zip
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        header('Content-Length: ' . filesize($zipFileName));

        // Gửi nội dung của tệp zip
        readfile($zipFileName);

        // Xóa tệp zip sau khi tải xuống
        unlink($zipFileName);
    } else {
        // Hiển thị thông báo lỗi nếu không thể tạo tệp zip
        echo "Cannot creating Zip File.";
    }
}

function downloadAllZip($path) {
    // Tạo tên tệp zip dựa trên tên thư mục
    $zipFileName = basename($path) . '_all.zip';

    // Tạo đối tượng ZipArchive
    $zip = new ZipArchive();

    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        // Đệ quy thêm tất cả các tệp và thư mục vào tệp zip
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $itemPath = $item->getRealPath();
            $relativePath = substr($itemPath, strlen($path) + 1);

            if ($item->isDir()) {
                $zip->addEmptyDir($relativePath);
            } else {
                $zip->addFile($itemPath, $relativePath);
            }
        }

        // Đóng tệp zip
        $zip->close();

        // Thiết lập các header để tải xuống tệp zip
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        header('Content-Length: ' . filesize($zipFileName));

        // Gửi nội dung của tệp zip
        readfile($zipFileName);

        // Xóa tệp zip sau khi tải xuống
        unlink($zipFileName);
    } else {
        // Hiển thị thông báo lỗi nếu không thể tạo tệp zip
        echo "Cannot creating Zip File.";
    }
}
?>


