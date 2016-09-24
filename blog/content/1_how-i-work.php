<!DOCTYPE html>
<html lang="en">

<head>
    <title>Justin MK Lam - Blog</title>
    <?php include ('../../header.html'); ?>
    <link href="../css/blog-home.css" rel="stylesheet">
</head>

<body>

    <?php include ('../../navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>This Is How I Work</h1>

                <br>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on February 21, 2015</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="../imgs/How-I-Work-2.png" alt="">

                <hr>

                <!-- Post Content -->
                <?php include("1_how-i-work.html") ?>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->


            </div>
            <?php include("../widgets-column.html") ?>
        </div>
        
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
    
<?php include ('../../footer.html'); ?>

</html>