function editTag(id, name, form_name) {
  var clicks = $(this).data('clicks');
  var editedTag = $("#editedTagName" + id);
  if (clicks) {
	editedTag.html("<form action='/admin/tables/genres/"+ id + "/edit_genre' method='get'><input type='text' name='" 
	+ form_name + "' value='" + name + "' /><button type='submit'><i class='fa fa-check' aria-hidden='true'></i></button><input type='hidden' name='_token' id='csrf-token' value='{!! csrf_token() !!}' /></form>");
  } else {
     editedTag.html(name);
  }
  $(this).data("clicks", !clicks);
}

