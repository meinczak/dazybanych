<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <div class="logo">BookShelf</div>
        <div class="buttons">
            <div class="logout">Log-Out</div>
        </div>
    </header>
    <main>
        <div class="books">
            <?php
            $conn = new mysqli('localhost', 'root', '', 'ksiazkimanczak');

            $sql = "SELECT cover, name, id FROM books";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<form class='box' action='book.php' method='GET'>".$row["name"]."<img src='" . $row["cover"] . "'><input type='text' name='bookID' style='display: none;' value='".$row["id"]."' readonly><button>MORE INFO</button></form>";
            }

            ?>
        </div>
    </main>
</body>

</html>