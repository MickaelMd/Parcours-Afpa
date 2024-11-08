<?php  


var_dump($_FILES);

move_uploaded_file($_FILES["fichier"]["tmp_name"], "testupload/test.txt"); 






?>