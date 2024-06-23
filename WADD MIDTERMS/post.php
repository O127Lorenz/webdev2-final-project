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

        .post-container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(13, 32, 205, 0.85);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 7, 97, 0.5);
            color: #ffffff;
        }

        .post-container h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .post-container .post-details {
            color: #000000;
            font-size: 16px;
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
    <div class="post-container">
        <h1>Post Page</h1>
        <div id="postDetails">
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
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $query = "SELECT * FROM `posts` WHERE id = :id";
                        $statement = $pdo->prepare($query);
                        $statement->execute([':id' => $id]);

                        $post = $statement->fetch(PDO::FETCH_ASSOC);

                        if ($post) {
                            echo '<h3>Title: ' . $post['title'] . '</h3>';
                            echo '<p>Body: ' . $post['body'] . '</p>';
                        } else {
                            echo "No post found with ID $id!";
                        }
                    } else {
                        echo "No post ID provided!";
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
        <button class="back-button" onclick="goBack()">Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>