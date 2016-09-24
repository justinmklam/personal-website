<!DOCTYPE html>
<html lang="en">

<head>
    <title>Justin MK Lam - Portable Power Supply</title>
    <?php include ('../../header.html'); ?>
</head>

<body>

    <?php include ('../../navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">
        
        <div class="col-sm-8 col-centered">
            <h1 class="page-header">Portable Power Supply
            </h1>
            
            <p><strong>Objective:</strong> Build a cheap, portable, variable DC power supply.</p>
            
            <p><strong>Motivation:</strong> It was finally time to get my hands on a variable power supply for my electronics projects. Previous projects mainly involved Arduino, which was able to supply 5V and 3.3V with ease. However, the need for a supply with higher voltage, current, and flexibility eventually arose, resulting in the birth of this ghetto (but functional) power supply.</p>
            
            <p><strong>Limitations:</strong></p>
            <ul>
                <li>Only DC voltages available</li>
                <li>Max current is a function of input power and desired voltage (I=P/V)</li>
                <li>Current limiting feature is non-existent, so must be careful to not let the genie out of circuits</li>
            </ul>
            
            <a><img class="img-responsive img-content" src="/imgs/power_supply/IMG_20160525_142454.jpg" /></a>
            <p class="caption">Power supply in action, providing 12V to a reel of strip LEDs.</p>
            
            <a><img class="img-responsive img-content" src="/imgs/power_supply/IMG_20160525_143029.jpg" /></a>
            <p class="caption">Internals of the power supply.</p>
            
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