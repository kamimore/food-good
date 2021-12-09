<?php
include 'top.php';
if(isset($_GET['type']))
{
    $type=safe($_GET['type']);
    if($type=='edit')
    {
      $id = safe($_GET['id']);
      redirect("manage_dish?id={$id}");

    }
    if($type=='active' or $type=='deactive')
    {

    $status=1;

      $id = safe($_GET['id']);
      if($type=='deactive')
      {
        $status=0;
      }

   mysqli_query($conn,"UPDATE dish SET status={$status} where id={$id}");
    redirect('dish');



    }
}
 $sql="SELECT category.category ,dish.* FROM dish join category on category.id=dish.category_id order by id desc";
 $query=mysqli_query($conn,$sql);
 $num=1;
 ?>
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="h1">Dish Master</h4>
              <a href="<?php echo admin_path ?>manage_dish" class="h4 d-block text-danger mb-2 decorate">Add Dishes</a>

              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="10%">Category</th>
                            <th width="10%">Dish</th>
                            <th width="20%">Image</th>
                            <th width="20%">Added on</th>
                            <th width="20%">Actions</th>
                          </tr>
                      </thead>
                      <?php  if(mysqli_num_rows($query) > 0){
         ?>
                      <tbody>
                        <?php
                        while($row=mysqli_fetch_assoc($query)){

                         ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['dish']; ?>(<?php echo strtoupper($row['type'] );?>)</td>
                            <td><a href='<?php echo load.$row['image'] ; ?>' target="_blank">
                              <img src='<?php echo load.$row['image'] ; ?>' alt=""></a></td>


                            <td><?php
                            $date=$row['added_on'];
                            $form=strtotime($date);
                            $format=date('d-m-y',$form);
                             echo $format ;

                             ?></td>
                            <td>
                            <a class="badge badge-warning text-uppercase cursor my-1" href="<?php echo admin_path; ?>dish?type=edit&id=<?php echo $row['id'] ;?>">Edit</a>
                            &nbsp;
                            <?php
                            if($row['status']==1)
                            {
                              ?>
                              <a class="badge badge-success text-uppercase cursor my-1 " href="<?php echo admin_path; ?>dish?type=deactive&id=<?php echo $row['id'] ;?>">Active</a>
                              &nbsp;
                              <?php
                            }
                            else {

                             ?>
                             <a class="badge badge-danger text-uppercase cursor my-1" href="<?php echo admin_path; ?>dish?type=active&id=<?php echo $row['id'] ;?>">Deactive</a>
                             &nbsp;

                          <?php
                        }
                        ?>

                            </td>

                        </tr>
                      <?php } ?>
                    </tbody>
                  <?php }
                 ?>
                    </table>

                  </div>
				</div>
              </div>
            </div>
          </div>

	<?php
include 'footer.php';

   ?>
