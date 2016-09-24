<!DOCTYPE html>
<html lang="en">

<head>
    <title>Justin MK Lam - External Ballistics</title>
    <?php include ('../../header.html'); ?>
</head>

<body>

    <?php include ('../../navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">
        
        <div class="col-sm-8 col-centered">
            <h1 class="page-header">External Ballistics
            </h1>
            
            <p><strong>Background</strong>: Long range trajectories are heavily susceptible to external factors including (but not limited to) drag, gravity, air density, altitude, rotation of the bullet, and rotation of the Earth.

            One solution is to connect a computer to a manual targeting system (ie. a scope) and estimate the corrected target location by accounting for these external factors.  The user may then line the manual targeting system up with the corrected target location, hoping to the high heavens that the target will be hit upon releasing the projectile.</p>

            <p><strong>Objective</strong>: Determine the required release angle given the muzzle velocity and target distance, accounting for external factors.</p>

            <p><strong>Limitations:</strong></p>
            <ul>
                <li>Only the corrected vertical distance is calculated</li>
                <li>Values have not yet been validated for accuracy</li>
                <li>Purely mathematical simulations lack the accuracy provided by simulations backed by empirical data</li>
            </ul>
            <p><strong>Framework: </strong>Python(x,y) 2.7.9.0</p>

            <a href="#"><img class="img-responsive img-content" src="/imgs/external_ballistics/Ballistics-Simulation_0-deg-Scope-Angle_all_missed.png"/></a>
            <p class="caption">Visualization of release angles between 0 and 90° given the same muzzle velocity.</p>

            <a href="#">  <img class="img-responsive img-content" src="/imgs/external_ballistics/Ballistics-simulation-flowchart.png" /></a>
            <p class="caption">Flowchart of the algorithm to determine the required release angle.</p>

            <a href="#"><img class="img-responsive img-content" src="/imgs/external_ballistics/Ballistics-Simulation_0-deg-Scope-Angle_all.png"/></a> 
            <p class="caption">Visualization of the algorithm on the release angle increment. The magenta trajectory is 5° higher than the red trajectory; the green is 2.5° higher than the magenta, and so on.</p>

            <a href="#"><img class="img-responsive img-content" src="/imgs/external_ballistics/Ballistics-Simulation_0-deg-Scope-Angle-exaggerated.png" /></a> <p class="caption">Predicted trajectory on flat ground.</p>

            <a href="#"><img class="img-responsive img-content" src="/imgs/external_ballistics/Ballistics-Simulation_18-deg-Scope-Angle.png"/></a>
            <p class="caption">Predicted trajectory when target is uphill from user.</p>

            <a href="#"><img class="img-responsive img-content" src="/imgs/external_ballistics/Ballistics-Simulation_-9-deg-Scope-Angle.png"/></a> 
            <p class="caption">Predicted trajectory when target is downhill from user.</p>
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