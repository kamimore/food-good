<?php
include 'top.php';
if(isset($_GET['type']))
{
    $type=safe($_GET['type']);
    if($type=='edit')
    {
      $id = safe($_GET['id']);
      redirect("manage_coupon_code?id={$id}");

    }
    if($type=='delete')
    {
      $id = safe($_GET['id']);
      $query=mysqli_query($conn,"DELETE FROM coupon_code where id={$id}");
      redirect('coupon_code');
    }
    if($type=='active' or $type=='deactive')
    {

    $status=1;

      $id = safe($_GET['id']);
      if($type=='deactive')
      {
        $status=0;
      }

   mysqli_query($conn,"UPDATE coupon_code SET status={$status} where id={$id}");
    redirect('coupon_code');



    }
}
 $sql="SELECT * FROM coupon_code";
 $query=mysqli_query($conn,$sql);
 $num=1;

 ?>
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="h1">Coupon Codes</h4>
              <a href="<?php echo admin_path ?>manage_coupon_code" class="h4 d-block text-danger mb-2 decorate">Add Coupon Code</a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="5%">Code/Value</th>
                            <th width="10%">Type</th>
                            <th width="10%">Cart Min</th>
                            <th width="10%">Expired On</th>
                            <th width="10%">Added On</th>
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
                            <td><?php echo $row['coupon_code']; ?></br><?php echo "/".$row['coupon_value']; ?></td>
                            <td><?php echo $row['coupon_type'] ; ?></td>
                            <td><?php echo $row['cart_min_value'] ; ?></td>

                            <td><?php
                            $date=$row['expired_on'];
                            $form=strtotime($date);
                            $format=date('d-m-y',$form);
                             echo $format ;

                             ?></td>
                            <td><?php
                            $date=$row['added_on'];
                            $form=strtotime($date);
                            $format=date('d-m-y',$form);
                             echo $format ;

                             ?></td>
                            <td>
                            <a class="badge badge-warning text-uppercase cursor my-1" href="<?php echo admin_path; ?>coupon_code?type=edit&id=<?php echo $row['id'] ;?>">Edit</a>
                            &nbsp;
                            <?php
                            if($row['status']==1)
                            {
                              ?>
                              <a class="badge badge-success text-uppercase cursor  my-1" href="<?php echo admin_path; ?>coupon_code?type=deactive&id=<?php echo $row['id'] ;?>">Active</a>
                              &nbsp;
                              <?php
                            }
                            else {

                             ?>
                             <a class="badge badge-danger text-uppercase cursor my-1" href="<?php echo admin_path; ?>coupon_code?type=active&id=<?php echo $row['id'] ;?>">Deactive</a>
                             &nbsp;

                          <?php
                        }
                        ?>
                        <a class="badge badge-info text-uppercase cursor my-1" href="<?php echo admin_path; ?>coupon_code?type=delete&id=<?php echo $row['id'] ;?>">delete</a>
                          &nbsp;


                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                  <?php } ?>
                    </table>

                  </div>
				</div>
              </div>
            </div>
          </div>

	<?php
include 'footer.php';

   ?>
