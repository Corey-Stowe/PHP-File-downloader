<body>
    <div class="container">
        <h1 class="mt-4">PHP File Downloader</h1>
        <div class="user-act mt-4">
            <p class="user-name">Hello: <?php  echo $username ?></p>
           <?php
            if($login == false){
                echo "";
            } else {
                ?>
                 <button class="btn btn-danger btn-sm" onclick="location.href='?act=logout'">logout</button>
                <?php
            }
           
           ?>
            <button class="btn btn-primary btn-sm" onclick="window.location.href='?act=downloadall&downloadall=<?php echo urlencode($path); ?>'">Download All</button>

        </div>
        <div class="table-file mt-4">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">File Name</th>
                        <th scope="col">File Size</th>
                        <th scope="col">File Time</th>
                        <th scope="col">File Type</th>
                        <th scope="col">Action</th>
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
                                echo '<td>' . getFileSize($itemPath) . '</td>';
                            }
                            echo '<td>' . date("d/m/Y", filemtime($itemPath)) . '</td>';
                            echo '<td>' . (is_dir($itemPath) ? 'Folder' : 'File') . '</td>';
                            ?>
                                 <td>
                            <?php
                            if (is_dir($itemPath)) {
                                echo '<form method="post" action="?act=download&downloadzip=' . urlencode($itemPath) . '">';
                                echo '<button type="submit" class="btn btn-primary btn-sm">Download All (ZIP)</button>';
                                echo '</form>';
                            } elseif (!is_dir($itemPath)) {
                                echo '<form method="post" action="?act=download&download=' . urlencode($itemPath) . '">';
                                echo '<button type="submit" class="btn btn-primary btn-sm">Download All</button>';
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
</body>
