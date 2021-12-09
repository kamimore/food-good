<?php
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Food Ordering Website</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo loaddoc ?>assets/css/animate.css">
        <link rel="stylesheet" href="<?php echo loaddoc ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo loaddoc ?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo loaddoc ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo loaddoc ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo loaddoc ?>assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <div class="slider-area">
            <div class="slider-active owl-dot-style owl-carousel">
                <?php
				$banner_res=mysqli_query($conn,"select * from banner where status='1' order by order_number");
        $num=mysqli_num_rows($banner_res);

				while($banner_row=mysqli_fetch_assoc($banner_res)){
				?>
                	<!--<div class="single-slider pt-210 pb-220 bg-img" class='checking-z'-->
				<div class="single-slider pt-210 pb-220 bg-img" class='checking-z'
                 style="background-image:url(<?php echo load_banner.$banner_row['image']?>);background-size:cover;">
                    <div class="container">
                        <div class="slider-content slider-animated-1">
                            <h1 class="animated"><?php echo $banner_row['heading']?></h1>
                            <h3 class="animated"><?php echo $banner_row['sub_heading']?></h3>
                            <div class="slider-btn mt-90">
                                <a class="animated" href="<?php echo $banner_row['link']?>"><?php echo $banner_row['link_text']?></a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php } ?>
            </div>
        </div>
        <script src="<?php echo loaddoc ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo loaddoc ?>assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="<?php echo loaddoc ?>assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo loaddoc ?>assets/js/isotope.pkgd.min.js"></script>
        <script src="<?php echo loaddoc ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo loaddoc ?>assets/js/plugins.js"></script>
        <script src="<?php echo loaddoc ?>assets/js/main.js"></script>
    </body>
</html>
