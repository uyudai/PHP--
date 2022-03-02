
<?php 
    //検索した生徒の情報を取得
    session_start();
    $name = $_SESSION["name"];
    $school = $_GET["search"];
    
    //SQL接続
    $dsn = "データベース";
    $user = "ユーザー名";
    $password = "パスワード";
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //取得した情報をDBで検索をかける
    $sql = "SELECT * FROM studentdata WHERE name=:name AND school=:school";
    $stmt = $pdo-> prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':school', $school, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt -> fetch();

    $edit_text = "";
    $edit_num = "";
    $i = 1;
    if(isset($_POST["edit"])){
        $edit = $_POST["edit_num"];
        
        $sql = "SELECT * FROM commentdata WHERE name=:name AND school=:school";
        $stmt = $pdo ->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':school', $school, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt -> fetchAll();
            foreach($results as $row){
                if($edit == $i ){
                    $edit_num =  $row["id"];
                    $edit_text = $row["comment"];  
                    break;
                }else{
                    $i = $i + 1 ;
                }
            }
    }
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style2.css">
    </head>
    <body>
        <div class="botton">
            <a href="search.php">戻る</a>
        </div>
        
        <div class="box">
            <div class="info">
                <label class="title">生徒情報</label><br>
                <label class= "h1">氏名:</label>
                <a><?= $result["name"]?></a><br>
                <label>学校名:</label>
                <a><?= $result["school"]?></a><br>
                <label>学年:</label>
                <a><?= $result["grade"]?></a><br>
            </div>
        
            <form action = "" method = "POST">
                <div class ="comment">
                    <label>コメント</label>
                    <textarea id="コメント" name = "comment" ><?= $edit_text ?></textarea>
                    <input type = "hidden" name = "number" value = <?= $edit_num ?>>
                </div>
                <div class ="id">
                    <label>編集番号</label>
                    <input type = "text" name = "edit_num">
                    <input type = "submit" name = "edit" value = "編集">
                </div>
                <div class ="submit">
                    <button type = "submit" >送信</button>
                </div>
            </form>
        </div>
        
    </body>
</html>

<?php
    function exportdata(){
        $dsn = "mysql:dbname=tb230923db;host=localhost";
        $user = "tb-230923";
        $password = "v8kg2yvYpT";
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        $name = $_SESSION["name"];
        $school = $_GET["search"];
        $num = 1;
        
        $sql = "SELECT * FROM commentdata WHERE name=:name AND school=:school";
        $stmt = $pdo ->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':school', $school, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt -> fetchAll();
        
        echo "<div class ='text'>";
        foreach($results as $row){
            echo "<div class ='num'>".$num.":".$row["time"]."<br>"."</div>".
                 "コメント:".$row["comment"]."<br>"."<br>";
            
            $num = $num +1;
                 
                 
        }
        
        echo "</div>";
        
    }
    
    //コメントが入力されたとき
    if(!empty($_POST["comment"]) && isset($_POST["submit"])){
        $comment = $_POST["comment"];
        $time = date("Y/m/d H:i");
        $number = $_POST["number"];
        
        //新規投稿か編集の判定
        if($number == ""){
            //書き込み
            $sql = "INSERT INTO commentdata (name, school, comment, time) VALUES (:name, :school, :comment, :time)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':school', $school, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->execute();
            
            
        }elseif($number !== ""){
            //編集
            $sql = 'SELECT * FROM commentdata';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach($results as $row){
                if($number == $row["id"]){
                    
                    $sql = 'UPDATE commentdata SET comment=:comment,time=:time WHERE id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                    $stmt->bindParam(":id", $number, PDO::PARAM_INT);
                    $stmt->execute();
                    }

                }
            }
        
        exportdata();
        
    }else{
        exportdata();      
                
    }
    ?>
