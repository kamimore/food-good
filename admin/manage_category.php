<?php
include 'top.php';
$msg="";
$category="";
$order_number="";
$id=0;
if(isset($_GET['id'])){
/*  echo " i get here";
  echo $_GET['id'];
  die();*/
  $id=safe($_GET['id']);
  $sql="select * from category where id={$id}";
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);
  $category=$row['category'];
  $order_number=$row['order_number'];


}
if(isset($_POST['submit']))
{
    $category=safe($_POST['category']);

    $order_number=safe($_POST['order_number']);
    $added_on=date('y-m-d h-i-s');

    $sql="select * from category where category='{$category}' and id!={$id}";

  /* if($id==""){
      $sql="select * from category where category='{$category}'";

    }
    else {
      $sql="select * from category where category='{$category}' and id!={$id}";
    }*/

    if(mysqli_num_rows(mysqli_query($conn,$sql)) > 0){


      $msg="category already exists";
    }
    else{
      if($id=="" or $id==0){
        $query=mysqli_query($conn,"INSERT INTO category(category,order_number,added_on,status) 
        values('$category','$order_number','$added_on','1')");
      }
      else {

        $query=mysqli_query($conn,"UPDATE category set category='{$category}',order_number={$order_number} where id={$id}");


      }



    redirect('category');
  }

}


 ?>
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10"><?php echo isset($_GET['id'])?'Update Category':'Add New Category' ?></h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" action="" method="post">

                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="category" placeholder="Enter category" value="<?php echo $category; ?>" required>
                      <p class="badge badge-danger text-uppercase mt-1"><?php echo $msg; ?></p>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Order Number</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" name="order_number" value="<?php echo $order_number; ?>" placeholder="Enter order number" required>
                    </div>
                    <?php
                    if(isset($_GET['id']))
                    {
                      $query1=mysqli_query($conn,"select * from category where id={$_GET['id']}");
                      $row1=mysqli_fetch_assoc($query1);
                      ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Status</label>
                        <input type="number" class="form-control" id="exampleInputName1" name="status" placeholder="Enter status" value=<?php echo $row1['status']  ?> readonly>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Date</label>
                        <input type="date" class="form-control" id="exampleInputName1" name="added_on" placeholder="Enter date" value=<?php echo $row1['added_on'] ?> readonly>
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
