<?php

session_start(); 

if(isset($_POST["email"])){
    $email = $_POST["email"];


}
if(isset($_POST["password"])){
    $password = $_POST["password"];

}



$con = new mysqli("localhost","root","","Project_ice321");
if($con->connect_error){
    die("failed to connect to DB");
}
else{
    if(!isset($_POST["admin"])){
        $stmt = $con->prepare("Select password, C_id from Customer where Email= ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
    
        if($stmt_result->num_rows>0){
            $data = $stmt_result->fetch_assoc();
            $x =  isset($data['password'])? $data['password']:"";
        
                if($x===$password){
                    $_SESSION['user'] = $data['C_id'];
                    header("Location: home.php");
        
                }
                else{
                    echo "<h2> invalid email or password</h2>";
            
                }
    
            }
    
            }
            else{
                $stmt = $con->prepare("Select password from admin where Email= ?");
                $stmt->bind_param("s",$email);
                $stmt->execute();
                $stmt_result = $stmt->get_result();
    
                if($stmt_result->num_rows>0){
                    $data = $stmt_result->fetch_assoc();
                    $x =  isset($data['password'])? $data['password']:"";
        
                        if($x===$password){
                            header("Location: admin.html");
        
                        }
                        else{
                            echo "<h2> invalid email or password</h2>";
            
                    }
    
            }
    
            }


            }
        
   
    
   
       

    

    


?>