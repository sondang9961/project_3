<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
<style type="text/css">
	#right_content { width: 50%; margin-left: 160px;}
	#textbox {border-radius: 8px ; width: 200px}
	#button {color: white; background-color: #484646; width: 90px; height: 30px; border-radius: 40px}
</style>
</head>
<body style="background: url(../Images/background_2.jpg)">
	<center><h1>Quản lý sách</h1></center>
	<table width="100%">
		<tr valign="top">
			<td>
				<div id="left_content">
					<div><h2>Danh sách các đầu sách</h2></div>
					<table border="1">
						<tr>
							<th>Mã</th>
							<th>Tên sách</th>
							<th>Tên môn</th>
							<th>Ngày nhập sách</th>
							<th>Số lượng nhập</th>
							<th>Ngày hết hạn đăng ký</th>
							<th>Chức năng</th>
						</tr>
						@foreach ($array_sach as $sach)
						<tr>
							<td></td>
						</tr>
						@endforeach
					</table>
				</div>
			</td>
			<td>
				<div id="right_content" >
					<div><h2>Thêm sách</h2></div>
						<div>
							<form>
								<div>Tên sách</div>	
								<div><input type="text" name="ten_sach" id="textbox"></div><br>
								<div>Tên môn</div>
								<div>
									<select>
										<option>--Tên môn học--</option>
									</select>
								</div><br>
								<div>Ngày nhập sách</div>
								<div><input type="date" name="ngay_nhap_sach"></div><br>
								<div>Số lượng nhập</div>
								<div><input type="number" name="so_luong_nhap"></div><br>
								<div>Ngày hết hạn</div>
								<div><input type="date" name="ngay_het_han"></div><br>
								<div><input type="button" value="Thêm" id="button"></div>
							</form>
						</div>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>