<?php
include 'top.php';
$error="";
$dishDetailsIdArr="";

$condfortype="";
$condforcategory="";

$msg="";
$category_id="";
$type="";
$image="";
$dish="";
$attributeArr=array();
$priceArr=array();
$dish_detail="";
$id=0;

if(isset($_GET['id'])){
  $id=safe($_GET['id']);
  $sql="select * from dish where id={$id}";

  $query=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($query);

  $category_id=$row['category_id'];
	$type=$row['type'];
  $dish=$row['dish'];
  $dish_detail=$row['dish_detail'];

}

//this is used to directly remove the dish_detail table record .
if(isset($_GET['dish_details_id']) && $_GET['dish_details_id']>0)
{
	$dish_details_id=safe($_GET['dish_details_id']);
	$id=safe($_GET['id']);
	mysqli_query($conn,"delete from dish_details where id='$dish_details_id'");
	redirect('manage_dish?id='.$id);
}
//end....

if(isset($_POST['submit']))
{


    $category_id=safe($_POST['category_id']);

    $dish=safe($_POST['dish']);
    $dish_detail=safe($_POST['dish_detail']);
    $food_type=safe($_POST['type']);

    $added_on=date('y-m-d h-i-s');

    //this three attribute are for dish_detail table
    $attributeArr=safe($_POST['attribute']);
    $priceArr=safe($_POST['price']);
    $statusArr=safe($_POST['status']);
    //end....

    //this is to check if dish name already exits in dish table for both cases inserting and updating the data

    $sql="select * from dish where dish='{$dish}' and id!={$id}";

  /*  if($id==""){
      $sql="select * from dish where dish='{$dish}'";
    }
    else {
      $sql="select * from dish where dish='{$dish}' and id!={$id}";
    }*/

    //end...


    if(mysqli_num_rows(mysqli_query($conn,$sql)) > 0){


      $msg="Dish already Exists";
    }
    else{
      //now this is the case for inserting the new data
      if($id=="" or $id==0){


          $name=$_FILES['image']['name'];
          $name=rand(111111111,999999999).'-'.$name;

          $type=$_FILES['image']['type'];
          $tmp_name=$_FILES['image']['tmp_name'];
          $size=$_FILES['image']['size'];

          if($type=="image/png" or $type=="image/jpg" or $type=="image/jpeg" ){
            move_uploaded_file($tmp_name,forward.$name);

            $query=mysqli_query($conn,"INSERT INTO dish(category_id,dish,dish_detail,image,added_on,type,status)
            values($category_id,'$dish','$dish_detail','$name','$added_on','$food_type','1')");

            $did=mysqli_insert_id($conn);
//inserting the data into dish_details table
            foreach($attributeArr as $key=>$value){

            $price=$priceArr[$key];
            $status=$statusArr[$key];


              $sql_dish="INSERT INTO
             dish_details(dish_id,attribute,price,status,added_on)
             values($did,'$value',$price,$status,'$added_on')";
            $query_dish=mysqli_query($conn,$sql_dish);
          }
  //end...

          }
          else{
            $error="file type not supported";

          }


      }
      //end...
      else {
        //This is the case for updtion
        $name=$_FILES['image']['name'];

        //based on this updation and insertion into dish_detail mysql_list_table will take place
        $dishDetailsIdArr=safe($_POST['dish_details_id']);

        foreach($attributeArr as $key=>$value){
          $attribute=$value;

        $price=$priceArr[$key];
        $status=$statusArr[$key];

        if(isset($dishDetailsIdArr[$key])){
          $did=$dishDetailsIdArr[$key];
          mysqli_query($conn,"update dish_details
          set attribute='$attribute',price='$price',status='$status'
           where id='$did'");
        }
        else{
          mysqli_query($conn,"insert into
           dish_details(dish_id,attribute,price,status,added_on)
           values('$id','$attribute','$price','$status','$added_on')");
        }
      }

      //end...

        if($name=="")
        {
          $query=mysqli_query($conn,"UPDATE dish set category_id='{$category_id}',dish='{$dish}'
          ,dish_detail='{$dish_detail}',type='$food_type' where id={$id}");

        }
        else{

          //for image code..
          $type=$_FILES['image']['type'];
          $name=rand(111111111,999999999).'-'.$name;
          $tmp_name=$_FILES['image']['tmp_name'];

          //for image code..

          $sqlfast="select * from dish where id={$id}";

          $fast=mysqli_query($conn,$sqlfast);
          $row=mysqli_fetch_assoc($fast);

          $oldimage=$row['image'] ;
          unlink(forward.$oldimage);



          if($type=="image/png" or $type=="image/jpg" or $type=="image/jpeg"){
            move_uploaded_file($tmp_name,forward.$name);
            $query=mysqli_query($conn,"UPDATE dish set category_id='{$category_id}',dish='{$dish}',dish_detail='{$dish_detail}',image='{$name}',type='$food_type' where id={$id}");
          
          }
          else{
            $error="file type not supported";

          }
        }



      }

      //end....


if($error=="")
    {redirect('dish');}
  }

}


 ?>
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Enter Data</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">

                      <input type="text" name="id" value="<?php echo $id; ?> " hidden>
                      <label for="exampleInputName1">Category</label>
                      <select class="form-control" name="category_id">
                        <?php

                        if(!isset($_GET['id'])){
                          $selected="selected";
                        }
                        else {
                          $selected="";

                        }

                         ?>
                        <option disabled  <?php echo $selected; ?>>Select Category</option>


                        <?php

                        $run="SELECT * FROM Category where status=1";
                        $show=mysqli_query($conn,$run);


                        while($data=mysqli_fetch_assoc($show)){

                          $condforcategory=$category_id==$data['id']?' selected':' ';


                          echo "<option".$condforcategory." value=".$data['id'].">".$data['category']."</option>";



                          /*if($category_id==$data['id'])
                          {
                              echo "<option selected value=".$data['id'].">".$data['category']."</option>";
                          }
                          else{
                              echo "<option value=".$data['id'].">".$data['category']."</option>";
                          }*/



                                    }
                         ?>


                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Dish</label>

                      <input type="text" class="form-control" id="exampleInputEmail3" name="dish" value="<?php echo $dish; ?>" placeholder="Enter dish Name" required>
                      <p class="badge badge-danger"><?php echo $msg; ?></p>

                    </div>
                    <div class="form-group">
                                <label for="exampleInputName1">Type</label>
                                <select class="form-control" name="type" required>
          						<option value="">Select Type</option>
          						<?php
                      $arrType=array("veg","non-veg");

          						foreach($arrType as $list){
                        $condfortype=$list==$type?' selected ':' ';
                        echo "<option ".$condfortype." value='$list' >".strtoupper($list)."</option>";

          							/*if($list==$type){
          								echo "<option value='$list' selected>".strtoupper($list)."</option>";
          							}else{
          								echo "<option value='$list'>".strtoupper($list)."</option>";
          							}*/
          						}
          						?>
          					  </select>

                              </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Dish Detail</label>
                      <input type="text" class="form-control" id="exampleInputEmail3"
                      name="dish_detail" value="<?php echo $dish_detail; ?>" placeholder="Enter dish detail" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Image</label>
                      <input type="file" class="form-control" id="exampleInputEmail3" name="image" value="<?php echo $image; ?>"
                      placeholder="Select image" <?php if(!isset($_GET['id'])){
                        ?> required <?php }else {} ?>>
                        <p class="badge badge-danger"><?php echo $error; ?></p>


                    </div>

                    <?php
                    if(isset($_GET['id']))
                    {
                      $query1=mysqli_query($conn,"select * from dish where id={$_GET['id']}");
                      $row1=mysqli_fetch_assoc($query1);
                      ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Status</label>
                        <input type="number" class="form-control" id="exampleInputName1" name="status" placeholder="Enter status" value="<?php echo $row1['status']  ?>" readonly>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Date</label>
                        <input type="date" class="form-control" id="exampleInputName1" name="added_on" placeholder="Enter date" value="<?php echo $row1['added_on'] ?>" readonly>
                      </div>
                  <?php   }
                     ?>


                     <!---here i am -->
                     <div class="form-group" id="dish_box">
                       <label for="exampleInputName1">Dish Details</label>
                       <?php
                       if(!isset($_GET['id'])){
                        ?>
                       <div class="row mt-2">
                         <div class="col-4">
                           <input type="text" name="attribute[]"
                           class="form-control" placeholder="Attribute" required>

                         </div>
                         <div class="col-3">
                           <input type="text" name="price[]"
                           class="form-control" placeholder="Price"  required>


                         </div>
                         <div class="col-3">
           								<select required name="status[]" class="form-control">
           									<option value="">Select Status</option>
           									<option value="1" selected>Active</option>
           									<option value="0">Deactive</option>
           								</select>
           							</div>

                       </div>
                     <?php }else{
                       $ii=0;
                        //$help=0;
                       $dish_details_res=mysqli_query($conn,"select * from dish_details where dish_id='$id'");
                       ?>


                       <?php
                       while($dish_details_row=mysqli_fetch_assoc($dish_details_res)){


                        ?>

                        <div class="row mt-2" id="help_<?php echo $help; ?>" >


                          <div class="col-4">
                            <input type="hidden" name="dish_details_id[]" value="<?php echo $dish_details_row['id']?>">
                        <input type="text" name="attribute[]"  required class="form-control" placeholder="Attribute"
              value="<?php echo $dish_details_row['attribute']?>">
                          </div>
                          <div class="col-3">
                            <input type="text" name="price[]"  required
                            class="form-control" placeholder="Price" value="<?php echo $dish_details_row['price'] ;?>">


                          </div>
                          <div class="col-3">
            								<select required name="status[]" class="form-control">
            									<option value="">Select Status</option>
            									<?php
            									if($dish_details_row['status']==1){
            									?>
            										<option value="1" selected>Active</option>
            										<option value="0">Deactive</option>
            									<?php } ?>
            									<?php
            									if($dish_details_row['status']==0){
            									?>
            										<option value="1">Active</option>
            										<option value="0" selected>Deactive</option>
            									<?php } ?>
            								</select>
            							</div>

                          <?php  if($ii>0){?>
                          <div class="col-2"><button type="button" class="btn badge-danger mr-2" 
                          onclick="remove_edit('<?php echo $dish_details_row['id']?>')" >Remove</button></div>
                        <?php }
                        ++$ii;

                        ?>


                        </div>


                     <?php
                     //$help=$help+1;
                    }}

                      ?>

                     </div>


                    <button type="submit" class="btn btn-primary mr-2 btn-lg" name="submit">Submit</button>
                    <button type="button" class="btn btn-success mr-2 btn-lg" onclick="add_more()">Add More</button>
                  </form>
                </div>
              </div>
            </div>

		 </div>
     <input type="hidden" id="add_more" value="1"/>


<?php

include 'footer.php';
 ?>
<script>
function add_more(){
  var add_more=jQuery('#add_more').val();
  add_more++;
  jQuery('#add_more').val(add_more);
  var html=`<div class="row mt8" id="box-${add_more}"><div class="col-4"><input type="text" class="form-control"
   placeholder="Attribute" name="attribute[]"  required></div><div class="col-3"><input type="text" class="form-control"
   placeholder="Price" name="price[]"  required></div><div class="col-3">
   <select class="form-control"  required name="status[]"><option value="">Select Status</option><option value="1" selected>
   Active</option><option value="0">Deactive</option></select></div>
   <div class="col-2"><button type="button" class="btn badge-danger mr-2"
    onclick=remove_more("${add_more}")>Remove</button></div></div>`;



  jQuery('#dish_box').append(html);
}
function remove_more(value){
  jQuery(`#box-${value}`).remove();
}
function remove_edit(id){
  if(confirm('Are you sure?')){
    var cur_path=window.location.href;
    window.location.href=cur_path+"&dish_details_id="+id;
  }

}

</script>
