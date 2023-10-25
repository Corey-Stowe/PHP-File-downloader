<body>
    <div class="container">
        <h1 class="mt-4">Thông tin tập tin</h1>
        <div class="user-act mt-4">
        <p class="user-name">Xin chào: <?php  echo $username ?></p>
            <p class="user-path">Đường dẫn: <?php echo htmlspecialchars($path); ?></p>
<a class="btn btn-secondary btn-sm" href="index.php">Trở về thư mục cha</a>
<button class="btn btn-primary btn-sm" onclick="window.location.href='?act=downloadall=<?php echo urlencode($path); ?>'">Tải tất cả</button>

            <button class="btn btn-danger btn-sm" onclick="location.href='?act=logout'">Đăng xuất</button>
        </div>
        <div class="table-file mt-4">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Tên Tập tin</th>
                        <th scope="col">Kích thước</th>
                        <th scope="col">Ngày sửa</th>
                        <th scope="col">Loại</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($listFiles as $item) {
                        if ($item !== '.' && $item !== '..') {
                            $itemPath = $path . '/' . $item;
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="check"></td>';
                            if (is_dir($itemPath)) {
                                echo '<td><a href="?act=dir&dir=' . urlencode($itemPath) . '">' . htmlspecialchars($item) . '/</a></td>';
                                echo '<td>-</td>'; // Kích thước không áp dụng cho thư mục
                            } else {
                                echo '<td><a href="#">' . htmlspecialchars($item) . '</a></td>';
                                if (file_exists($itemPath)) {
                                    echo '<td>' . filesize($itemPath) . ' bytes</td>';
                                    echo '<td>' . date("d/m/Y", filemtime($itemPath)) . '</td>';
                                } else {
                                    echo '<td>Không xác định</td>';
                                    echo '<td>Không xác định</td>';
                                }
                            }
                            echo '<td>' . (is_dir($itemPath) ? 'Thư mục' : 'Tệp Tin') . '</td>';
                            ?>
                           <td>
                    <?php
                    if (is_dir($itemPath)) {
                        echo '<form method="post" action="?act=dowload&downloadzip' . urlencode($itemPath) . '">';
                        echo '<button type="submit" class="btn btn-primary btn-sm">Tải xuống (ZIP)</button>';
                        echo '</form>';
                    } elseif (!is_dir($itemPath)) {
                        echo '<form method="post" action="?act=download&download=' . urlencode($itemPath) . '">';
                        echo '<button type="submit" class="btn btn-primary btn-sm">Tải xuống</button>';
                        echo '</form>';
                    }
                    ?>
                            <?php
                    
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>