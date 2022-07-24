<?php 

    function create_userid(){
        $length =rand(4,20);
        $number="";
        for($i=0; $i<$length; $i++){
            $new_rand= rand(0,9);
            $number = $number . $new_rand;
        }
        return $number;
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // print_r($_POST);

        $db= new PDO("mysql:host=localhost; dbname=ranks", "root", "");

        if(!$db){
            die("could not connect to the database");
        }

        // echo "<pre>";
        // print_r($_POST);
        // echo "<pre>";

        $arr['user_id']= create_userid();

        $condition = true;
        while($condition){
            $query= "select id from users where user_id= :user_id limit 1"; 
            $stm=$db->prepare($query);
            if($stm){
                $check=$stm->execute($arr);
                if($check){
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                    if(is_array($data) && count($data) > 0){
                        $arr['user_id']= create_userid();
                    }
                }
            }

            $condition = false;
        }
        
        //save to database
        $arr['name']=$_POST['name'];
        $arr['email']=$_POST['email'];
        $arr['password']=hash('sha1', $_POST['password']);
        $arr['rank']= "user";
        
        $query= "insert into users (user_id,name,email,password, rank) values(:user_id,:name,:email,:password,:rank)"; 
        $stm=$db->prepare($query);
        if($stm){
            $check=$stm->execute($arr);
            if($check){
                $error="could not save to database";
            }
            if($error !== ""){
                header("location: login.php");
                die;
            }
        }
    }
?>


<?php include "header.php" ?>
  
  <h1>Sign up page</h1>

  <?php 
    if($error == ""){
        echo "<br><span style='color:red;''>could not execute </span><br>";
    }
  ?>

  <style type="text/css">
    .input{
        border-radius: 5px;
        border: solid thin #aaa;
        padding: 10px;
        margin: 4px;
    }

    .btn{
        border-radius: 5px;
        border: solid thin #aaa;
        padding: 10px;
        margin: 4px;
        cursor: pointer;
    }

  </style> 

  <form method="POST">
    <input class="input" type="text" name="name" placeholder="Enter name" required><br>
    <input class="input" type="text" name="email" placeholder="email" required><br>
    <input class="input" type="password" name="password" placeholder="enter password" required><br>

    <button type="submit" class="btn btn-primary">Sign up</button><br>
  </form>

<?php include "footer.php" ?>