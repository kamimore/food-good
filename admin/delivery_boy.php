<?php
include 'top.php';
if(isset($_GET['type']))
{
    $type=safe($_GET['type']);
    if($type=='edit')
    {
      $id = safe($_GET['id']);
      redirect("manage_delivery_boy?id={$id}");

    }
    if($type=='active' or $type=='deactive')
    {

    $status=1;

      $id = safe($_GET['id']);
      if($type=='deactive')
      {
        $status=0;
      }

   mysqli_query($conn,"UPDATE delivery_boy SET status={$status} where id={$id}");
    redirect('delivery_boy');



    }
}
 $sql="SELECT * FROM delivery_boy";
 $query=mysqli_query($conn,$sql);
 $num=1;
 if(mysqli_num_rows($query) > 0){
 ?>
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="h1">Delivery Boy Master</h4>
              <a href="<?php echo admin_path ?>manage_delivery_boy" class="h4 d-block text-danger mb-2 decorate">Add Delivery Boy</a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="15%">Name</th>
                            <th width="10%">Mobile</th>
                            <th width="20%">Added on</th>
                            <th width="20%">Actions</th>


                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while($row=mysqli_fetch_assoc($query)){

                         ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['mobile'] ; ?></td>
                            <td><?php
                            $date=$row['added_on'];
                            $form=strtotime($date);
                            $format=date('d-m-y',$form);
                             echo $format ;

                             ?></td>
                            <td>
                            <a class="badge badge-warning text-uppercase cursor my-1" href="<?php echo admin_path; ?>delivery_boy?type=edit&id=<?php echo $row['id'] ;?>">Edit</a>
                            &nbsp;
                            <?php
                            if($row['status']==1)
                            {
                              ?>
                              <a class="badge badge-success text-uppercase cursor  my-1" href="<?php echo admin_path; ?>delivery_boy?type=deactive&id=<?php echo $row['id'] ;?>">Active</a>
                              &nbsp;
                              <?php
                            }
                            else {

                             ?>
                             <a class="badge badge-danger text-uppercase cursor my-1" href="<?php echo admin_path; ?>delivery_boy?type=active&id=<?php echo $row['id'] ;?>">Deactive</a>
                             &nbsp;

                          <?php
                        }
                        ?>

                            </td>

                        </tr>
                      <?php } ?>
                    </tbody>
                    </table>
                  <?php }
                  else {
                    echo "No data present";
                  } ?>
                  </div>
				</div>
              </div>
            </div>
          </div>

	<?php
include 'footer.php';

   ?>
