<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$wishlist_count=0;
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;    
}

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();
if(isset($_SESSION['USER_LOGIN'])){
	$uid=$_SESSION['USER_ID'];
	
	if(isset($_GET['wishlist_id'])){
		$wid=get_safe_value($con,$_GET['wishlist_id']);
		mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
	}

	$wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
}
$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];

$meta_title="Solbios Pvt Ltd";
$meta_desc="My Ecom Website";
$meta_keyword="My Ecom Website";
if($mypage=='product.php'){
	$product_id=get_safe_value($con,$_GET['id']);
	$product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
	$meta_title=$product_meta['meta_title'];
	$meta_desc=$product_meta['meta_desc'];
	$meta_keyword=$product_meta['meta_keyword'];
}if($mypage=='contact.php'){
	$meta_title='Contact Us';
}
?>



<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title?></title>
    <meta name="description" content="<?php echo $meta_desc?>">
    <meta name="keywords" content="<?php echo $meta_keyword?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <style>
	.htc__shopping__cart a span.htc__wishlist {
		background: #c43b68;
		border-radius: 100%;
		color: black;
		font-size: 9px;
		height: 17px;
		line-height: 19px;
		position: absolute;
		right: 18px;
		text-align: center;
		top: -4px;
		width: 17px;
	}
	</style>
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header" style="background-color: white;">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/logo/logoo.png" alt="logo images"></a>
                                </div>
                                <div class="row styles_bottom-row_1a89P styles_border-one_2wAfi">
                                    <div class="col-sm-8 pad0 style_location-search-div_XoEew"></div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-2 col-sm-3 col-xs-3">
                            <br>
                            <form action="search.php" method="get">
                                <div class="input-group">
                                    
                                        <input type="text" class="form-control" placeholder="Search Product" name="str" style="border-bottom-right-radius: 0;border-top-right-radius: 0;background-color: white">
                                        
                                        <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
                                        </div>
                                </div>
                            </form>
                            


                        
                                   
                               

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php
                                            foreach($cat_arr as $list){
                                                ?>
                                                <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
                                                <?php
                                            }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-6 col-sm-4 col-xs-4">
                                 <div class="header__right">
                                     <div id="upload_prescription_button" class="uPres" style="font-family: Old Standard TT', serif;
                                     font-size: 14px;
                                     font-stretch: normal;
                                     font-style: normal;
                                     font-size: 17px;
                                     letter-spacing: 1px;
                                     text-align: center;
                                     color: #ffffff;
                                     text-transform: uppercase;
                                     margin-right: 10px">
                                            <a href="upload_prescription.php"><b><font color="black"> Upload</font></b></a>
                                        </div>
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['USER_LOGIN'])){
                                        ?>
                                            <!-- Example single danger button -->
                                        <div class="btn-group" style="margin-right: 12px;">
                                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #c43b68; border-color: #c43b68; font-weight: bolder;">Hi <?php echo $_SESSION['USER_NAME']?></button>
                                          <div class="dropdown-menu" style="min-width: 0px; background-color: #c43b68;">
                                          <a class="dropdown-item" style="color: white;" href="my_order.php">Order</a>
                                          <a class="dropdown-item" style="color: white;" href="profile.php">Profile</a>
                                          
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" style="color: white;" href="logout.php">Logout</a>
                                        </div>
                                    </div>







											<?php
									    }else{
                                            echo '<a href="login.php" class="mr15"><b><font color="black">Login|Register</font></b></a>';
										}
                                        										
                                       
										?>
										
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <?php
										if(isset($_SESSION['USER_ID'])){
										?>
										<a href="wishlist.php"><i class="icon-heart icons" style="color:black; margin-right:8px;"></i></a>
                                        <a href="wishlist.php"><span class="htc__wishlist" style="right: 25px; color: white;"><?php echo $wishlist_count?></span></a>
										<?php } ?>
                                        <a href="cart.php"><i class="icon-handbag icons" style="color: black;
                                        font-size: 19px"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>

                                      
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
        </header>
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="fluid.container">
                    <div class="row">
                        <div class="col-md-8 col-lg-12 col-sm-5 col-xs-3">
                            <nav class="main__menu__nav hidden-xs hidden-sm">
                                <ul class="main__menu" style="color: black; font-weight: bold; font-family: Arial, Helvetica, sans-serif; background-color: white; height:70px;">
                                <?php
										foreach($cat_arr as $list){
											?>
											<li class="drop"><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
											<?php
											$cat_id=$list['id'];
											$sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
											if(mysqli_num_rows($sub_cat_res)>0){
											?>
											
											   <ul class="dropdown">
													<?php
													while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
														echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a></li>
													';
													}
													?>
												</ul>
												<?php } ?>
											</li>
											<?php
										}
										?>
                                      
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>