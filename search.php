<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style1.css">
        <title></title>
    </head>
    <body>
        <form class = "form_1" action = "" method = "POST">
            <div class ="headline">生徒検索</div>
            <input type = "text" name = "serch_name" placeholder = "氏名">
            <button type = "submit" >検索</button>
        </form>

        <table  class='table_1' align='center' >
            <caption>生徒情報</caption>
            <tr class="tr1">
                <th class="h1">名前</th>
                <th class="h2">学校名</th>
                <th class="h3">学年</th>
            </tr>
    </body>
    
    <?php
        session_start();
        if(isset($_POST["serch_name"])){
            $name = $_POST["serch_name"];
            $_SESSION["name"] = $name;
            
            //SQL接続
            $dsn = "mysql:dbname=tb230923db;host=localhost";
            $user = "tb-230923";
            $password = "v8kg2yvYpT";
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            $sql = "SELECT * FROM studentdata WHERE name=:input";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":input",$name,PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            
            foreach($results as $row){
                echo 
                    "<tr>".
                        "<td>"."<a href = 'info.php?search={$row["school"]}'>".$row["name"]."</a>"."</td>".
                        "<td>".$row["school"]."</td>".
                        "<td>".$row["grade"]."</td>".
                    "</tr>";
                        
            }
            echo "</table>";
            
        
            
        }
        ?>
</html>