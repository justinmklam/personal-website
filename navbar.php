<!DOCTYPE html>
<html lang="en">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <?php if (basename($_SERVER['PHP_SELF']) != 'index.php') { ?>
                <a class="navbar-brand" href="/index.php">Justin Lam</a>
            <?php } ?>
            
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/about.php">About</a>
                </li>
                
                <?php if (basename($_SERVER['PHP_SELF']) != 'index.php') { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Portfolio<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="/mechanical.php">Mechanical</a></li>
                          <li><a href="/electrical.php">Electrical</a></li>
                          <li><a href="/mechatronics.php">Mechatronics</a></li>
                          <li><a href="/software.php">Software</a></li>
                          <li role="separator" class="divider"></li>
                          <li class="dropdown-header"></li>
                          <li><a href="/portfolio.php">View All</a></li>
                        </ul>
                    </li>
                <?php } ?>
                
                <li>
                    <a href="/services.php">Services</a>
                </li>
                <li>
                    <a href="/contact.php">Contact</a>
                </li>
                <!-- <li>
                    <a href="/blog/blog-home.php" class="link-disabled">Blog</a>
                </li> -->
                <li>
                    <a href="/uploads/Resume-2016.pdf">CV</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
    
</html>