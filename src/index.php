<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookstore Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        /* RESET */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(45deg, #645862, #1b1f2a);
            color: #333;
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: #1e1e2f;
            z-index: 1000;
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 15px;
            margin: 0;
            gap: 30px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .spacer {
            height: 70px; /* to offset the fixed navbar */
        }

        .section {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px 20px;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            text-align: center;
        }

        iframe, video, audio, canvas {
            display: block;
            margin: 20px auto;
            max-width: 100%;
        }

        canvas {
            border: 2px dashed #ccc;
        }

        footer {
            background: #1e1e2f;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        footer .icons {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 10px;
        }

        footer .icons li a {
            color: white;
            font-size: 1.6em;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>
    <div class="spacer"></div>

    <section class="section">
        <h2>Welcome to Our Bookstore</h2>
        <p>Discover and explore the best collection of books right from your browser.</p>
    </section>
    <section class="section">
        <h2>Like and Share Our Website</h2>
        <div style="display: flex; justify-content: center; gap: 20px; align-items: center;">
            <button onclick="likeSite()" style="background: #4267B2; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 1em;">
                👍 Like (<span id="like-count">0</span>)
            </button>
            <button onclick="shareSite()" style="background: #1DA1F2; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 1em;">
                🔗 Share (copied!)
            </button>
        </div>
    </section>

    <script>
        let likeCount = localStorage.getItem('siteLikes') || 0;
        document.getElementById('like-count').textContent = likeCount;

        function likeSite() {
            likeCount++;
            localStorage.setItem('siteLikes', likeCount);
            document.getElementById('like-count').textContent = likeCount;
        }

        function shareSite() {
            navigator.clipboard.writeText("http://localhost:8080/index.php");
            alert("Link copied to clipboard!");
        }
    </script>

    <section class="section">
        <h2>Watch Our Intro</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/YOUR_VIDEO_ID"
                title="Bookstore Intro" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>
    </section>

    <section class="section">
        <h2>Video Tour (MP4)</h2>
        <p>Get a quick overview of our store in this video.</p>
        <video controls width="640" height="360">
            <source src="media/tour.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <section class="section">
        <h2>Listen to Our Jingle (MP3)</h2>
        <audio controls>
            <source src="media/jingle.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </section>

    <section class="section">
        <h2>Canvas Fun</h2>
        <canvas id="myCanvas" width="400" height="200"></canvas>
        <script>
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#b3e5fc';
            ctx.fillRect(0, 0, 400, 200);
            ctx.fillStyle = '#0277bd';
            ctx.font = '20px sans-serif';
            ctx.fillText("Welcome to our bookstore!", 70, 100);
        </script>
    </section>

    <section class="section">
        <h2>Find Us Near UAIC</h2>
        <p>Our bookstore is just steps away from the university.</p>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10848.625868408531!2d27.561204274859!3d47.1743730247819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb61af5ef507%3A0x95f1e37c73c23e74!2sAlexandru%20Ioan%20Cuza%20University!5e0!3m2!1sen!2sro!4v1748511768524!5m2!1sen!2sro" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

    <footer>
        <ul class="icons">
            <li><a href="https://www.facebook.com/cosmin.tincu.773/" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://instagram.com/cosmintincuu/" target="_blank"><i class="fab fa-instagram"></i></a></li>
        </ul>

        <p>&copy; 2025 Your Bookstore</p>
    </footer>

</body>
</html>
