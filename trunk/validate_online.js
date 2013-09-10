    $.validator.addMethod("check_files", function(value) {
    
    var uploader = $('#uploader').plupload('getUploader');

        // Files in queue upload them first
        if (uploader.files.length > 0) {
            // When all files are uploaded submit form
            if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) return true;
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    //$('form')[0].submit();
                    $("#order").submit();
                }
            });
            uploader.start();
        } else
            return true;

        }, 'check files');

$(document).ready(function() {

	var rules;

	function init_rules () {
		rules = {};
		rules = {
				email: {
					required: true,
					email: true
				},
				phone: {
					required: true,
					minlength: 5
					}
		};
	};

	function update_rules () {
		init_rules();
		if($('#orderDetailBlock').is(':visible')) {
			rules.detail = {
						required: true,
						minlength: 3
						};
			rules.auto = {
						required: true,
						minlength: 2
						};
			rules.autoyear = {
						required: true,
						range: [1900, 2030]
						};
            rules.enginesize = {
                        required: true,
                        minlength: 1
                        };
            rules.uploader_count = "check_files";
		}
	};

	update_rules();
	$("fieldset input").click(function(){$("fieldset label.error").remove()});

	var validator = $("#order").validate({
		rules: rules,
		messages:{
			email:{
				required: "будь-ласка, введіть ваш email",
				email: "email введений невірно",
			},
			phone: "будь-ласка, введіть правильний номер телефону",
			detail:{
				required: "будь-ласка, введіть назву запчастини",
				minlength: "назва повинно містити більше ніж 2 символи",
			},
			auto: "будь-ласка, введіть марку авто",
			autoyear: "будь-ласка, введіть рік випуску авто (4 цифри)",
            enginesize: "будь-ласка, вкажіть об&apos;єм двигуна",
			uploader_count: "зачекайте поки завантажаться файли"
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "phone") error.insertBefore($("#orderPhoneBlock"));
			if (element.attr("name") == "email") error.insertBefore($("#orderEmailBlock"));
			if (element.attr("name") == "detail") error.insertBefore($("#orderDetailBlock"));
			if (element.attr("name") == "auto") error.insertBefore($("#orderAutoBlock"));
			if (element.attr("name") == "autoyear") error.insertBefore($("#orderAutoYearBlock"));
            if (element.attr("name") == "enginesize") error.insertBefore($("#orderEngineSizeBlock"));
			if (element.attr("name") == "uploader_count") error.insertBefore($("#orderFile"));
		}
	});
})