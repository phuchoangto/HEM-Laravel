<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="/upload">
    @csrf
    <input type="file" name="image" />
    <input type="submit" />
</form>
</body>
</html>