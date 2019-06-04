<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
<style type="text/css">
	#button {background-color: #484646; color: white; border-radius: 40px; width: 50px; height: 30px}
</style>
</head>
<body style="background: url(../Images/background_2.jpg);">
<center>
	<div>
		<h1>Thống kê</h1><br>
		Lớp<select>
			<option>--Tên lớp--</option>
		</select>
		Ngày <input type="date" name="ngay">
		<input type="button" value="Xem" id="button">
		<table width="100%">
		<tr valign="top">
			<td>
				<div id="left_content">
					<div><h2>Thống kê sách</h2></div>
					<table border="1">
						<tr>
							<th>Tên sách</th>
							<th>Tên môn</th>
							<th>Số lượng nhập</th>
							<th>Số lượng đã phát</th>
							<th>Số lượng tồn kho</th>
						</tr>
					</table>
				</div>
			</td>
			<td>
				<div id="right_content" >
					<div><h2>Thống kê sinh viên đăng ký sách</h2></div>
					<table border="1">
						<tr>
							<th>Mã</th>
							<th>Tên sinh viên</th>
							<th>Lớp</th>
							<th>Tình trạng</th>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	</div>
</center>
</body>
</html>