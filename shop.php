<?php
include ("header.php");
/*$class="";*/
$value="";
$value_string="";
$type_dish="";
$search_str='';

$condForType=" ";

$value_array=array();

//This is for category section
if(isset($_GET['checked_id'])){
$value=safe($_GET['checked_id']);
 $value_array=array_filter(explode('-',$value));
 $value_string=implode(',',$value_array);

}

//This is for veg , non-veg  and both
if(isset($_GET['type_dish'])){
  $type_dish=safe($_GET['type_dish']);

}
//This is for according to search result
if(isset($_GET['search_str'])){
	$search_str=safe($_GET['search_str']);
}
//end..
?> <div class="breadcrumb-area gray-bg">
  <div class="container">
    <div class="breadcrumb-content">
      <ul>
        <li>
          <a href="
						<?php echo user_login?>shop">Shop </a>
        </li>
      </ul>
    </div>
  </div>
</div> <?php

  //Is website active or deactive
        if($website_close==1){
          echo '
<div style="text-align: center;margin-top: 50px;">
	<h3>';
          echo $website_close_msg;
          echo '</h3>
</div>';
        }

  //end...
        ?> <div class="shop-page-area pt-100 pb-100">
  <div class="container">
    <div class="row flex-row-reverse ">
      <div class="col-lg-9">
        <div class="shop-topbar-wrapper container">
          <div class="product-sorting-wrapper container">
            <div class="product-show shorting-style search_box_main col-lg-6 col-md-6 ">
              <input class="search_box col-6 " style="border: 1px solid grey;" type="textbox" id="search" placeholder="Search..." value="<?php echo $search_str?>" />
              <input class="search_box seahc_box_btn col-4 " style="background: #f57d7d;
    font-weight: bolder;" type="button" class="submit btn-style" value="Search" onclick="setSearch()" />
            </div>
            <div class="product-show shorting-style justify-content-end row col-lg-5 col-md-5 col-sm-8 manage-type">
              <div class="inner" style="background-color: #d2dce7!important;"> <?php
                      $arrType=array("veg","non-veg","both");


                      foreach($arrType as $data) {

                        $condForType=$type_dish==$data?" checked='true' ":" ";
    echo "&nbsp&nbsp
									<input type='radio' $condForType name='type_dish' class='maintain' value='$data' onclick=run_dish('$data')>".strtoupper($data) ;

                      /*  if($type_dish==$data)
                        {
    echo "&nbsp&nbsp&nbsp
										<input type='radio' checked='true' name='type_dish' class='maintain' value='$data' onclick=run_dish('$data')>".strtoupper($data) ;

                        }
                        else {
                echo "&nbsp&nbsp&nbsp
											<input type='radio' name='type_dish' class='maintain' value='$data' onclick=run_dish('$data')>".strtoupper($data) ;

              }*/



                      }

                       ?> </div>
            </div>
          </div>
        </div><?php
                          /*  $cat_id=0;
                            $product_sql="select * from dish where status=1";
                            if(isset($_GET['cat_id']) && $_GET['cat_id']>0){
                                $cat_id=get_safe_value($_GET['cat_id']);
                                $product_sql.=" and category_id='$cat_id' ";
                            }
                            $product_sql.=" order by dish desc";
                            $product_res=mysqli_query($conn,$product_sql);
                            $product_count=mysqli_num_rows($product_res); */
                            $cat_id=0;
                            $product_sql="select * from dish where status=1";
                            if(isset($_GET['checked_id']) and $_GET['checked_id']!=""){


                              $product_sql.=" and category_id in ($value_string)";

                            }
                            if(isset($_GET['type_dish']) and $_GET['type_dish']!="" and $_GET['type_dish']!='both'){
                              $product_sql.=" and type='$type_dish'";
                            }

                            if($search_str!=''){
                                              $product_sql.=" and (dish like '%$search_str%' or dish_detail like '%$search_str%') ";
                                          }
                            $product_sql.=" order by dish Asc";

                            $product_res=mysqli_query($conn,$product_sql);
                              $product_count=mysqli_num_rows($product_res);

                        ?> <div class="grid-list-product-wrapper">
          <div class="product-grid product-view pb-20"> <?php if($product_count>0){?> <div class="row"> <?php while($product_row=mysqli_fetch_assoc($product_res)){?> <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                <div class="product-wrapper">
                  <div class="product-img">
                    <a href="javascript:void(0)">
                      <img src="
																<?php echo load.$product_row['image']?>" alt="">
                    </a>
                  </div>
                  <div class="product-content">
                    <h4> <?php

                                                      if($product_row['type']=="veg")
                                                      {
                                                        echo "
																<img src='assets/img/icon-img/veg.png'/>";

                                                      }
                                                      else
                                                      {
                                                        echo "
																<img src='assets/img/icon-img/non-veg.png'/>";

                                                      }

                                                       ?> <a href="javascript:void(0)"> <?php echo $product_row['dish'];
                                                       getRatingByDishId($product_row['id']);
                                                       ?> </a>
                    </h4> <?php
                                                //  $sql_details="SELECT * FROM dish_details WHERE dish_id={$product_row['id']}";
                                                $sql_details="select * from dish_details where status='1'
                                                and dish_id='".$product_row['id']."' order by price asc" ;


                                                  $sql_run=mysqli_query($conn,$sql_details);


                                                   ?> <?php if($website_close==0){ ?> <div class="product-price-wrapper container ">
                      <div class="row no-gutters "> <?php
                                                      while($row_row=mysqli_fetch_assoc($sql_run)) {

                                                        echo "
																	<div class='col-12 '>
																		<input type='radio' class='radio_details'
                                                        name='radio_fun".$product_row['id']."'
                                                        value='".$row_row['id']."'>".$row_row['attribute']."&nbsp";

                                                        echo '
																			<b>₹'.$row_row['price'].'</b>';
                                                        $added_msg="";

                                                        if(array_key_exists($row_row['id'],$cartArr))
                                                        {
                                                          $quantity=$cartArr[$row_row['id']]['qty'];
                                                          $added_msg="(Added -$quantity)";

                                                        }
                                                        echo "
																			<span class='cart_already_added' id='shop_added_msg_".$row_row['id']."'>$added_msg</span>";

                                                        echo "
																		</div>";




                                                      }

                                                      ?> </div>
                    </div>
                    <div class="product-price-wrapper container row no-gutters">
                      <select class="cart_select col-6 " name="" id="qty<?php echo $product_row['id']; ?>">
                        <option value="0">Quantity</option> <?php
                                                        for($x=1;$x<=100;$x++)
                                                        {
                                                          echo "
																		<option value='$x'>".$x."</option>";
                                                        }


                                                         ?>
                      </select>
                      <i class="fa fa-cart-plus cart_icon col-6 " style="padding-left:1rem;" aria-hidden="true" onclick="add_to_cart('<?php echo $product_row['id']?>','add')">
                      </i>
                    </div> <?php }
                                                   else{
                                                    ?> <div class="product-price-wrapper">
                      <strong> <?php echo $website_close_msg?> </strong>
                    </div> <?php
                                                  }


                                                   ?>
                  </div>
                </div>
              </div> <?php } ?> </div> <?php } else{
                                    echo "No dish found";
                                }?> </div>
        </div>
      </div> <?php
                    $cat_res=mysqli_query($conn,"select * from category where status=1 order by order_number desc")
                    ?> <div class="col-lg-3">
        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
          <div class="shop-widget">
            <h4 class="shop-sidebar-title">Shop By Categories</h4>
            <div class="shop-catigory">
              <ul id="faq" class="category_list">
                <li>
                  <a href="
																<?php echo user_login?>shop">
                    <u class="red_color">Clear</u>
                  </a>
                </li> <?php
                                      /*  while($cat_row=mysqli_fetch_assoc($cat_res)){
                                            $class="selected";
                                            if($cat_id==$cat_row['id']){
                                                $class="active";
                                            }
                                            echo "
														<li>
															<a class='$class' href='shop?cat_id=".$cat_row['id']."'>".$cat_row['category']."</a>
														</li>";

                                        }*/
                                        while($cat_row=mysqli_fetch_assoc($cat_res)){

                                        /*  if($cat_row['id']==$cat_id){
                                            $class="check";
                                          }
                                          else{
                                            $class="";

                                          }*/
                                          $checked="";
                                          $active=" ";

if(in_array($cat_row['id'],$value_array)){
  $checked="checked='checked'";
  $active="active";

}

                                          echo "
														<li class='$active'>
															<input $checked  type='checkbox'
                                           onclick=set_checkbox('".$cat_row['id']."')
                                           class='cat_checkbox ' value='".$cat_row['id']."'>".$cat_row['category']."
															</li>";

                                        }
                                        ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form class="" action="<?php echo user_login?>shop" method="get" id="checked_form">
  <input type="hidden" name="checked_id" value="<?php echo $value; ?>" id="checked_input" >
  <input type="hidden" name="type_dish" value="<?php echo $type_dish; ?>" id="type_dish" >
  <input type="hidden" name="search_str" id="search_str" value='<?php echo $search_str?>' />
</form> <?php
include("footer.php");

?>