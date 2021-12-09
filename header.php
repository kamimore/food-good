<?php
   session_start();
   include('database.inc.php');
   include 'function.inc.php';
   include('constant.inc.php');
   $getSetting=getSetting();
   $website_close=$getSetting['website_close'];
   $website_close_msg=$getSetting['website_close_msg'];
   $cart_min_price=$getSetting['cart_min_price'];
   $cart_min_price_msg=$getSetting['cart_min_price_msg'];

   $totalCartPrice=0;
   getDishCartStatus();

   if(isset($_POST['update_cart']))
   {
     if($_SESSION['FOOD_USER_ID'])
     {
       foreach ($_POST['qty'] as $key => $value) {
         if($value[0]==0)
         {
           mysqli_query($conn,"delete from dish_cart where user_id='".$_SESSION['FOOD_USER_ID']."' and dish_detail_id='$key'");
     }
     else{
       mysqli_query($conn,"update dish_cart set qty='$value[0]' where user_id='".$_SESSION['FOOD_USER_ID']."' and dish_detail_id='$key'");
     }
       }
     }
     else{
       foreach ($_POST['qty'] as $key => $value) {
         if($value[0]==0)
         {
           unset($_SESSION['cart'][$key]);

         }
         else{
           $_SESSION['cart'][$key]['qty']=$value[0];

       }
       }
     }
   }

   $cartArr=getUserFullCart();

   $totalCartDish=count($cartArr);

   $totalCartPrice=getcartTotalPrice();


   //pxr($cartArr);
   $getWalletAmt=0;
   if(isset($_SESSION['FOOD_USER_ID'])){

   	$getWalletAmt=getWalletAmt($_SESSION['FOOD_USER_ID']);

   }

   ?>
<!doctype html>
<html class="no-js" lang="zxx">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title class='booktitle'></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/animate.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/owl.carousel.min.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/slick.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/chosen.min.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/ionicons.min.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/simple-line-icons.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/jquery-ui.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/meanmenu.min.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/style.css">
      <link rel="stylesheet" href="<?php echo user_login?>assets/css/responsive.css">
      <script src="<?php echo user_login?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
   </head>
   <body>
      <!-- header start -->
      <header class="header-area">
         <div class="header-top black-bg">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 col-md-5  col-sm-4">
                     <div class="welcome-area">
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-3 col-4 col-sm-4">
                     <?php
                        if(isset($_SESSION['FOOD_USER_NAME'])){
                        ?>
                     <div id="wallet_top_box">
                        <a href="<?php echo user_login?>wallet" style="color:#fff;text-decoration:underline;" >
                        Wallet Amt ₹<?php echo $getWalletAmt?>
                        </a>
                     </div>
                     <?php  } ?>
                  </div>
                  <div class="col-lg-2 col-md-4 col-8 col-sm-4">
                     <div class="account-curr-lang-wrap f-right">
                        <?php
                           if(isset($_SESSION['FOOD_USER_NAME'])){
                           ?>
                        <ul>
                           <li class="top-hover">
                              <a href="javascript:void(0)"><?php echo "Welcome <span id='user_top_name'>".$_SESSION['FOOD_USER_NAME'];?>
                              <i class="ion-chevron-down"></i></a>
                              <ul>
                                 <li><a href="<?php echo user_login?>profile">Profile  </a></li>
                                 <li><a href="<?php echo user_login?>order_history">Order History</a></li>
                                 <li><a href="<?php echo user_login?>logout">Logout</a></li>
                              </ul>
                           </li>
                        </ul>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="header-middle">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-md-4 col-4 col-sm-4">
                     <div class="logo">
                        <a href="<?php echo user_login?>index">
                        <img alt="" src="<?php echo user_login?>assets/img/logo/logo.png">
                        </a>
                     </div>
                  </div>
                  <div class="col-lg-9 col-md-8 col-8 col-sm-8">
                     <div class="header-middle-right f-right py-2">
                        <div class="header-login">
                           <?php
                              if(!isset($_SESSION['FOOD_USER_NAME'])){
                              	?>
                           <a href="<?php echo user_login?>login_register">
                              <div class="header-icon-style">
                                 <i class="icon-user icons header_icon"></i>
                              </div>
                              <div class="login-text-content header_icon">
                                 <p>Register <br> or <span>Sign in</span></p>
                              </div>
                           </a>
                           <?php
                              }
                              ?>
                        </div>
                        <div class="header-wishlist">
                           &nbsp;
                        </div>
                        <div class="header-cart">
                           <a href="<?php echo user_login?>cart">
                              <div class="header-icon-style">
                                 <i class="icon-handbag icons"></i>
                                 <span class="count-style" id="totalCartDish"><?php echo $totalCartDish; ?></span>
                              </div>
                              <div class="cart-text">
                                 <span class="digit">My Cart</span>
                                 <span class="cart-digit-bold" id="totalCartPrice">
                                 <?php
                                    if($totalCartPrice!=0){
                                      echo "Rs ".$totalCartPrice;
                                    }
                                    ?>
                                 </span>
                              </div>
                           </a>
                           <?php   if($totalCartPrice!=0)
                              { ?>
                           <div class="shopping-cart-content">
                              <ul id="cart_ul">
                                 <?php
                                    foreach($cartArr as  $key=>$list){
                                     ?>
                                 <li class="single-shopping-cart" id="attr_<?php echo $key; ?>">
                                    <div class="shopping-cart-img">
                          <a href="javascript:void(0)"><img id="maintain_width" alt="" src="<?php echo load.$list['image']?>"></a>
                                    </div>
                                    <div class="shopping-cart-title" id="attr_<?php echo $key?>">
                                       <h4><a href="javascript:void(0)"><?php echo $list['dish'] ?></a></h4>
                                       <h6>Qty: <?php echo $list['qty'] ?></h6>
                                       <span><?php
                                          echo "Rs ".$list['price']; ?></span>
                                    </div>
                                    <div class="shopping-cart-delete">
                                       <a href="javascript:void(0)"  onclick=delete_cart("<?php echo $key; ?>")><i class="ion ion-close"></i></a>
                                    </div>
                                 </li>
                                 <?php
                                    }
                                       ?>
                              </ul>
                              <div class="shopping-cart-total">
                                 <h4>Shipping : <span>Free</span></h4>
                                 <h4>Total : <span class="shop-total" id="shopTotal"><?php echo "Rs ".$totalCartPrice; ?></span></h4>
                              </div>
                              <div class="shopping-cart-btn">
                                 <a href="<?php echo user_login?>cart">view cart</a>
                                 <a href="<?php echo user_login?>checkout">checkout</a>
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="header-bottom transparent-bar black-bg">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-12">
                     <div class="main-menu">
                        <nav>
                           <ul>
                              <li><a href="<?php echo user_login?>shop">Shop</a></li>
                              <li><a href="<?php echo user_login?>about">about</a></li>
                              <li><a href="<?php echo user_login?>contact ">contact us</a></li>
                              <li><a href="<?php echo user_login?>cart ">View Cart</a></li>
                              <li><a href="<?php echo user_login?>checkout ">Checkout</a></li>

                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- mobile-menu-area-start -->
         <div class="mobile-menu-area">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                           <ul class="menu-overflow" id="nav">
                           <li><a href="<?php echo user_login?>shop">Shop</a></li>
                              <li><a href="<?php echo user_login?>about">about</a></li>
                              <li><a href="<?php echo user_login?>contact ">contact us</a></li>
                              <li><a href="<?php echo user_login?>cart ">View Cart</a></li>
                              <li><a href="<?php echo user_login?>checkout ">Checkout</a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- mobile-menu-area-end -->
      </header>
