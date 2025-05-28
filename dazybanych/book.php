<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="book.css">
</head>

<body>
    <header>
        <div class="logo">BookShelf</div>
        <div class="buttons">
            <div class="logout">Log-Out</div>
        </div>
    </header>
    <main>
        <aside>
            <?php
                $conn = new mysqli('localhost', 'root', '', 'ksiazkimanczak');
                $id = $_GET["bookID"];
                $sql = "SELECT cover, name, id FROM books WHERE id=".$id;
                $result = $conn->query($sql);
            ?>
        </aside>
        <section>

        </section>
    </main>
</body>
</html>