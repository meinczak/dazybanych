<?php
if(!isset($_COOKIE['MUserID'])) {
    header("Location: login.php");
    exit();
}

$conn2 = new mysqli('localhost', 'root', '', 'ksiazkimanczak');

ini_set('display_errors', 0);
error_reporting(0);
$bookID = $_GET["bookID"];
$stars = $_GET["rating"];
$text = $_GET["review-text"];

// Make sure $text is quoted in the SQL string
$sqlINSERT = "INSERT INTO reviews (user_id, book_id, stars, text) VALUES ($_COOKIE[MUserID], $bookID, $stars, '$text')";

// Remove echoes before header (they break the redirect)
$resultINS = $conn2->query($sqlINSERT);

if (isset($_GET["rating"], $_GET["review-text"], $_GET["bookID"])) {
    // insert into database...
    header("Location: book.php?bookID=".$bookID);
    exit();
}

$conn2->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - The Vintage Bookshelf</title>
    <link rel="stylesheet" href="book.css">
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
                    <a href="index.php" class="vintage-btn back-btn">
                        <span>Return to Collection</span>
                    </a>
                        <a href="login.php" class="vintage-btn back-btn">
                            <span>Depart</span>
                        </a>

                </div>
            </div>
            <div class="ornate-border-bottom"></div>
        </header>

        <main class="main-content">
            <div class="book-container">
                <!-- Book Details Section -->
                <aside class="book-details">
                    <div class="book-frame">
                        <div class="book-corner tl"></div>
                        <div class="book-corner tr"></div>
                        <div class="book-corner bl"></div>
                        <div class="book-corner br"></div>
                        
                        <div class="book-content">
                            <?php
                            $conn = new mysqli('localhost', 'root', '', 'ksiazkimanczak');
                            // Sample book data - replace with your database query
                            $bookID = $_GET["bookID"];
                            $sql = "SELECT id, name, cover, category, author FROM books WHERE id = ".$bookID;
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            $sql2 = "SELECT reviews.stars, reviews.text, users.login FROM reviews LEFT JOIN users on reviews.user_id = users.id WHERE reviews.book_id = ".$bookID;
                            $result2 = $conn->query($sql2);
                        
                            $sql3 = "SELECT AVG(stars) as AVGS FROM reviews WHERE book_id = ".$bookID;
                            $result3 = $conn->query($sql3);
                            $row3 = $result3->fetch_assoc();
                            $average_rating = $row3["AVGS"];

                            $sql4 = "SELECT count(id) AS count FROM reviews WHERE book_id = ".$bookID;
                            $result4 = $conn->query($sql4);
                            $row4 = $result4->fetch_assoc();
                            $conn->close();
                            ?>
                            
                            <div class="book-image-container">
                                <img src="<?php echo $row['cover']; ?>" alt="<?php echo $row['name']; ?>" class="book-cover">
                                <div class="vintage-overlay"></div>
                            </div>
                            
                            <div class="book-info">
                                <h2 class="book-title"><?php echo $row['name']; ?></h2>
                                <p class="book-author">by <?php echo $row['author']; ?></p>
                                <p class="book-genre"><?php echo $row['category']; ?></p>
                                
                                <div class="book-divider">❦</div>
                                
                                <div class="rating-section">
                                    <div class="stars">
                                        
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= floor($average_rating)) {
                                                echo '<span class="star filled">★</span>';
                                            } elseif ($i <= ceil($average_rating) && $average_rating > floor($average_rating)) {
                                                echo '<span class="star half">★</span>';
                                            } else {
                                                echo '<span class="star empty">☆</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="rating-info">
                                        <span class="rating-number"><?php echo round($average_rating, 1); ?></span>
                                        <span class="rating-count">(<?php echo $row4["count"]; ?> reviews)</span>
                                    </div>
                                </div>
                                
                                <div class="book-divider">❦</div>
                                
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Comments Section -->
                <section class="comments-section">
                    <div class="section-title">
                        <div class="title-ornament">✦</div>
                        <h2>Reader Reviews</h2>
                        <div class="title-ornament">✦</div>
                    </div>

                    <!-- Review Form -->
                    <form class="review-form-section" id="reviewForm" method="GET" action="book.php">
                        <input type="text" style="display:none;" value="<?php echo $_GET["bookID"] ?>" name="bookID" readonly>
                        <div class="filters-section">
                            <div class="filter-title">
                                <span class="decorative-line">━━━━━━━</span>
                                <span class="filter-text">Share Your Thoughts</span>
                                <span class="decorative-line">━━━━━━━</span>
                            </div>
                            <div class="review-form">
                                <div class="form-row" style="width: 100%;">
                                    <div class="filter-group" style="width: 100%;">
                                        <label for="rating" class="filter-label">Rating:</label>
                                        <div class="star-rating">
                                            <input type="radio" name="rating" value="5" id="star5">
                                            <label for="star5">★</label>
                                            <input type="radio" name="rating" value="4" id="star4">
                                            <label for="star4">★</label>
                                            <input type="radio" name="rating" value="3" id="star3">
                                            <label for="star3">★</label>
                                            <input type="radio" name="rating" value="2" id="star2">
                                            <label for="star2">★</label>
                                            <input type="radio" name="rating" value="1" id="star1">
                                            <label for="star1">★</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-group">
                                    <label for="review-text" class="filter-label">Your Review:</label>
                                    <textarea id="review-text" name="review-text" class="vintage-textarea" placeholder="Share your thoughts about this book..." rows="4" required></textarea>
                                </div>
                                <div class="form-buttons">
                                    <button type="submit" class="vintage-btn filter-btn">Submit Review</button>
                                </div>
                                    </div>
                        </div>
                    </form>
                    

                    <!-- Reviews List -->
                    <div class="reviews-grid">
                        <?php while ($row2 = $result2->fetch_assoc()): ?>
                        <div class="review-card">
                            <div class="book-frame">
                                <div class="book-corner tl"></div>
                                <div class="book-corner tr"></div>
                                <div class="book-corner bl"></div>
                                <div class="book-corner br"></div>
                                <div class="review-content">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <h4 class="reviewer-name"><?php echo htmlspecialchars($row2['login']); ?></h4>
                                            <div class="review-stars">
                                                <?php

                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $row2['stars']) {
                                                        echo '<span class="star filled">★</span>';
                                                    } else {
                                                        echo '<span class="star empty">☆</span>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="book-divider">❦</div>
                                    <div class="review-text">
                                        <p><?php echo htmlspecialchars($row2['text']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </section>
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
