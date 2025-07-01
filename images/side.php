<div class="side">
            <h4> لوحة النظام <i class="fa-solid fa-screwdriver-wrench mx-3"></i></h4>
            <nav>
                <a href="shop.php">الرئيسية</a>
                <a href="prod.php" >الموظفين</a>
            <?php
     if(isset($_SESSION['id'])){
     $sql=mysqli_query($con,"SELECT `role` From `pro` WHERE `role`='$_SESSION[rol]'");
     $role =mysqli_fetch_assoc($sql);
     if($role['role']== 'admain'){
        echo '<a href = "update.php"> الموظفين</a> ';

     }

     }

?>


          
               
            </nav>
            <!-- <img src="asstes/image/logo.jpg" width="100%" alt=""> -->
        </div>