<?php
    $token=$_GET['token'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="conexion/recuperarPassword.php" method="post">
        <input type="hidden" name="token" value=<?php echo "$token";?>>
        <label for="password">
            Nuevo password
        </label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Restablecer">
    </form>
</body>
</html>