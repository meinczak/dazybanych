<?php
if(!isset($_COOKIE['MUserID'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Vintage Bookshelf</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Crimson+Text:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <div class="vintage-paper">
        <header class="vintage-header">
            <div class="ornate-border-top"></div>
            <div class="header-content">
                <div class="logo">
                    <div class="logo-ornament">❦</div>
                    <h1>The Vintage Bookshelf</h1>
                    <div class="logo-subtitle">~ A Collection of Literary Treasures ~</div>
                    <div class="logo-ornament">❦</div>
                </div>
                <div class="header-buttons">
                     <a href="login.php" class="vintage-btn logout-btn">
                        <span>Depart</span>
                    </a>
                </div>
            </div>
            <div class="ornate-border-bottom"></div>
        </header>

        <main class="main-content">
            <div class="filters-section">
    <div class="filter-title">
        <span class="decorative-line">━━━━━━━</span>
        <span class="filter-text">Curate Your Collection</span>
        <span class="decorative-line">━━━━━━━</span>
    </div>
    <form class="filters" method="get" action="index.php">
        <div class="filter-group">
            <label for="search" class="filter-label">Search by Title:</label>
            <input type="text" name="search" id="search" class="vintage-input" placeholder="Enter book title...">
        </div>
        <div class="filter-group">
            <label for="genre" class="filter-label">Genre:</label>
            <select name="genre" id="genre" class="vintage-select">
                <option value="default">All Genres</option>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'ksiazkimanczak');
                $sql = "SELECT DISTINCT category FROM books";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<option>".$row["category"]."</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>
        <div class="filter-group">
            <label for="author" class="filter-label">Author:</label>
            <input type="text" id="author" name="author" class="vintage-input" placeholder="Author name...">
        </div>
        <div class="filter-group">
            <label for="sortBy" class="filter-label">Sort By:</label>
            <select id="sortBy" name="sortBy" class="vintage-select">
                <option value="default">Default Order</option>
                <option value="alphabetical-asc">Alphabetical (A-Z)</option>
                <option value="alphabetical-desc">Alphabetical (Z-A)</option>
            </select>
        </div>
        <input type="submit" class="vintage-btn filter-btn" value="Apply Filters">
        <input type="reset" class="vintage-btn clear-btn" value="Clear All">
    </form>
</div>

            <div class="books-section">
                <div class="section-title">
                    <div class="title-ornament">✦</div>
                    <h2>Literary Collection</h2>
                    <div class="title-ornament">✦</div>
                </div>
                
                <div class="books-grid" id="booksGrid">
                    <?php
                    ini_set('display_errors', 0);
                    error_reporting(0);
                    $conn = new mysqli('localhost', 'root', '', 'ksiazkimanczak');
                    $search = $_GET["search"];
                    $genre = $_GET["genre"];
                    $author = $_GET["author"];
                    $sortBy = $_GET["sortBy"];
                    $SQLsort;
                    $SQLgenre = ""; 

                    $sql2 = "WHERE author LIKE '%".$author."%' AND name LIKE '%".$search."%' ";
                    
                    switch ($sortBy) {
                        case "default":
                            $SQLsort = "";
                            break;
                        case "alphabetical-asc":
                            $SQLsort = "ORDER BY name ASC";
                            break;
                        case "alphabetical-desc":
                            $SQLsort = "ORDER BY name DESC";
                            break;
                    }

                    if ($genre != "default" && $genre != "") {
                        $SQLgenre = "AND category = '".$genre."'";
                    }

                    $sql = "SELECT cover, name, author, id, category FROM books ". $sql2 . $SQLgenre . $SQLsort;
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        
                        echo "<div class='book-card' 
                                   data-title='" . strtolower($row["name"]) . "' 
                                   data-original-order='" . $row["id"] . "'>
                                <div class='book-frame'>
                                    <div class='book-corner tl'></div>
                                    <div class='book-corner tr'></div>
                                    <div class='book-corner bl'></div>
                                    <div class='book-corner br'></div>
                                    <div class='book-content'>
                                        <div class='book-image-container'>
                                            <img src='" . $row["cover"] . "' alt='" . $row["name"] . "' class='book-cover'>
                                            <div class='vintage-overlay'></div>
                                        </div>
                                        <div class='book-info'>
                                            <h3 class='book-title'>" . $row["name"] . "</h3>
                                            <div class='book-meta'>
                                                <p class='book-author'>by " . $row["author"] . "</p>
                                                <p class='book-genre'>" . $row["category"] . "</p>
                                            </div>
                                            <div class='book-divider'>❦</div>
                                            <form action='book.php' method='GET' class='book-form'>
                                                <input type='hidden' name='bookID' value='" . $row["id"] . "'>
                                                <button type='submit' class='vintage-btn book-btn'>
                                                    <span>Examine Volume</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              </div>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </main>

        <footer class="vintage-footer">
            <div class="footer-ornament">❦ ❦ ❦</div>
            <p>Wykonał Mikołaj Mańczak</p>
            <div class="footer-ornament">❦ ❦ ❦</div>
        </footer>
    </div>
</body>

</html>
