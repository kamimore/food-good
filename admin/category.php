<?php
include 'top.php';
if(isset($_GET['type']))
{
    $type= safe($_GET['type']);
    if($type=='edit')
    {
      $id = safe($_GET['id']);
      redirect("manage_category?id={$id}");

    }
    if($type=='delete')
    {
      $id = safe($_GET['id']);
      $query=mysqli_query($conn,"DELETE FROM category where id={$id}");
      redirect('category');
    }
    if($type=='active' or $type=='deactive')
    {

    $status=1;

      $id =safe($_GET['id']);
      if($type=='deactive')
      {
        $status=0;
      }

   mysqli_query($conn,"UPDATE category SET status={$status} where id={$id}");
    redirect('category');



    }
}
 $sql="SELECT * FROM category";
 $query=mysqli_query($conn,$sql);
 $num=1;

 ?>
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="h1">Category Master</h4>
              <a href="<?php echo admin_path ?>manage_category" class="h4 d-block text-danger mb-2 decorate">Add Category</a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">

                      <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="15%">Category</th>
                            <th width="10%">Order Number</th>
                            <th width="20%">Actions</th>

                        </tr>
                      </thead>
                      <?php  if(mysqli_num_rows($query) > 0){ ?>
                      <tbody>
                        <?php
                        while($row=mysqli_fetch_assoc($query)){

                         ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['order_number'] ; ?></td>
                            <td>
                            <a class="badge badge-warning text-uppercase cursor my-1" href="<?php echo admin_path; ?>/category?type=edit&id=<?php echo $row['id'] ;?>">Edit</a>
                            &nbsp;
                            <?php
                            if($row['status']==1)
                            {
                              ?>
                              <a class="badge badge-success text-uppercase cursor my-1 " href="<?php echo admin_path; ?>/category?type=deactive&id=<?php echo $row['id'] ;?>">Active</a>
                              &nbsp;
                              <?php
                            }
                            else {

                             ?>
                             <a class="badge badge-danger text-uppercase cursor my-1" href="<?php echo admin_path; ?>/category?type=active&id=<?php echo $row['id'] ;?>">Deactive</a>
                             &nbsp;

                          <?php
                        }
                        ?>

                            <a class="badge badge-info text-uppercase cursor my-1" href="<?php echo admin_path; ?>/category?type=delete&id=<?php echo $row['id'] ;?>">delete</a>
                            &nbsp;




                            </td>

                        </tr>
                      <?php } }?>
                    </tbody>
                    </table>

                  </div>
				</div>
              </div>
            </div>
          </div>

	<?php
include 'footer.php';

   ?>
