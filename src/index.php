<!DOCTYPE html>
<html>
<head>
    <title>Bookstore Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <style>
        body {
            margin: 0;
            padding-top: 60px; /* Leaves room for navbar */
            font-family: Arial, sans-serif;
        }

        .section {
            padding: 60px 20px;
            text-align: center;
        }

        iframe, video, audio, canvas {
            display: block;
            margin: 20px auto;
            max-width: 90%;
        }

        canvas {
            border: 1px solid #ccc;
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: #222;
            z-index: 999;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body class="is-preload">

    <?php include 'navbar.php'; ?>

    <section class="section">
        <h2>Welcome to Our Bookstore</h2>
        <p>Discover, explore, and purchase your favorite books — all in one place!</p>
    </section>

    <section class="section">
        <h2>Featured Video</h2>
        <p>Watch our introduction to the bookstore</p>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/YOUR_VIDEO_ID" 
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
    </section>

    <section class="section">
        <h2>Bookstore Tour (MP4)</h2>
        <p>A quick visual tour of the store layout and sections</p>
        <video width="640" height="360" controls>
            <source src="media/tour.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <section class="section">
        <h2>Our Jingle (MP3)</h2>
        <p>Listen to our catchy bookstore tune!</p>
        <audio controls>
            <source src="media/jingle.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </section>

    <section class="section">
        <h2>Interactive Canvas</h2>
        <p>Check out this fun drawing</p>
        <canvas id="myCanvas" width="400" height="200"></canvas>
        <script>
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = 'lightblue';
            ctx.fillRect(0, 0, 400, 200);
            ctx.fillStyle = 'darkblue';
            ctx.font = '24px Arial';
            ctx.fillText('Welcome to the Bookstore!', 50, 100);
        </script>
    </section>

    <section class="section">
        <h2>Find Us on the Map</h2>
        <p>We're right near Alexandru Ioan Cuza University</p>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10848.625868408531!2d27.561204274859!3d47.1743730247819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb61af5ef507%3A0x95f1e37c73c23e74!2sAlexandru%20Ioan%20Cuza%20University!5e0!3m2!1sen!2sro!4v1748511768524!5m2!1sen!2sro" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

    <footer id="footer">
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
        </ul>
        <p>&copy; Your Bookstore</p>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
