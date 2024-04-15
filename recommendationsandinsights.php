<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendations and Insights</title>
    <link rel="stylesheet" href="recommendationandinsight.css">
    <script src="https://www.youtube.com/iframe_api"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <a href="home.html" class="logo-link">
                <img src="logo.png" alt="Logo" class="logo">
                <span class="logo-text">A cool carbon tracker</span>
            </a>
            <ul class="left-nav">
                <li>
                    <a href="#">Carbon Footprint Calculator</a>

                    <ul class = "dropdown">
                        <li><a href="car1.html">Transportation - Car</a></li>
                        <li><a href="motorbike.html">Transportation - Motorbike</a></li>
                        <li><a href="busandrail.html">Transportation - Bus and Rail</a></li>
                        <li><a href="airplane.html">Transportation - Flight</a></li>
                        <li><a href="diet.html">Transportation - Diet</a></li>
                        <li><a href="house.html">Transportation - House Utilities</a></li>
                    </ul>

                </li>

                <li><a href="recommendationandinsight.html">Recommendations and Insights</a></li>
                <li><a href="media.html">Media</a></li>
            </ul>
            <div class="account-name">
                <ul>
                    <li><a href="personal.html">Account</a></li>
                    <li><a href="login.html">Log out</a></li>
                </ul>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="recommend">
            <h1>Recommendations</h1>
                <?php 
                if ($total_footprint < 1000) {
                    echo "Great job! Your carbon footprint is low. Keep up the good work!";
                } else if ($total_footprint < 5000) {
                    echo "Your carbon footprint is moderate. Consider taking public transportation or carpooling to reduce your emissions.";
                } else if ($total_footprint < 10000) {
                    echo "Your carbon footprint is high. Consider reducing your meat consumption and using energy-efficient appliances to lower your emissions.";
                } else {
                    echo "Your carbon footprint is very high. Consider making significant changes to your lifestyle, such as switching to renewable energy sources and reducing your air travel.";
                }
                ?>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="climate-change-section">
            <h1>Causes and Effects of Climate Change</h1>
            <p>Fossil fuels – coal, oil and gas – are by far the largest contributor to global climate change, accounting for over 75 per cent of global greenhouse gas emissions and nearly 90 per cent of all carbon dioxide emissions.</p>
            <p>As greenhouse gas emissions blanket the Earth, they trap the sun’s heat. This leads to global warming and climate change. The world is now warming faster than at any point in recorded history. Warmer temperatures over time are changing weather patterns and disrupting the usual balance of nature. This poses many risks to human beings and all other forms of life on Earth.</p>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="learning-cards">
            <div class="card">
                <img src="climate-change.jpg" alt="What is climate change?">
                <h3>What is climate change?</h3>
                <p>Climate offers a quick take on the how and why of climate change.</p>
                <div class="video-container">
                    <iframe id="video1" width="560" height="315" src="https://www.youtube.com/embed/g9p5VKd8VkE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="card">
                <img src="net-zero.jpg" alt="Net Zero">
                <h3>Net Zero</h3>
                <p>What is “net zero”, why is it important, and is the world on track to reach it?</p>
                <div class="video-container">
                    <iframe id="video2" width="560" height="315" src="https://www.youtube.com/embed/aM31RyxSSCw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="card">
                <img src="initiatives-action.jpg" alt="Initiatives for action">
                <h3>Initiatives for action</h3>
                <p>Read about global initiatives aimed at speeding up the pace of climate action.</p>
                <div class="video-container">
                    <iframe id="video3" width="560" height="315" src="https://www.youtube.com/embed/Hcsy_gSWV0A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
            </div>
</body>
</html>
