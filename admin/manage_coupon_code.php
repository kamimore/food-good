<?php
include 'top.php';
$msg="";
$cond="";
$coupon_code="";
$coupon_type="";
$coupon_value="";
$cart_min_value="";
$expired_on="";
$id=0;
if(isset($_GET['id'])){
  $id=safe($_GET['id']);
  $sql="select * from coupon_code where id={$id}";
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);

  $coupon_code=$row['coupon_code'];

  $coupon_type=$row['coupon_type'];
  $coupon_value=$row['coupon_value'];
  $cart_min_value=$row['cart_min_value'];
  $expired_on=$row['expired_on'];

}
if(isset($_POST['submit']))
{
  $coupon_code=safe($_POST['coupon_code']);

  $coupon_type=safe($_POST['coupon_type']);
  $coupon_value=safe($_POST['coupon_value']);
  $cart_min_value=safe($_POST['cart_min_value']);
  $expired_on=safe($_POST['expired_on']);


    $added_on=date('y-m-d h-i-s');
    $sql="select * from coupon_code where coupon_code='{$coupon_code}' and id!={$id}";

    /*if($id==""){
      $sql="select * from coupon_code where coupon_code='{$coupon_code}'";

    }
    else {
      $sql="select * from coupon_code where coupon_code='{$coupon_code}' and id!={$id}";
    }*/

    if(mysqli_num_rows(mysqli_query($conn,$sql)) > 0){


      $msg="This Coupon Code already exists";
    }
    else{
      if($id=="" or $id==0){

       $query=mysqli_query($conn,"INSERT INTO coupon_code(coupon_code,coupon_type,coupon_value,cart_min_value,expired_on,status,added_on)
        values('$coupon_code','$coupon_type',$coupon_value,$cart_min_value,'$expired_on','1','$added_on')");


      }
      else {
        $query=mysqli_query($conn,"UPDATE coupon_code set coupon_code='{$coupon_code}',coupon_type='{$coupon_type}',coupon_value='{$coupon_value}',
          cart_min_value='{$cart_min_value}',expired_on='{$expired_on}'
           where id={$id}");


      }
  redirect('coupon_code');
  }

}


 ?>
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Enter Data</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" action="" method="post">

                    <div class="form-group">


                      <label for="exampleInputName1">Coupon Code</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="coupon_code" placeholder="Enter Coupon Code" value="<?php echo $coupon_code; ?>" required>
                      <p class="badge badge-danger"><?php echo $msg; ?></p>

                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Coupon Type</label>

                      <select class="form-control" id="exampleInputEmail3" name="coupon_type" required>
                    <?php
                  $array=array("P"=>"Percentage","F"=>"Flat");
                  foreach ($array as $key=>$value) {
                    $cond=$coupon_type==$key?'selected ':'';

                    echo "<option ".$cond."value=".$key.">".$value."</option>";

                  /*  if($coupon_type==$key){
                    echo "<option selected value=".$key.">".$value."</option>";

                  }
                  else{
                    echo "<option  value=".$key.">".$value."</option>";

                  }*/

                }

                     ?>

                      </select>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Coupon Value</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" name="coupon_value" value="<?php echo $coupon_value; ?>" placeholder="Enter Coupon Value" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Coupon Min Value</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" name="cart_min_value" value="<?php echo $cart_min_value; ?>" placeholder="Enter Coupon Min Value" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Expired On</label>
                      <input type="date" class="form-control" id="exampleInputEmail3" name="expired_on" value="<?php echo $expired_on; ?>" placeholder="Enter Expired Date" required>
                    </div>
                    <?php
                    if(isset($_GET['id']))
                    {
                      $query1=mysqli_query($conn,"select * from coupon_code where id={$_GET['id']}");
                      $row1=mysqli_fetch_assoc($query1);
                      ?>


                      <div class="form-group">
                        <label for="exampleInputName1">Date</label>
                        <input type="date" class="form-control" id="exampleInputName1" name="added_on" placeholder="Enter date" 
                        value=<?php echo $row1['added_on'] ?> readonly>
                      </div>
                  <?php   }
                     ?>
                    <button type="submit" class="btn btn-primary mr-2 btn-lg" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>

		 </div>

<?php

include 'footer.php';
 ?>
