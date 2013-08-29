$(document).ready(function() {
						   
	$("fieldset input").click(function(){$("fieldset label.error").remove()});
	
	$("#order").validate({
		rules: {
			nickname: {
				required: true,
				minlength: 3
				},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				minlength: 5
				}
		},
		messages:{
			nickname:{
				required: "будь-ласка, введіть ваше ім&apos;я",
				minlength: "ім&apos;я повинно містити більше ніж 2 символи",
			},
			email:{
				required: "будь-ласка, введіть ваш email",
				email: "email введений невірно",
			},
			phone: "будь-ласка, введіть правильний номер телефону"
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "nickname") error.insertAfter($("input[name=nickname]"));
			if (element.attr("name") == "phone") error.insertAfter($("input[name=phone]"));
			if (element.attr("name") == "email") error.insertAfter($("input[name=email]"));
		}	
	});
})