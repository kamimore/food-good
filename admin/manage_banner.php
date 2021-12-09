<?php
include 'top.php';
$error="";
$msg="";
$image="";
$heading="";
$sub_heading="";
$link="";
$link_text="";
$order_number="";
$id="";

$image_error="";

if(isset($_GET['id'])){
  $id=safe($_GET['id']);
  $sql="select * from banner where id={$id}";
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);
  $image=$row['image'];
  $heading=$row['heading'];
  $sub_heading=$row['sub_heading'];
  $link=$row['link'];
  $link_text=$row['link_text'];
  $order_number=$row['order_number'];


}

if(isset($_POST['submit']))
{

    $heading=safe($_POST['heading']);
    $sub_heading=safe($_POST['sub_heading']);
    $link=safe($_POST['link']);
    $link_text=safe($_POST['link_text']);
    $order_number=safe($_POST['order_number']);
    $added_on=date('Y-m-d h:i:s');
    /*if($id==""){
      $sql="select * from category where category='{$category}'";

    }
    else {
      $sql="select * from category where category='{$category}' and id!={$id}";
    }

    if(mysqli_num_rows(mysqli_query($conn,$sql)) > 0){


      $msg="category already exists";
    }
    else{*/
      if($id==""){
        $name=$_FILES['image']['name'];
        $name=rand(111111111,999999999).'-'.$name;

        $type=$_FILES['image']['type'];
        $tmp_name=$_FILES['image']['tmp_name'];
        $size=$_FILES['image']['size'];
        if($type=="image/png" or $type=="image/jpg" or $type=="image/jpeg" ){
          move_uploaded_file($tmp_name,forward_banner.$name);

        $query=mysqli_query($conn,"INSERT INTO banner(image,heading,sub_heading,link,link_text,order_number,added_on,status)
        values('$name','$heading','$sub_heading','$link','$link_text',$order_number,'$added_on','1')");

  }
  else{
    $error="file type not supported";

  }
   }
      else {
        $name=$_FILES['image']['name'];
        if($name=="")
        {
        $query=mysqli_query($conn,"UPDATE banner set heading='{$heading}',sub_heading='{$sub_heading}',link='{$link}',link_text='{$link_text}',
          order_number={$order_number} where id={$id}");
        }
        else {
          $type=$_FILES['image']['type'];
          $name=rand(111111111,999999999).'-'.$name;
          $tmp_name=$_FILES['image']['tmp_name'];

          $sqlfast="select * from banner where id={$id}";
          $fast=mysqli_query($conn,$sqlfast);
          $row=mysqli_fetch_assoc($fast);

          $oldimage=$row['image'] ;
          unlink(forward_banner.$oldimage);
          if($type=="image/png" or $type=="image/jpg" or $type=="image/jpeg"){
            move_uploaded_file($tmp_name,forward_banner.$name);


            $query=mysqli_query($conn,"UPDATE banner set  image='$name',heading='{$heading}',sub_heading='{$sub_heading}',link='{$link}',link_text='{$link_text}',
              order_number={$order_number} where id={$id}");

          }
          else{
            $error="file type not supported";

          }


        }


      }
      if($error=="")
          {redirect('banner');}




  }
 ?>
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Enter Data</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!--form starting-->
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">

                         <div class="form-group">
                           <label for="exampleInputEmail3">Image</label>
                           <input type="file" class="form-control" id="exampleInputEmail3" name="image" value="<?php echo $image; ?>"
                           placeholder="Select image" <?php if(!isset($_GET['id'])){
                             ?> required <?php }else {} ?>>
                             <p class="badge badge-danger"><?php echo $error; ?></p>


                         </div>

                    <div class="form-group">
                      <label for="exampleInputName1">Heading</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="heading" placeholder="Enter Heading" value="<?php echo $heading; ?>" required>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Sub Heading</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="sub_heading" placeholder="Enter Sub Heading" value="<?php echo $sub_heading; ?>" required>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Link</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="link" placeholder="Enter Link" value="<?php echo $link; ?>" required>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Link Text</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="link_text" placeholder="Enter Link Text" value="<?php echo $link_text; ?>" required>

                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Order Number</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" name="order_number" value="<?php echo $order_number; ?>" placeholder="Enter order number" required>
                    </div>
                    <?php
                    if(isset($_GET['id']))
                    {
                      $query1=mysqli_query($conn,"select * from banner where id={$_GET['id']}");
                      $row1=mysqli_fetch_assoc($query1);
                      ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Status</label>
                        <input type="number" class="form-control" id="exampleInputName1" name="status"  value=<?php echo $row1['status']  ?> readonly>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Date</label>
                        <input type="date" class="form-control" id="exampleInputName1" name="added_on"  value=<?php echo $row1['added_on'] ?> readonly>
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
