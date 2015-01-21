

	
	<div class="bs-docs-header" id="content">
      <div class="container">
        <h1>Section List</h1>
        <p>
          List all sectioins for website.
        </p>

      </div>
  </div>
<?php
if(isset($error_message) && $error_message != "")
{
?>
  <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $error_message; ?>
  </div>
<?php
}
//success_message
if(isset($success_message) && $success_message != "")
{
?>
  <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $success_message; ?>
  </div>
<?php
}
?>

  <div class="row" id="list-section">
    <div class="col-md-12">
      <table class="table table-bordered">
      <thead>
        <tr>
          <th>Type</th>
          <th>Name</th>
          <th>Sort Order</th>
          <th>Status</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(isset($sections) && !empty($sections))
          {
            foreach($sections as $section)
            {
        ?>
        <tr>
          <th scope="row">
            <?php echo isset($section_type[$section['type']]) ? $section_type[$section['type']] : ""; ?>
          </th>
          <td><?php echo $section['name']; ?></td>
          <td><?php echo $section['sort_order']; ?></td>
          <td>
            <?php 
              if($section['enabled'] == 1)
              {
                echo "Yes";
              }
              else
              {
                echo "NO";
              }
            ?>
          </td>
          <td width="10%">
            <div class="btn-group">
              <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Update <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/dashboard/update-section/<?php echo $section['section_id']; ?>">Update</a></li>
                <li>
                  <a href="/dashboard/update-section-status/<?php echo $section['section_id']; ?>">
                  <?php
                    if($section['enabled'] == 1)
                    {
                      echo "Disable";
                    }
                    else
                    {
                      echo "Enable";
                    }
                  ?>  
                  </a>
                </li>
                <li><a href="/dashboard/remove-section/<?php echo $section['section_id']; ?>">Remove</a></li>
              </ul>
            </div>
          </td><!--Update, remove-->
        </tr>
        <?php
            }
          }
          else
          {
        ?>
        <th colspan="5">No section yet. Please <a href="/dashboard/new-section">create new</a> section first.</th>
        <?php
          }
        ?>
        
      </tbody>
    </table>
    </div>
  </div>  

