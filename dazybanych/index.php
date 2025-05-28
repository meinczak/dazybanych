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
                    <button class="vintage-btn logout-btn">
                        <span>Depart</span>
                    </button>
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
    <div class="filters">
        <div class="filter-group">
            <label for="search" class="filter-label">Search by Title:</label>
            <input type="text" id="search" class="vintage-input" placeholder="Enter book title...">
        </div>
        <div class="filter-group">
            <label for="genre" class="filter-label">Genre:</label>
            <select id="genre" class="vintage-select">
                <option value="">All Genres</option>
                <option value="fiction">Fiction</option>
                <option value="mystery">Mystery</option>
                <option value="romance">Romance</option>
                <option value="history">History</option>
                <option value="science">Science</option>
                <option value="fantasy">Fantasy</option>
                <option value="biography">Biography</option>
                <option value="thriller">Thriller</option>
            </select>
        </div>
        <div class="filter-group">
            <label for="author" class="filter-label">Author:</label>
            <input type="text" id="author" class="vintage-input" placeholder="Author name...">
        </div>
        <div class="filter-group">
            <label for="sortBy" class="filter-label">Sort By:</label>
            <select id="sortBy" class="vintage-select">
                <option value="default">Default Order</option>
                <option value="alphabetical-asc">Alphabetical (A-Z)</option>
                <option value="alphabetical-desc">Alphabetical (Z-A)</option>
                <option value="rating-high">Rating (High to Low)</option>
                <option value="rating-low">Rating (Low to High)</option>
                <option value="available">Available First</option>
                <option value="unavailable">Unavailable First</option>
            </select>
        </div>
        <button class="vintage-btn filter-btn" onclick="applyFilters()">
            <span>Apply Filters</span>
        </button>
        <button class="vintage-btn clear-btn" onclick="clearFilters()">
            <span>Clear All</span>
        </button>
    </div>
</div>

            <div class="books-section">
                <div class="section-title">
                    <div class="title-ornament">✦</div>
                    <h2>Literary Collection</h2>
                    <div class="title-ornament">✦</div>
                </div>
                
                <div class="books-grid" id="booksGrid">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'ksiazkimanczak');

                    $sql = "SELECT cover, name, id FROM books";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        // Generate sample data for demo purposes - you can replace with actual database fields
                        $genres = ['fiction', 'mystery', 'romance', 'history', 'science', 'fantasy', 'biography', 'thriller'];
                        $authors = ['Jane Austen', 'Stephen King', 'Agatha Christie', 'J.K. Rowling', 'George Orwell', 'Harper Lee', 'Mark Twain', 'Charles Dickens'];
                        $sampleGenre = $genres[array_rand($genres)];
                        $sampleAuthor = $authors[array_rand($authors)];
                        $sampleRating = rand(1, 5);
                        $sampleAvailable = rand(0, 1);
                        
                        echo "<div class='book-card' 
                                   data-title='" . strtolower($row["name"]) . "' 
                                   data-genre='" . $sampleGenre . "' 
                                   data-author='" . strtolower($sampleAuthor) . "' 
                                   data-rating='" . $sampleRating . "' 
                                   data-available='" . $sampleAvailable . "' 
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
                                                <p class='book-author'>by " . $sampleAuthor . "</p>
                                                <p class='book-genre'>" . ucfirst($sampleGenre) . "</p>
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
                    ?>
                </div>
            </div>
        </main>

        <footer class="vintage-footer">
            <div class="footer-ornament">❦ ❦ ❦</div>
            <p>Preserving Literary Heritage Since Time Immemorial</p>
            <div class="footer-ornament">❦ ❦ ❦</div>
        </footer>
    </div>

    <script>
let originalOrder = [];
let currentBooks = [];

document.addEventListener('DOMContentLoaded', function() {
    const books = document.querySelectorAll('.book-card');
    originalOrder = Array.from(books);
    currentBooks = Array.from(books);
    
    // Add real-time search
    document.getElementById('search').addEventListener('input', applyFilters);
    document.getElementById('genre').addEventListener('change', applyFilters);
    document.getElementById('author').addEventListener('input', applyFilters);
    document.getElementById('sortBy').addEventListener('change', applyFilters);
});

function applyFilters() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const selectedGenre = document.getElementById('genre').value.toLowerCase();
    const authorTerm = document.getElementById('author').value.toLowerCase();
    const sortBy = document.getElementById('sortBy').value;
    
    const books = Array.from(document.querySelectorAll('.book-card'));
    
    // Filter books
    let filteredBooks = books.filter(book => {
        const title = book.dataset.title;
        const genre = book.dataset.genre;
        const author = book.dataset.author;
        
        const matchesTitle = !searchTerm || title.includes(searchTerm);
        const matchesGenre = !selectedGenre || genre === selectedGenre;
        const matchesAuthor = !authorTerm || author.includes(authorTerm);
        
        return matchesTitle && matchesGenre && matchesAuthor;
    });
    
    // Sort filtered books
    switch(sortBy) {
        case 'alphabetical-asc':
            filteredBooks.sort((a, b) => a.dataset.title.localeCompare(b.dataset.title));
            break;
        case 'alphabetical-desc':
            filteredBooks.sort((a, b) => b.dataset.title.localeCompare(a.dataset.title));
            break;
        case 'rating-high':
            filteredBooks.sort((a, b) => parseInt(b.dataset.rating) - parseInt(a.dataset.rating));
            break;
        case 'rating-low':
            filteredBooks.sort((a, b) => parseInt(a.dataset.rating) - parseInt(b.dataset.rating));
            break;
        case 'available':
            filteredBooks.sort((a, b) => parseInt(b.dataset.available) - parseInt(a.dataset.available));
            break;
        case 'unavailable':
            filteredBooks.sort((a, b) => parseInt(a.dataset.available) - parseInt(b.dataset.available));
            break;
        default:
            // Keep current filter order for default
            break;
    }
    
    // Hide all books first
    books.forEach(book => {
        book.style.display = 'none';
    });
    
    // Show filtered and sorted books
    const booksContainer = document.getElementById('booksGrid');
    filteredBooks.forEach(book => {
        book.style.display = 'block';
        book.style.animation = 'fadeIn 0.5s ease-in';
    });
    
    // Update status
    updateFilterStatus(filteredBooks.length, searchTerm, selectedGenre, authorTerm, sortBy);
}

function clearFilters() {
    document.getElementById('search').value = '';
    document.getElementById('genre').value = '';
    document.getElementById('author').value = '';
    document.getElementById('sortBy').value = 'default';
    
    const books = document.querySelectorAll('.book-card');
    books.forEach(book => {
        book.style.display = 'block';
        book.style.animation = 'fadeIn 0.5s ease-in';
    });
    
    updateFilterStatus(books.length, '', '', '', 'default');
}

function updateFilterStatus(count, searchTerm, genre, author, sortBy) {
    let status = `Showing ${count} book(s)`;
    
    if (searchTerm || genre || author || sortBy !== 'default') {
        status += ' with filters: ';
        const filters = [];
        
        if (searchTerm) filters.push(`title contains "${searchTerm}"`);
        if (genre) filters.push(`genre: ${genre}`);
        if (author) filters.push(`author contains "${author}"`);
        if (sortBy !== 'default') {
            const sortLabels = {
                'alphabetical-asc': 'sorted A-Z',
                'alphabetical-desc': 'sorted Z-A',
                'rating-high': 'sorted by rating (high-low)',
                'rating-low': 'sorted by rating (low-high)',
                'available': 'available first',
                'unavailable': 'unavailable first'
            };
            filters.push(sortLabels[sortBy]);
        }
        
        status += filters.join(', ');
    }
    
    console.log(status); // You can display this in a status element if you add one
}
</script>
</body>

</html>
