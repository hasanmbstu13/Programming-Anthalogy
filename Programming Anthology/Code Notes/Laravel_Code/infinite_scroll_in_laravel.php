<?php 
// for pagination
$jobs = Project::where('status','!=', 'closed')->orderBy('created_at', 'DESC')->paginate(20);

// display pagination
<div id="pagination">
  <a href="{!!$jobs->nextPageUrl()!!}" class="next">next</a>
</div>
?>

<script type="text/javascript">
	var ias = jQuery.ias({
	  container:  '#tbodyLoadedData',
	  item:       '.projects',
	  pagination: '#pagination',
	  next:       '.next'
	});
</script>
