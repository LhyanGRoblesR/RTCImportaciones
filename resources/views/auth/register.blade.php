<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <form action="/register" method="POST">
        @csrf
        <input type="text" name="name">
        <input type="text" name="phone">
        <input type="text" name="id_document_types">
        <input type="text" name="document">
        <input type="text" name="id_users_roles">
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
        <input type="text" name="ruc">
        <input type="text" name="country">
        <input type="text" name="department">
        <input type="text" name="province">
        <input type="text" name="district">
        <input type="text" name="address">
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
