<!DOCTYPE html>
<html lang="en">

<head>
    <title>Justin MK Lam - Project Haikuza</title>
    <?php include ('../../header.html'); ?>
</head>

<body>

    <?php include ('../../navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">
        
        <div class="col-sm-8 col-centered">
            <h1 class="page-header">Project Haikuza
            </h1>
            
            <p><strong>Objective:</strong> Develop an algorithm to generate haikus using song lyrics.</p>

            <p><strong>Motivation:</strong> Because computational linguistics are cool.</p>

            <p><strong>Source</strong>: <a href="https://twitter.com/thehaikuza" target="_blank">twitter.com/thehaikuza</a></p>

            <p><strong>Features:</strong></p>
            <ul>
                <li>Scrapes <a href="http://www.vancouver.virginradio.ca/broadcasthistory.aspx" target="_blank">Virgin Radio's broadcast history</a> to find recently played songs</li>
                <li>Creates a song-based haiku queue in <a href="https://docs.google.com/spreadsheets/d/1HazfuywY_MrmQ49fxSpHOMA8QXBUYVhEDx1e4qhjbqU/edit?usp=sharing" target="_blank">Google Sheets</a></li>
                <li>Generates a haiku using the queue as a reference and posts it on Twitter</li>
                <li>Checks for new tweets every 5 minutes and generates a relevant haiku, if requested</li>
                <li>Finds all song lyrics from <a href="http://lyrics.wikia.com/Lyrics_Wiki" target="_blank">Lyrics Wikia</a></li>
                <li>Runs on a Raspberry Pi</li>
            </ul>
            
        
            <p>
            <strong>Challenges:</strong></p>
            <ul>
                <li>Formulaically counting syllables</li>
                <li>Developing a context-free language model</li>
                <li>Creating phrases that actually make sense</li>
            </ul>
    
            <p><strong>Framework:</strong> Python 2.7.9</p>

            <img class="img-responsive img-content" src="/imgs/haikuza/Haikuza-twitter-screencap-v3-e1458090798553.png"/> 
            <p class="caption">Screencap of @thehaikuza's Twitter profile</p>

            <img class="img-responsive img-content" src="/imgs/haikuza/IMG_20150803_180047-1024x768.jpg"/> 
            <p class="caption">Raspberry Pi 1 Model B running @thehaikuza, 24/7!</p>

            <p><em>Interested in the making of Project Haikuza? Read about it <a href="http://www.justinmklam.com/blog/project-haikuza/the-making-of-project-haikuza-part-1/">here</a>.</em></p>
            
        </div>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

</body>
    
<?php include ('../../footer.html'); ?>

</html>