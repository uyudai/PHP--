# Name
 
 検索と情報共有ができるサイト
 
# DEMO
ログインページ<br>
![image](https://user-images.githubusercontent.com/78655081/156424125-c3a9b1fd-b6e4-402f-b9ad-c953a6d0e60a.png)<br>

 検索画面<br>
![image](https://user-images.githubusercontent.com/78655081/156419090-450f396b-b6ae-4ba7-855f-ee84c6c2d21e.png "検索画面")  <br>

書き込む画面<br>
![image](https://user-images.githubusercontent.com/78655081/156419483-7655aac4-9131-47a5-8f21-b97e9082864e.png)  <br>

 
# Features
 アルバイトをしていた塾で生徒の情報を共有するときに紙または口頭で行っていた為に伝達ミスなどのトラブルが発生していた。<br>
 これをデータとして管理するために、このサイトを作成いたしました。<br>
 ・個人情報であるのでログインページを作成し限られた人のみのアクセスに限定<br>
 ・検索画面で名前を入力すると同じ名前の生徒の情報（学校名、学年）を表示<br>
 ・検索結果の氏名をクリックすると生徒個々のページに飛び情報を共有するための編集機能のあるチャットが備わっている。<br>
 
 
 
# Note
login.php（ログインページ）<br>
search.php（検索ページ)<br>
info.php(書き込む画面）<br>

データベース詳細  　<br>
 -userdata<br>
  ・name(ユーザー名）<br>
  ・password<br>
 
 -studentdata<br>
  ・name（生徒氏名）<br>
  ・school(学校名)<br>
  ・grade(学年)<br>
  
  -commentdata<br>
  　・id<br>
    ・name（生徒氏名）<br>
    ・school(学校名)<br>
    ・comment (コメント）<br>
    ・time　（入力した時刻)<br>
   

 
# Author
 
* 作成者　山本純
