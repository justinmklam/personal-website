<?php
if ($page_not_found) {
   header('This is not the page you are looking for', true, 404);
   include('your_404_page.php');
   exit();
}