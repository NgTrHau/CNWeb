<?php

define('TITLE', 'Xem tất cả các Trích dẫn');
include '../partials/header.php';

echo '<h2>Tất cả các Trích dẫn</h2>';

include '../partials/check_admin.php';

include '../partials/mysqli_connect.php';

$query = 'SELECT id, quote, source, favorite FROM quotes ORDER BY date_entered DESC';

if ($result = mysqli_query($dbc, $query)){
    
    while ($row = mysqli_fetch_array($result)) {

        $htmlspecialchars = 'htmlspecialchars';
        echo "<div><blockquote>{$htmlspecialchars($row['quote'])}</blockquote>{$htmlspecialchars($row['source'])}<br>";

        if ($row['favorite'] == 1) {
            echo '<strong>Yêu Thích!</strong>';
        }

        echo "<p><b>Quản trị Trích dẫn: </b> <a href=\"edit_quote.php?id={$row['id']}\"> Sửa </a><a href=\"delete_quote.php?id={$row['id']}\">Xóa</a></p></div><br>";
    }
} else {
    echo '<p class="error">Không thể lấy dữ liệu vì: <br>' . mysqli_error($dbc) . 
            '.</p><p>Câu truy vấn là: ' . $query . '</p>';
}

mysqli_close($dbc);

include '../partials/footer.php';
?>