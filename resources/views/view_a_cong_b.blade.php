<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="xu_ly_nhap">
		{{ csrf_field() }}
		a <input type="number" name="a"><br>
		b <input type="number" name="b"><br>
		<input type="submit" value="Kết quả">
	</form>
</body>
</html>