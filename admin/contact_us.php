<?php
include 'top.php';
if(isset($_GET['type']))
{
    $type=safe($_GET['type']);

    if($type=='delete')
    {
      $id = safe($_GET['id']);
      $query=mysqli_query($conn,"DELETE FROM contact_us where id={$id}");
      redirect('contact_us');
    }

}
 $sql="SELECT * FROM contact_us order by id ";
 $query=mysqli_query($conn,$sql);
 $num=1;

 ?>
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="h1">Comments Master</h4>

              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10%">S.No #</th>
                            <th width="10%">Name</th>
              							<th width="10%">Email</th>
              							<th width="10%">Mobile</th>
              							<th width="19%">Subject</th>
              							<th width="40%">Message</th>
                            <th width="10%">Actions</th>
                        </tr>
                      </thead>
                      <?php  if(mysqli_num_rows($query) > 0){ ?>
                      <tbody>
                        <?php
                        while($row=mysqli_fetch_assoc($query)){

                         ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email'] ; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['subject'] ; ?></td>
                            <td><?php echo $row['message'] ; ?></td>
                            <td>
                            <a class="badge badge-info text-uppercase cursor" href="<?php echo admin_path; ?>contact_us?type=delete&id=<?php echo $row['id'] ;?>">delete</a>

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
