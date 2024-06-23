<?php

require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE username = :username";
            $statement = $pdo->prepare($query);
            $statement->execute([':username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('012704' === $password) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: posts.php");
                    exit;
                } else {
                    echo "Invalid password!";
                }
            } else {
                echo "User not found!";
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
            margin: 0;
            background-image: url(STARRY\ NIGHT.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
        }

        .log-in.container {
            width: 300px;
            padding: 20px;
            background-color: #0d20ccd8;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgb(0, 7, 97);
        }

        .log-in.container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
            font-size: 2.12em; 
        }

        .log-in.container form input[type="text"],
        .log-in.container form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #f8f400;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .log-in.container form button {
            width: 100%;
            padding: 10px;
            background-color: #ffee00dc;
            border: none;
            border-radius: 4px;
            color: #000000;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .log-in.container form button:hover {
            background-color: #ffee00;
        }
    </style>
</head>    
<!-- <body>
    <div class="log-in container">
    <h1>Log-in</h1>
    <form id="loginForm">
        <input type="text" placeholder="Enter username" required>
        <input type="password" placeholder="Enter Password" required>
        <button>Log-in</button>
    </form>
  </div>
</body> -->

<body>
    <div class="log-in container">
        <h1>Log-in</h1>
        <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="text" id="username" placeholder="Enter username" name="username" required>
            <input type="password" id="password" placeholder="Enter password" name="password" required>
            <button id="submit">Log-in</button>
        </form>
    </div>
</body>


<script>

    /* document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
    
        const username = document.querySelector('input[type="text"]').value;
        const password = document.querySelector('input[type="password"]').value;
    
        fetch("https://jsonplaceholder.typicode.com/users")
            .then(response => response.json())
            .then(users => {
                const user = users.find(user => user.username === username);
                console.log(user);
                if (user) {
                    if(password === "Lorenzpogi") {
                        window.location.href = "posts.html";
                    } else {
                        alert("Invalid Password");
                    }
                } else {
                    alert("User not found !!!");
                }
            })
            .catch(error => alert("Error fetching users:", error));
    }); */
    </script>
</html>

