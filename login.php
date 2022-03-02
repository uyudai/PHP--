<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action = "loginDB.php" method = "POST">
            <h2>ログイン</h2>
                <?php if(isset($_GET["error"])){ ?>
                <p class = "error"><?php echo $_GET["error"];?></p>
                <?php } ?>
            <label>ID</label>
            <input type = "text" name = "id" placeholder = "ID"><br>
            
            <label>パスワード</label>
            <input type = "text" name = "password" placeholder = "パスワード"><br>

            <button type = "submit" >ログイン</button>
        </form>
    </body>

</html>