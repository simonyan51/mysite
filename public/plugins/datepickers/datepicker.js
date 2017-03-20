$('#datetimepicker1').datetimepicker({
	format: 'yyyy-MM-dd hh:mm:ss'
});

$('#datetimepicker').datetimepicker({
	format: 'yyyy-MM-dd hh:mm:ss'
});

$('#calendar').datepicker({
	dateFormat: "yy-mm-dd",
	changeYear: true,
	changeMonth: true,
    inline: true,
    defaultDate: null,
    altField: '#datepicker',
 	onSelect: function() {
		window.location.href = "/client/movies/publishDate/" + $("#datepicker").val();
	}
});

$('#datepicker').change(function() {
    $('#calendar').datepicker('setDate', null);
});