<?php
// Initialize variables
setcookie("MUserID", "", time() - 3600);

$error = "";
$success = "";
$isLogin = true;

$conn = new mysqli('localhost', 'root', '', 'ksiazkimanczak');

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simple form handling - you can expand this later
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'login') {
            // Handle login
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $sql = "SELECT id, login, password FROM users WHERE login='".$login."' AND password='".$password."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                setcookie('MUserID', $row['id'], time() + (86400 * 30), "/");
                $success = "Login attempt recorded for $";
                header("Location: index.php");
                exit();
            } else {
                $error = "Login or password incorrect";
            }

            
            // Redirect after successful login (uncomment when ready)

        } 
        else if ($_POST['action'] == 'register') {
            // Handle registration
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';
            
            // Check if passwords match
            if ($password !== $confirmPassword) {
                $error = "Passwords do not match!";
            } else {
                // You would add your registration logic here
                $sql2 = "SELECT id, login, password FROM users WHERE login='".$login."' AND password='".$password."'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    $error = "User already exists";
                } else {
                    $sql3 = "INSERT INTO users (login, password) VALUES ('".$login."', '".$password."')";
                    $conn->query($sql3);
                    $success = "Registration attempt recorded for $login";
                }
                // For now, just show a success message
                
                // Redirect after successful registration (uncomment when ready)
                // header("Location: index.php");
                // exit();
            }
        }
    }
    $conn->close();
}

// Toggle between login and registration forms
if (isset($_GET['form']) && $_GET['form'] == 'register') {
    $isLogin = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isLogin ? 'Login' : 'Register'; ?> - The Vintage Bookshelf</title>
    <link rel="stylesheet" href="login.css">
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
            </div>
            <div class="ornate-border-bottom"></div>
        </header>

        <main class="main-content">
            <div class="auth-container">
                <div class="auth-card">
                    <div class="book-frame">
                        <div class="book-corner tl"></div>
                        <div class="book-corner tr"></div>
                        <div class="book-corner bl"></div>
                        <div class="book-corner br"></div>

                        <div class="auth-content">
                            <div class="section-title">
                                <div class="title-ornament">✦</div>
                                <h2><?php echo $isLogin ? 'Welcome Back' : 'Join Our Collection'; ?></h2>
                                <div class="title-ornament">✦</div>
                            </div>

                            <?php if (!empty($error)): ?>
                                <div class="error-message">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($success)): ?>
                                <div class="success-message">
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>

                            <div class="book-divider">❦</div>

                            <?php if ($isLogin): ?>
                                <!-- Login Form -->
                                <form class="auth-form" method="POST" action="login.php">
                                    <input type="hidden" name="action" value="login">
                                    <input type="hidden" name="userID" value="<?php if (isset($userID)) {echo $userID;} ?>">
                                    
                                    <div class="filter-group">
                                        <label for="login" class="filter-label">Login</label>
                                        <input id="login" name="login" type="text" class="vintage-input" placeholder="Enter your login" required>
                                    </div>

                                    <div class="filter-group">
                                        <label for="password" class="filter-label">Password:</label>
                                        <input id="password" name="password" type="text" class="vintage-input" placeholder="Enter your password" required>
                                    </div>

                                    <div class="form-buttons">
                                        <button type="submit" class="vintage-btn auth-btn">Enter the Library</button>
                                    </div>
                                </form>
                            <?php else: ?>
                                <!-- Registration Form -->
                                <form class="auth-form" method="POST" action="login.php">
                                    <input type="hidden" name="action" value="register">
                                

                                    <div class="filter-group">
                                        <label for="login" class="filter-label">Login:</label>
                                        <input id="login" name="login" type="text" class="vintage-input" placeholder="Enter your login" required>
                                    </div>

                                    <div class="filter-group">
                                        <label for="password" class="filter-label">Password:</label>
                                        <input id="password" name="password" type="text" class="vintage-input" placeholder="Enter your password" required>
                                    </div>

                                    <div class="filter-group">
                                        <label for="confirmPassword" class="filter-label">Confirm Password:</label>
                                        <input id="confirmPassword" name="confirmPassword" type="text" class="vintage-input" placeholder="Confirm your password" required>
                                    </div>

                                    <div class="form-buttons">
                                        <button type="submit" class="vintage-btn auth-btn">Join the Collection</button>
                                    </div>
                                </form>
                            <?php endif; ?>

                            <div class="book-divider">❦</div>

                            <div class="auth-switch">
                                <p class="switch-text">
                                    <?php echo $isLogin ? 'New to our collection?' : 'Already have an account?'; ?>
                                </p>
                                <a href="login.php<?php echo $isLogin ? '?form=register' : ''; ?>" class="vintage-btn switch-btn">
                                    <?php echo $isLogin ? 'Create Account' : 'Sign In'; ?>
                                </a>
                            </div>
                        </div>
                    </div>
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