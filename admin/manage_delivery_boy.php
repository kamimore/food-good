<?php
include 'top.php';
$msg="";
$name="";
$mobile="";
$password="";
$id=0;
if(isset($_GET['id'])){
  $id=safe($_GET['id']);
  $sql="select * from delivery_boy where id={$id}";
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);

  $name=$row['name'];

  $mobile=$row['mobile'];
  $password=$row['password'];

}
if(isset($_POST['submit']))
{
    $name=safe($_POST['name']);

    $mobile=safe($_POST['mobile']);
    $password=md5(safe($_POST['password']));

    $added_on=date('y-m-d h-i-s');
    $sql="select * from delivery_boy where mobile='{$mobile}' and id!={$id}";

  /*  if($id==""){
      $sql="select * from delivery_boy where mobile='{$mobile}'";

    }
    else {
      $sql="select * from delivery_boy where mobile='{$mobile}' and id!={$id}";
    }*/

    if(mysqli_num_rows(mysqli_query($conn,$sql)) > 0){


      $msg="This Mobile Number already exists";
    }
    else{
      if($id=="" or $id==0){
        $query=mysqli_query($conn,"INSERT INTO delivery_boy(name,mobile,password,added_on,status) values('$name','$mobile','$password','$added_on','1')");
      }
      else {

        $query=mysqli_query($conn,"UPDATE delivery_boy set name='{$name}',mobile='{$mobile}',password='{$password}' where id={$id}");


      }



    redirect('delivery_boy');
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


                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Enter Name" value="<?php echo $name; ?>" required>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Mobile</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" name="mobile" value="<?php echo $mobile; ?>" placeholder="Enter mobile number" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Password</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" name="password" value="<?php echo $password; ?>" placeholder="Enter password" 
                      <?php echo isset($_GET['id'])?'readonly':'required' ?>>
                      <p class="badge badge-danger"><?php echo $msg; ?></p>
                    </div>

                    <?php
                    if(isset($_GET['id']))
                    {
                      $query1=mysqli_query($conn,"select * from delivery_boy where id={$_GET['id']}");
                      $row1=mysqli_fetch_assoc($query1);
                      ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Status</label>
                        <input type="number" class="form-control" id="exampleInputName1" name="status" placeholder="Enter status" 
                        value=<?php echo $row1['status']  ?> readonly>
                      </div>

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
