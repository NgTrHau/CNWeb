<?php

define('TITLE', 'Thêm một Trích dẫn');
include '../partials/header.php';

echo '<h2>Thêm một Trích dẫn</h2>';

include '../partials/check_admin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(!empty($_POST['quote']) && !empty($_POST['source'])) {

		include "../partials/mysqli_connect.php";

		if (isset($_POST['favorite'])) {
			$favorite = 1;
		} else {
			$favorite = 0;
		}

		$query = "INSERT INTO quotes (quote, source, favorite) VALUES (?, ?, ?)";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, 'ssi', $_POST['quote'], $_POST['source'], $favorite);

		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_affected_rows($stmt) == 1) {
			echo '<p>Trích dẫn của bạn đã được lưu trữ</p>';
		} else {
			echo '<p class="error">Không thể lưu trữ trích dẫn vì:<br>' . mysqli_error($dbc) . '.</p><p>Câu truy vấn là: ' . $query .'</p>';
		}
		mysqli_close($dbc);
	} else {
		echo '<p class="error">Hãy gõ vào cả Trích dẫn và Nguồn của nó!</p>';
	}
}

?>

<form action="add_quote.php" method="post">
	<p><label>Trích dẫn <textarea name="quote" rows="5" cols="30"></textarea></label></p>
	<p><label>Nguồn <input type="text" name="source"></label></p>
	<p><label>Đây là trích dẫn yêu thích? <input type="checkbox" name="favorite" value="yes"></label></p>
	<p><input type="submit" name="submit" value="Thêm Trích dẫn này!"></p>
</form>

<?php include '../partials/footer.php'; ?>