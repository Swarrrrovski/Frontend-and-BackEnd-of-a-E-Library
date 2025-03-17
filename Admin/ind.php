 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vault E-Library</title>
    <link rel="stylesheet" href="sty.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <style>
        /* Hide slider arrows initially */
        .slick-prev,
        .slick-next {
            display: none !important;
        }

        /* Show arrows when hovering over quote slider */
        .quote-slider:hover .slick-prev,
        .quote-slider:hover .slick-next {
            display: block !important;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#" class="logo-NAME">
                <span class="logo-name-design">Vault</span>
            </a>
        </div>
        <div class="logo-name">
            <a href="#vault">
                <h3>E-Library</h3>
            </a>
            <h5>Online Learning Resources</h5>
        </div>
        <nav class="navbar">
            <a href="#Home">Home</a>
            <a href="user_login.php">User</a>
            <a href=".admin_login.php">Admin</a>
            <a href="Books.php">Books</a>
            <a href="Feedbackform.html">Contact Us</a>
        </nav>
    </header>
    
    <section class="quote-slider">
        <h2>Inspirational Quotes</h2>
        <br class="spacing">
        <br>
        <div class="slider">
            <div class="slide"><p>"The only limit to our realization of tomorrow is our doubts of today."<br><strong>- Franklin D. Roosevelt</strong></p></div>
            <div class="slide"><p>"Do not dwell in the past, do not dream of the future, concentrate the mind on the present moment."<br><strong>- Buddha</strong></p></div>
            <div class="slide"><p>"It does not matter how slowly you go as long as you do not stop."<br><strong>- Confucius</strong></p></div>
            <div class="slide"><p>"Success is not final, failure is not fatal: it is the courage to continue that counts."<br><strong>- Winston Churchill</strong></p></div>
            <div class="slide"><p>"Believe you can and you're halfway there."<br><strong>- Theodore Roosevelt</strong></p></div>
            <div class="slide"><p>"Opportunities don't happen, you create them."<br><strong>- Chris Grosser</strong></p></div>
            <div class="slide"><p>"The best way to predict the future is to create it."<br><strong>- Peter Drucker</strong></p></div>
            <div class="slide"><p>"Don’t let yesterday take up too much of today."<br><strong>- Will Rogers</strong></p></div>
            <div class="slide"><p>"You miss 100% of the shots you don’t take."<br><strong>- Wayne Gretzky</strong></p></div>
            <div class="slide"><p>"Happiness is not something ready-made. It comes from your own actions."<br><strong>- Dalai Lama</strong></p></div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <h2>About Vault Library</h2>
        <p>
            Vault Library is an innovative <span style="font-style: italic; font-size:20px; font-weight:1000;">online learning platform</span> designed to provide access to a wide range of <span style="font-style: italic; font-size:20px; font-weight:1000;">educational resources, books, and e-books</span>. 
            It was developed with a focus on <span style="font-style: italic; font-size:20px; font-weight:1000;">user-friendly navigation, accessibility, and efficient resource management</span>.
        </p>
        <h3>Development & Features</h3>
        <p>
            The Vault Library was built using modern <span style="font-style: italic; font-size:20px; font-weight:1000;">web technologies</span> including <span style="font-style: italic; font-size:20px; font-weight:1000;">HTML, CSS, JavaScript</span>, and <span style="font-style: italic; font-size:20px; font-weight:1000;">backend integration for book management</span>. 
            The platform includes:
        </p>
        <ul>
            <li> <span style="font-style: italic; font-size:20.5px; font-weight:1000;">Book Management System</span> – Browse and borrow books effortlessly.</li>
            <li> <span style="font-style: italic; font-size:20.5px; font-weight:1000;">Advanced Search</span> – Quickly find books based on categories, authors, or keywords.</li>
            <li> <span style="font-style: italic; font-size:20.5px; font-weight:1000;">User & Admin Dashboards</span> – Personalized spaces for both readers and administrators.</li>
            <li> <span style="font-style: italic; font-size:20.5px; font-weight:1000;">E-Books & Online Resources</span> – Access to a digital library with PDFs and reading materials.</li>
            <li> <span style="font-style: italic; font-size:20.5px; font-weight:1000;">Feedback System</span> – Users can submit feedback to improve the platform.</li>
            <li> <span style="font-style: italic; font-size:20.5px; font-weight:1000;">Modern & Responsive UI</span> – Ensures a smooth experience on both desktop and mobile devices.</li>
        </ul>
        <p>
            Vault Library continues to <span style="font-style: italic; font-size:20px; font-weight:1000;">evolve and improve</span>, providing students, researchers, and book enthusiasts with <span style="font-style: italic; font-size:20px; font-weight:1000;">a seamless digital reading experience</span>.
        </p>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.slider').slick({
                dots: false, // Hide dots
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                pauseOnHover: true,
                prevArrow: '<button type="button" class="slick-prev">&#10094;</button>',
                nextArrow: '<button type="button" class="slick-next">&#10095;</button>'
            });
        });
    </script>
</body>
</html>