<!-- <?php
// require('connection.inc.php');
// require('functions.inc.php');

// if(isset($_SESSION['USER_LOGIN'])){
//   if(isset($_POST['submit'])){
//     $files = $_FILES['file'];

//     $filename = $files['name'];
//     $fileerror = $files['error'];
//     $filetemp = $files['tmp_name'];


//     $fileext = explode('.',$filename);
//     $filecheck = strtolower(end($fileext));
 
//     $fileextstored = array('png', 'jpg', 'jpeg', 'pdf');

//     if(in_array($filecheck, $fileextstored)){
//       $distinationfile ='prescription/'.$filename;
//        move_uploaded_file($filetemp,$distinationfile);

    


//       $q = "INSERT INTO `users`(`prescription`) VALUES ('$distinationfile')";

//       $query = mysqli_query($con,$q);
//     }




//   }
// }
// ?> -->