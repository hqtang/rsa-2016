
<style>
body.dragging, body.dragging * {
  cursor: move !important;
}

@media (min-width: 768px)
{

.control-panel
{
  margin: auto;
  margin-top: 20px;
  width: 100px;
}
.sections-panel
{
  margin-right: 0;
  margin-left: 0;
  background-color: #fff;
  border-color: #ddd;
  border-width: 1px;
  border-radius: 4px 4px 0 0;
  -webkit-box-shadow: none;
  box-shadow: none;
}
}
.sections-panel
{
  position: relative;
  padding: 15px 15px 15px;
  margin: auto;
  width: 600px;
  border-color: #e5e5e5 #eee #eee;
  border-style: solid;
  border-width: 1px 0;
  -webkit-box-shadow: inset 0 3px 6px rgba(0,0,0,.05);
  box-shadow: inset 0 3px 6px rgba(0,0,0,.05);
}
.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}
ol.example
{
  list-style-type:none;
  margin-left: -42px;
}

ol.example li.placeholder {
  position: relative;

  /** More li styles **/
}
ol.example li.placeholder:before {
  position: absolute;
  /** Define arrowhead **/
}
ol.example li.section-item
{
  padding: 20px;
  margin-bottom: 10px;
}
</style>
<script>
$(function  () {
  $("ol.example").sortable()
})
</script>
	
	<div class="bs-docs-header" id="content">
      <div class="container">
        <h1>Sort Section</h1>
        <p>
          Sort all sections in constructive order, make the website more professional.
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
<form action="/dashboard/sort-sections" method="POST">
  <div class="sections-panel">
    <ol class='example'>
      <?php
        if(isset($sections) && !empty($sections))
        {
          foreach($sections as $section)
          {
      ?>
      <li class="bg-primary section-item">
        <?php echo $section['name']; ?> 
        
        <?php echo $section['enabled'] == 0 ? "(Disabled)" : ""; ?>
        
        <input type="hidden" name="sort_order[]" value="<?php echo $section['section_id']?>" />
      </li>
      <?php
          }
        }
      ?>  
    </ol> 
    <?php
      if(!isset($sections) || empty($sections))
      {
    ?>
    No body section yet. Please <a href="/dashboard/new-section">create new</a> section first.
    <?php
      }
    ?>
    
  </div>

  <div class="control-panel">
    <input class="btn btn-success" type="submit" value="Update" />
  </div>
</form>



<script src="http://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>