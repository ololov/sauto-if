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
            return false;

        }, 'check files');

$(document).ready(function() {
						   
	$("fieldset input").click(function(){$("fieldset label.error").remove()});
	
	var validator = $("#order").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				minlength: 5
				},
            uploader_count: "check_files"
		},
		messages:{
			email:{
				required: "будь-ласка, введіть ваш email",
				email: "email введений невірно",
			},
			phone: "будь-ласка, введіть правильний номер телефону",
			uploader_count: "потрібно завантажити щонайменше 1 файл"
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "phone") error.insertBefore($("#orderPhoneBlock"));
			if (element.attr("name") == "email") error.insertBefore($("#orderEmailBlock"));
			if (element.attr("name") == "uploader_count") error.insertBefore($("#orderFile"));
		}	
	});
})