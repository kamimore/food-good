<?php
include 'top.php';

if(isset($_GET['type']))
{
    $type=safe($_GET['type']);
    if($type=='edit')
    {
      $id = safe($_GET['id']);
      redirect("manage_banner?id={$id}");

    }
    if($type=='delete')
    {
      $id = safe($_GET['id']);
      $query=mysqli_query($conn,"DELETE FROM banner where id={$id}");
      redirect('banner');
    }
    if($type=='active' or $type=='deactive')
    {
    $status=1;

      $id = safe($_GET['id']);
      if($type=='deactive')
      {
        $status=0;
      }

   mysqli_query($conn,"UPDATE banner SET status={$status} where id={$id}");
    redirect('banner');

    }
}
 $sql="SELECT * FROM banner order by order_number";
 $query=mysqli_query($conn,$sql);
 $num=1;

 ?>
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="h1">Banner Master</h4>
              <a href="<?php echo admin_path ?>manage_banner" class="h4 d-block text-danger mb-2 decorate">Add Banner</a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="10%">S.No</th>
                          <th width="15%">Image</th>
                          <th width="15%">Heading</th>
                          <th width="15%">Sub Heading</th>
                          <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <?php  if(mysqli_num_rows($query) > 0){ ?>

                      <tbody>
                        <?php
                        while($row=mysqli_fetch_assoc($query)){

                         ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><a href='<?php echo load_banner.$row['image'] ; ?>' target="_blank">
                              <img src='<?php echo load_banner.$row['image'] ; ?>' alt=""></a></td>
                            <td><?php echo $row['heading'] ; ?></td>
                            <td><?php echo $row['sub_heading'] ?></td>
                            <td>
                            <a class="badge badge-warning text-uppercase cursor my-1" href="<?php echo admin_path; ?>banner?type=edit&id=<?php echo $row['id'] ;?>">Edit</a>
                            &nbsp;
                            <?php
                            if($row['status']==1)
                            {
                              ?>
                              <a class="badge badge-success text-uppercase cursor my-1" href="<?php echo admin_path; ?>banner?type=deactive&id=<?php echo $row['id'] ;?>">Active</a>
                              &nbsp;
                              <?php
                            }
                            else {

                             ?>
                             <a class="badge badge-danger text-uppercase cursor my-1" href="<?php echo admin_path; ?>banner?type=active&id=<?php echo $row['id'] ;?>">Deactive</a>
                             &nbsp;

                          <?php
                        }
                        ?>

                            <a class="badge badge-info text-uppercase cursor my-1" href="<?php echo admin_path; ?>banner?type=delete&id=<?php echo $row['id'] ;?>">delete</a>
                            &nbsp;
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
