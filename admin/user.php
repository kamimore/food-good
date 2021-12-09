<?php
include 'top.php';
if(isset($_GET['type']))
{
    $type=safe($_GET['type']);
    if($type=='active' or $type=='deactive')
    {

    $status=1;

      $id = safe($_GET['id']);
      if($type=='deactive')
      {
        $status=0;
      }

   mysqli_query($conn,"UPDATE user SET status={$status} where id={$id}");
    redirect('user');



    }
}
 $sql="SELECT * FROM user order by id desc";
 $query=mysqli_query($conn,$sql);
 $num=1;

 ?>
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="h1">User Master</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="10%">S.No #</th>
                          <th width="12%">Name</th>
                          <th width="12%">Email</th>
            <th width="12%">Mobile</th>
            <th width="10%">Wallet</th>
                          <th width="14%">Added On</th>
            <th width="28%">Actions</th>

                        </tr>
                      </thead>
<?php if(mysqli_num_rows($query) > 0){ ?>
                      <tbody>
                        <?php

                        while($row=mysqli_fetch_assoc($query)){
                         ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email'] ; ?></td>
                            <td><?php echo $row['mobile'] ; ?></td>
                            <td><?php echo getWalletAmt($row['id'])?></td>

                            <td><?php
                            $date=$row['added_on'];
                            $form=strtotime($date);
                            $format=date('d-m-y',$form);
                             echo $format ;

                             ?></td>



                            <td>
                            <?php
                            if($row['status']==1)
                            {
                              ?>
                              <a class="badge badge-success text-uppercase cursor my-1 " href="<?php echo admin_path; ?>user?type=deactive&id=<?php echo $row['id'] ;?>">Active</a>
                              &nbsp;
                              <?php
                            }
                            else {

                             ?>
                             <a class="badge badge-danger text-uppercase cursor my-1" href="<?php echo admin_path; ?>user?type=active&id=<?php echo $row['id'] ;?>">Deactive</a>
                             &nbsp;

                          <?php
                        }
                        ?>
                        <a href="<?php echo admin_path; ?>add_money?id=<?php echo $row['id']?>" class="badge badge-info hand_cursor my-1"><span>Add Money</span>

                          </a>

                            </td>

                        </tr>
                      <?php }?>
                    </tbody>
                  <?php } ?>
                </table>
                  </div>
				</div>
              </div>
            </div>
          </div>


          </div>
	<?php
include 'footer.php';

   ?>
