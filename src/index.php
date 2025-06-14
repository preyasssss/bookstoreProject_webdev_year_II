<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Acasa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- font-awesome pt iconite -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
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
            height: 70px; 
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
        <h2>Bun venit in libraria noastra online! :D</h2>
        <p>Exploreaza-ne vasta colectie de carti alese in mod special de creatorul site-ului!</p>
    </section>
    <section class="section">
        <h2>Like, Share & Ceas</h2>
        <div id="social-buttons" style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
            <div>
                <button id="like-btn" class="button primary">👍 Like</button>
                <span id="like-count" style="margin-left: 10px; font-weight: bold;">0</span>
            </div>
            <div>
                <button id="share-btn" class="button">🔗 Share</button>
            </div>
            <div>
                <h3>Ceas live:</h3>
                <p id="live-clock" style="font-size: 1.5em; font-weight: bold;"></p>
            </div>
        </div>
        </section>

    <script>
        document.getElementById('like-btn').addEventListener('click', likeSite);
        document.getElementById('share-btn').addEventListener('click', shareSite);

        // Live Clock
        function updateClock() {
            const now = new Date();
            document.getElementById('live-clock').textContent = now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
        updateClock(); // initial call
    </script>


    



    <section id="youtube">
        <div style="text-align: center;">
            <h2 style="color: white">O melodie apreciata de creator.</h2>
            <p style="color: white">Este un video foarte interesant de pe YouTube!</p>
            <iframe width="560" height="315"
                src="https://www.youtube.com/embed/NlwIDxCjL-8"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>
    </section>


    <section class="section">
        <h2>Alta melodie foarte buna!</h2>
        <p>De data asta este un .mp4 de pe computerul personal al creatorului.</p>
        <video controls width="640" height="360">
            <source src="images/lean_ginseng2002.mp4" type="video/mp4">
        </video>
    </section>

    <section class="section">
        <h2>Incearca si cantecul acesta! (MP3)</h2>
        <audio controls>
            <source src="images/nirvana.mp3" type="audio/mpeg">
        </audio>
    </section>

    <section class="section">
        <h2>Distractie cu Canvas!</h2>
        <canvas id="myCanvas" width="400" height="200"></canvas>
        <script>
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#b3e5fc';
            ctx.fillRect(0, 0, 400, 200);
            ctx.fillStyle = '#0277bd';
            ctx.font = '20px sans-serif';
            ctx.fillText("O incercare de canvas :-).", 70, 100);
        </script>
    </section>

    <section class="section">
        <h2>Daca ai intrebari, ma poti gasi la UAIC</h2>
        <p>Deobicei imi petrec timpul la seminar sau in parcul de langa universitate.</p>
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

        <p>&copy; 2025 Tincu Cosmin-David M524</p>
    </footer>
    <script src="assets/js/site.js"></script>

</body>
</html>
