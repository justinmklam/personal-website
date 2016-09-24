<!DOCTYPE html>
<html lang="en">

<head>
    <title>Justin MK Lam - Blog</title>
    <?php include ('../header.html'); ?>
    <link href="css/blog-home.css" rel="stylesheet">
</head>

<body>

    <?php include ('../navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php include("all-posts.php") ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <?php include("widgets-column.html") ?>

        </div>
        <!-- /.row -->
        

    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
    
<?php include ('../footer.html'); ?>

</html>