<?php
$linkDBTest = mysqli_connect(
            'cucak.am',  /* The host to connect to */
            '509_cucak',       /* The user to connect as */
            'Chimacaq.00' ); //,   /* The password to use */
           // 'kirktest');     /* The default database to query */

if (!$linkDBTest) {
   printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
   exit;
} 

?>