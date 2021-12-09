<?php
include('top.php');
$id="";

if(isset($_POST['submit'])){
	$money=safe($_POST['money']);
	$msg=safe($_POST['msg']);
	$id=safe($_GET['id']);

	manageWallet($id,$money,'in',$msg);
	redirect('user');
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Money</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Amount</label>
                      <input type="text" class="form-control" placeholder="Money" name="money" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Message</label>
                      <input type="textbox" class="form-control" placeholder="Message" name="msg">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>

		 </div>

<?php include('footer.php');?>
