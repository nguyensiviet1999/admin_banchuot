var path = $('#base_url').text()+'Main_Controller/DataTableForChuot';
var fieldName = ["tenchuot","hangsx","giamuavao","loaichuot","kichco","nhacungcap"];
console.log(path);
jQuery(document).ready(function() {
	$('#example').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:path,
			type:"POST",
			data:{fieldName:fieldName},
			dataType: "json",
		},

	});
	$('#example').removeAttr('style');
});

