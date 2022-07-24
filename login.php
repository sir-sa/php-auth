<?php 

    session_start();

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

        
        
        //save to database
        $arr['email']=$_POST['email'];
        $arr['password']=hash('sha1', $_POST['password']);
       
        
        $query= "select * from users where email = :email && password = :password limit 1"; 
        $stm=$db->prepare($query);
        if($stm){
            
            $check=$stm->execute($arr);
            if($check){
                $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                if(is_array($data) && count($data) > 0){
                    $_SESSION['myid']= $data[0]['user_id'];
                    $_SESSION['myname']= $data[0]['name'];
                    $_SESSION['myrank']= $data[0]['rank'];
                }else{
                    $error="wrong username or password";
                }
            }
            
            if($error == ""){
                
                header("location: index.php");
                die;
            }
        }
    }
?>


<?php include "header.php" ?>
  
  <h1>Login</h1>

  <?php 
    if($error !== ""){
        echo "<br><span style='color:red;''>wrong email or password  </span><br>";
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
    <input class="input" type="text" name="email" placeholder="email" required><br>
    <input class="input" type="password" name="password" placeholder="enter password" required><br>

    <button type="submit" class="btn btn-primary">Login</button><br>
  </form>

<?php include "footer.php" ?>