<?php
	if($message != "")
	{
?>
<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<?php echo $message; ?>
</div>
<?php
	}
?>
<div class="panel panel-info panel-login">
  <div class="panel-heading">
    <h3 class="panel-title">Welcome to <?php echo $site_name; ?>!</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="/login">
	  <div class="form-group">
	    <label for="username">Username</label>
	    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
	  </div>
	  <div class="form-group">
	    <label for="password">Password</label>
	    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
	  </div>
	  
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>
  </div>
</div>