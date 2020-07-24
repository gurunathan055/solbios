<?php 
require('top.php');

if(!isset($_SESSION['USER_LOGIN'])){

	?>
	<script>
	window.location.href='login.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];


?>

				


        <section class="htc__contact__area ptb--30 bg__white">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h2 class="title__line--6">Upload Prescription</h2>
                        <div class="address">
                            
                            <div class="address__details">
                               <p>Please upload images of valid prescription from your doctor.</p>
							   <form action="upload_prescription.php" method="post" enctype="multipart/form-data">
                                   
                                    <div class="form-group">
                                        <label for="file">Prescription</label>
                                        <input type="file" name="file" id="file" class="form-control">
                                   </div>
                                   
                                        <input type="submit" name="submit" value="Upload" class="btn btn-success">
                                </form>                                
                            </div>
                        </div>
                        
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h2 class="title__line--6">Your Prescription</h2>
                        <div class="address__details">
                        Hey! <?php echo $_SESSION['USER_NAME']?>, here is your uploaded Prescription
                        <?php
                        if(isset($_SESSION['USER_LOGIN'])){
                        if(isset($_POST['submit'])){
                        $files = $_FILES['file'];

                        $filename = $files['name'];
                        $fileerror = $files['error'];
                        $filetemp = $files['tmp_name'];


                        $fileext = explode('.',$filename);
                        $filecheck = strtolower(end($fileext));
 
                        $fileextstored = array('png', 'jpg', 'jpeg', 'pdf');

                        if(in_array($filecheck, $fileextstored)){
                        $distinationfile ='prescription/'.$filename;
                        move_uploaded_file($filetemp,$distinationfile);

    

                        
                       
                       $q = "INSERT INTO `users`('mobile',`prescription`) VALUES ($mobile,'$distinationfile')";

                       $query = mysqli_query($con,$q);
                        }




                       }
                    }
                    ?>

     
                </div>

                


                




            </div>
        </section>
                

<?php require('footer.php')?>        