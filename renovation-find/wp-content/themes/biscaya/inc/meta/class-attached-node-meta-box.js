// JavaScript Document

jQuery(document).ready(function($){
	var namespace = function(name, separator, container, val){
		var ns = name.split(separator || '.'),
		o = container || window, i, len;
		for(i = 0, len = ns.length; i < len; i++){
			var v = (i==len-1 && val) ? val : {};
			o = o[ns[i]] = o[ns[i]] || v;
		}
		return o;
	};
	var get_record_data = function () {
		var field_data = {}, 
			parent = $(this), 
			field_names = $(parent).find("input[name = 'rw_field_info[]']").map(function() {
				return $(this).val();
			 }).get(),
			 fields = $(parent).find("input:text, textarea, select, input:radio:checked, input:checkbox:checked, input:hidden").not(':disabled');
			 
		 //Cycle through the field_names
		$(field_names).each(function() {
			 name = this;
			 field = fields.filter("."+name);
			 if(field.length < 1) return;
			 if(field.attr("name").indexOf('[]') === -1) {
				temp = field.val();
			} else {
				temp = field.map(function() {
					return $(this).val()
				}).get();
			}
			namespace(name,'-',field_data,temp);
		 });
		 field_data['node_id'] = parent.find("input:hidden[name='node_id[]']").val();
		 return field_data;
	};
	
	var clear_node = function(parent) {
		$(parent).find(":input")
		.not(':button, :submit, :reset, :hidden, :checkbox, :radio')
		 .val('');
		$(parent).find(":checkbox, :radio").not(':button, :submit, :reset, :hidden')
		 .removeAttr('checked')
		 .removeAttr('selected');

	};
	$("a.save_node").live("click", function() {
		var data = {},
		temp = $(this).attr("rel").split('|'),
		new_nodes = $(this).closest("table.new_node");
		data = $(new_nodes).map(get_record_data).get();
		parent = $(this).closest("div.attached_nodes");
		$.post(ajaxurl,	{action: temp[0], 
				nonce: temp[1], 
				data: data, 
				post_ID: temp[2], 
				post_type: temp[3]},	
		function(response){
			if(response == -1) {
				alert("Error updating data");	
			} else {
				current = parent.find("div.current_nodes table");
				if($(current).length > 0) {
					parent.find("div.current_nodes").prepend(response);
				} else {
					parent.find("div.current_nodes").html(response);
				}
				$(new_nodes).each(function() {
					clear_node(this);
				});
				alert("Node saved!");
			}			
		});
		
		return false;
	});
	
	$("a.update_node").live("click", function () {
		var data = {},
		temp = $(this).attr("rel").split('|'),
		node = $(this).closest("table");
		data = $(node).map(get_record_data).get();
		$.post(ajaxurl,	{action: temp[0], 
				nonce: temp[1], 
				data: data, 
				post_ID: temp[2], 
				post_type: temp[3]},	
		function(response){
			if(response == -1) {
				alert("Error updating data");	
			} else {
				alert(response);	
			}
		});
		return false;
	});
	
	$("a.clear_node").live("click", function() {
		node = $(this).closest("table");
		$(node).each(function() {
			clear_node(this);
		});
		return false;
	});
	$("a.delete_node").live("click",function () {
			var parent = $(this).closest("table"),
					data = parent.find("input:hidden[name='node_id[]']").val(),
					temp = $(this).attr("rel").split('|');
			$.post(ajaxurl,	{action: temp[0], 
				nonce: temp[1], 
				data: data},	function(response){
				//$("#info").html(response).fadeOut(3000);

			});
			parent.fadeOut("slow");
			return false;
	});
	
	$("thead.toggle_body").click(function() {
		$(this).siblings("tbody").slideToggle('slow');;	
	});
});