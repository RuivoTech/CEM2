<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <title>Sistema de Membros - CEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./cem.png" type="image/x-icon" />
    <link rel="shortcut icon" href="cem.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>
    <div class="container" >
        <div class="content">      
            <div id="login">
                <?php
                session_start();
                if (isset($_SESSION)) {
                    session_destroy();
                }
                echo "<p>";
                echo "Volte sempre";
                echo "</p>";
                echo "<meta http-equiv='refresh' content='3;url=./'>";
                ?>

            </div>
        </div>
    </div>
</body>
</html>