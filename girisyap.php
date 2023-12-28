<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Ekranı</title>
    <style>



        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color:#ffcc8e
        }

        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 15px;
        }

        b {
            font-size: 1.2em;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>



</head>

<body>
    <br><br><br><br><br><br>
    <form name="form1" method="post">
        <b>Giriş Yapmak İçin Şifreyi Giriniz</b>
        <br>
        <input type="password" value="" name="password" maxlength="15">
        <br>
        <input type="submit" value="Giriş" name="giris">
    </form>
</body>

</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$password = $_POST["password"];

    
    if ($password === "berkay") {
        header("Location: anasayfa.html");
        exit();
    } else 
    {
        echo "<script>alert('Hatalı şifre! Lütfen tekrar deneyin.');</script>";
    }
}
?>

