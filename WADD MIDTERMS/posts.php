<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post page</title>
    <style>
        body {
            background-image: url('IRL\ SN.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .posts.container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(13, 32, 205, 0.85);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 7, 97, 0.5);
        }

        .posts.container h1 {
            color: #ffffff;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .posts.container form input[type="text"],
        .posts.container form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ffffff;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.9);
            color: #000000;
            font-size: 16px;
        }

        .posts.container form button {
            width: 100%;
            padding: 12px;
            background-color: #ffee00dc;
            border: none;
            border-radius: 4px;
            color: #000000;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .posts.container form button:hover {
            background-color: #ffee00;
        }

        .posts.container ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .posts.container ul li {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .posts.container ul li:hover {
            background-color: #f8f400;
        }

        .posts.container ul li a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .posts.container ul li::before {
            content: "\2022"; /* Bullet point */
            color: #0d20ccd8; /* Same color as container background */
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ffee00dc;
            border: none;
            border-radius: 4px;
            color: #000000;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .back-button:hover {
            background-color: #ffee00;
        }
    </style>
</head>

<body>
    <div class="posts container">
        <h1>Posts Page</h1>
        <ul id="postLists">
            <?php
            require 'config.php';

            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php");
                exit;
            }

            $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            try {
                $pdo = new PDO($dsn, $user, $password, $options);

                if ($pdo) {
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT * FROM `posts` WHERE user_id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $user_id]);

                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {
                        echo '<li><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></li>';
                    }

                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </ul>
        <button class="back-button" onclick="goBack()">log-out</button>
    </div>

    <script>
        function goBack() {
            window.location.href="logout.php";
        }
    </script>
</body>

</html>