

<link href="/assets/css/codemirror.min.css" rel="stylesheet">

<div class="bs-docs-header" id="content">
	<div class="container">
		<h1>Create New Section</h1>
		<p>
			Create a new section, in order to put more information to website.
		</p>

	</div>
</div>
<?php
if(isset($message) && $message != "")
{
?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $message; ?>
	</div>
<?php
}
?>

<style>
.center
{
	margin: auto;
	float: center;
}
</style>
<div class="row">
	<div class="col-md-10 center">
		<?php
			$action_url = "/dashboard/new-section";
			if(isset($option) && $option == "update")
			{
				$action_url = "/dashboard/update-section/".$section_id;
			}
		?>
		<form action="<?php echo $action_url; ?>" method="post">
		  <div class="form-group">
		    <label for="type">Type</label>
		    <select id="type" name="type" class="form-control">
			  <?php 
			  foreach($section_type as $key=>$type)
			  {
			  	if(isset($section['type']) && $section['type'] == $key)
			  	{
			  		$select = "selected";
			  	}
			  	else
			  	{
			  		$select = "";
			  	}
		  	?>
		  	<option <?php echo $select?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
		  	<?php
			  }

			  ?>
			</select>
		  </div>
		  <div class="form-group">
		    <label for="name">Name</label>
		    <input type="text" id="name" name="name" class="form-control" placeholder="name" value="<?php echo isset($section['name']) ? $section['name']: ""; ?>">
		  </div>
		  <div class="form-group">
		  	<label for="desc">Desc</label>
		    <input type="text" id="desc" name="desc" class="form-control" placeholder="desc" value="<?php echo isset($section['desc']) ? $section['desc']: ""; ?>">
		  </div>
		  <div class="form-group">
		  	<label for="code">Code</label>
		    <textarea class="form-control" name="code" id="code" rows="30"><?php echo isset($section['content']) ? htmlspecialchars($section['content']): ""; ?></textarea>
		  </div>
		  
		  
		  
		  <input type="submit" name="submit" value="Save" class="btn btn-default" />
		<?php
		  	if($option != "new")
		  	{
  		?>
  		<input type="submit" name="submit" value="Save and Close" class="btn btn-default" />
  		<?php
		  	}
		?>
		  
		</form>
	</div>
</div>

<script src="/assets/js/codemirror.min.js"></script>

<script>
	var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
	    lineNumbers: true,
	    mode: "htmlmixed"
	  });
  
</script>