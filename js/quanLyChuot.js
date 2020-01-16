var base_url = $('#base_url').text()+'Main_Controller/';
var ready_continue = false;
jQuery(document).ready(function() {
	loadDataForInsert();
	reloadTable();
});
$('#myBtn').click(function(event) {
	loadDataForInsert();
	btnClick();
});
function btnClick () {
	document.getElementById("myModal").style.display = "block";
}
$('body').on('click', '#myModal', function(event) {
	if (event.target==document.getElementById("myModal")) {
		document.getElementById("myModal").style.display = "none";
		reloadFormInsert();
	}
});
function loadDataForInsert (){
	// $.ajax({
	// 	url: base_url+'getAllDataByTableName',
	// 	type: 'POST',
	// 	dataType: 'json',
	// 	data: {table_name:['hangsx','loaichuot','kichco','nhacungcap']},
	// })
	// .done(function(res) {
	// 	var option='';
	// 	$.each(res.hangsx, function(index, val) {
	// 		 option += '<option value="'+val['id_hangsx']+'">'+val['hangsx']+'</option>';
	// 	});
	// 	$('[name=id_hangsx]').html(option);
	// 	option='';
	// 	$.each(res.loaichuot, function(index, val) {
	// 		 option += '<option value="'+val['id_loaichuot']+'">'+val['loaichuot']+'</option>';
	// 	});
	// 	$('[name=id_loaichuot]').html(option);
	// 	option='';
	// 	$.each(res.kichco, function(index, val) {
	// 		 option += '<option value="'+val['id_kichco']+'">'+val['kichco']+'</option>';
	// 	});
	// 	$('[name=id_kichco]').html(option);
	// 	option='';
	// 	$.each(res.nhacungcap, function(index, val) {
	// 		 option += '<option value="'+val['manhacungcap']+'">'+val['nhacungcap']+'</option>';
	// 	});
	// 	$('[name=manhacungcap]').html(option);
	// 	$('select').select2({
	// 		placeholder: "Select a state",
 //  			allowClear: true,
	// 	});
	// })
	// .fail(function() {
	// 	console.log("error");
	// })
	// .always(function(res) {
		
	// });
	$.each($('select.insert'), function(index, val) {        
		var tablename = $(this).data('tablename');
		console.log(base_url+'getDataForSelect2');
		var fieldData =[$(this).attr('name'),tablename];
		$(this).select2({
			placeholder: "Select a state",
			allowClear: true,
			delay:200,
			width:'100%',
			ajax:{
				url: base_url+'getDataForSelect2',
				type: 'POST',
				dataType: 'json',
				data: function(params){
					return {
						search: params.term,
						table_name: tablename,
						fieldData: fieldData
					};
				},
				processResults: function(data) {
					console.log(data);
					return{
						results: data
					};
				},
				cache: true
			},
		});
	});
	
}

// $('body').on('click', '#xacnhan', function(event) {
$('#xacnhan').click(function(event) {
	$('#xacnhan').attr('hidden',"");
	$('#myModal .alert').remove();
	var jsonData={};
	$.each($('.insert'), function(index, val) {
		 jsonData[$(this).attr("name")] = $(this).val();
	});
	dataValidate = $( "form" ).serialize();
	$.ajax({
		url: base_url+"validateInsert",
		type: 'POST',
		data:dataValidate,
	})
	.done(function(res) {
		console.log("success1");
		console.log($.trim(res));
		if($.trim(res)=="success") {
			$.ajax({
			url: 'insertToTable/chuot',
			type: 'POST',
			dataType: 'json',
			data: {datatable: JSON.stringify(jsonData),},
			})
			.done(function() {
				console.log("success2");
				document.getElementById("myModal").style.display = "none";
				alert("insert thành công");
				$.each($('.insert'), function(index, val) {
					$(this).val("");
				});
				reloadTable();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");

			});
		}
		else{
			$('#myModal h2').after(res);
		}
	})
	.fail(function(res) {
		
	})
	.always(function() {
		$('#xacnhan').removeAttr('hidden');
	});
});
$('body').on('click', '.xoa', function(event) {
	var dieukienxoa = {};
	$(this).parent().parent().remove();
	dieukienxoa['machuot'] = $(this).parent().next().children().val();

	$.ajax({
		url: base_url+'/deleteData/chuot',
		type: 'POST',
		dataType: 'json',
		data: {
			dieukien:JSON.stringify(dieukienxoa)
		},
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function(res) {
		console.log("complete");
		if (res) {
			alert("Xóa thành công");
		}
		else
		{
			alert("Xóa thất bại");
		}
		reloadTable();
	}); 
});
$('body').on('click', '.sua', function(event) {
	btnClick ();
	$('h2').text('Sửa dữ liệu bảng Quản lý Chuột');
	$('.insert').attr('class', 'form-control dulieusua');
	$('#xacnhan').attr('hidden',"");
	$('#luu').removeAttr('hidden');
	var machuot = $(this).parent().next().children().val();
	$('[name=tenchuot]').parent().append('<input hidden type="text" name="machuot" value="'+machuot+'">');
	$.ajax({
		url: base_url+'getDataOfTableChuotByID/chuot',
		type: 'POST',
		dataType: 'json',
		data: {machuot : machuot},
	})
	.done(function(res) {
		console.log("success");
		var dataElement = res[0];
		showDataForUpdateForm(dataElement);
		console.log(dataElement);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});
function showDataForUpdateForm (dataElement) {
	$(['name=machuot']).val(dataElement.machuot);
	$('[name=tenchuot]').val(dataElement.tenchuot);
	$('[name=id_hangsx]').val(dataElement.id_hangsx);
	$('[name=giamuavao]').val(dataElement.giamuavao);
	$('[name=id_loaichuot]').val(dataElement.id_loaichuot);
	$('[name=soluongtrongkho]').val(dataElement.soluongtrongkho);
	$('[name=id_kichco]').val(dataElement.id_kichco);
	$('[name=manhacungcap]').val(dataElement.manhacungcap);
}
$('body').on('click', '#luu', function(event) {
	$('#luu').attr('hidden',"");
	$('#myModal .alert').remove();
	var dataSua = {};
	var form_data = $( "form" ).serializeArray();
	$.each(form_data, function(index, val) {
		 dataSua[val.name] = val.value;
	});
	var dieukiensua = {};
	dieukiensua['machuot'] = $('[name=machuot]').val();
	dataValidate = $( "form" ).serialize();
	$.ajax({
		url: base_url+"validateInsert",
		type: 'POST',
		data:dataValidate,
	})
	.done(function(res) {
		console.log("success1");
		console.log($.trim(res));
		if($.trim(res)=="success") {
			$.ajax({
				url: base_url+'updateData/chuot',
				type: 'POST',
				dataType: 'json',
				data: {
					data_sua: JSON.stringify(dataSua),
					dieukien: JSON.stringify(dieukiensua)
				},
			})
			.done(function() {
				console.log("success");
				alert("Sửa thành công");
				document.getElementById("myModal").style.display = "none";
				reloadFormInsert();
				reloadTable();
			})
			.fail(function(res) {
				console.log("error");
				alert("Sửa thất bại");
			})
			.always(function(res) {
				console.log("complete");
			});
		}
		else{
			$('#myModal h2').after(res);
			showDataForUpdateForm(dataSua);
			console.log(dataSua);
		}
	})
	.fail(function(res) {
		
	})
	.always(function() {
		$('#luu').removeAttr('hidden');
	});
});
function reloadFormInsert () {
	$('h2').text('Nhập dữ liệu bảng Quản lý Chuột');
	$('.dulieusua').attr('class', 'form-control insert');
	$('#luu').attr('hidden',"");
	$('#xacnhan').removeAttr('hidden');
	$.each($('.insert'), function(index, val) {
		$(this).val("");
	});
	$('input[name=machuot]').remove();
}
function reloadTable () {
	if($.fn.dataTable.isDataTable( '#example' )){
		$('#example').DataTable().destroy();
		$('#example tbody').html("");
	}
	var fieldName = ["tenchuot","hangsx","loaichuot","nhacungcap"];
	$('#example').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"lengthMenu":[5,10,15,20,100],
		"autoWidth": false,
		"columnDefs": [ {
	      "targets": 4,
	      "orderable": false,
	    } ],
		"ajax":{
			url:base_url+'DataTableForChuot',
			type:"POST",
			data:{fieldName:fieldName},
			dataType: "json",
		},
	});
	jQuery(document).ready(function() {
		$('#example').attr('style',"");
	});
}


