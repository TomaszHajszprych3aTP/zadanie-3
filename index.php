<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <style>
        body{
            background-color: bisque;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

    <?php
    $server = "localhost";
    $name = "admin";
    $sqlpass = "pass";
    $dbname = "userDataBase";


    $conn = new mysqli($server, $name, $sqlpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $UserLogin = $_POST['login'];
        $UserPassword = $_POST['haslo'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE logins = ?");
        $stmt->bind_param("s", $UserLogin);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($UserPassword == $row['pass']) {
                echo "Zalogowano pomyślnie";
            } else {
                echo "Błędne hasło";
            }
        } else {
            echo "Nieprawidłowy login";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login">Podaj Login</label>
        <input type="text" id="login" name="login" required><br>
        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo" required><br>
        <button type="submit">Zaloguj</button>
    </form>

</body>
</html>