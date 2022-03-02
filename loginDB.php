<?php
    if(isset($_POST["id"]) && isset($_POST["password"])){
        $name = $_POST["id"];
        $pass = $_POST["password"];
        
        //ユーザー名が入力されていないとき
        if(empty($name)){
            header("Location: login.php?error=IDが入力されていません");
            exit();
        
        //パスワードが入力されていないとき
        }elseif(empty($pass)){
            header("Location: login.php?error=パスワードが入力されていません");
            exit();
            
        //両方入力されているとき
        }else{
            //SQL接続
            $dsn = "データベース";
            $user = "ユーザー名";
            $password = "パスワード";
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            //DBとの照合
            $sql = "SELECT * FROM userdata";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach($results as $row){
                
                if($name == $row["name"] && $pass == $row["password"]){
                    header("Location: search.php");
                    exit();
                    
                }else{
                    header("Location: login.php?error=IDまたはパスワードが間違っています");
                }
            }
        }
    }
    ?>
