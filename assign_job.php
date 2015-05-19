<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        echo 'List of Modules : <br><br>';
        echo '<ol>';
        echo '<li><a href="index.php" >Home</a></li>';
        echo '<li><a href="new_customer.php" >Add Customer</a></li>';
        echo '<li><a href="assign_job.php" >Assign Job</a></li>';
        echo '</ol>';
        ?>
        <div style="position: absolute; left: 20%; top: 0%; width: 70%; height: 100%; overflow: auto; background-color: lightgoldenrodyellow;">
            <h2 align="center">Assign Job</h2><hr><br>
            <div id="error" style="position: absolute; left: 10%; top: 15%; width: 80%; height: 5%; padding: 1%; background-color: lightgoldenrodyellow;" align="center">
                <font color="red">Error : Server Connection time out.</font>
            </div>
        </div>

    </body>
</html>