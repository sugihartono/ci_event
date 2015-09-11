$(function() {
        $('#letterDate').datepicker({
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: "dd-mm-yy"
        });
                
        FormValidation.init();
});

var FormValidation = function () {

        var handleValidation1 = function() {
                // for more info visit the official plugin documentation: 
                // http://docs.jquery.com/Plugins/Validation

                var form1 = $('#frmAcara');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                        errorElement: 'span', //default input error message container
                        errorClass: 'help-inline', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "",
                        rules: {
                                department: {
                                    required: true
                                },
                                divisionCode: {
                                    required: true
                                },
                                letterDate: {
                                    required: true
                                },
                                about: {
                                    required: true
                                },
                                toward: {
                                    required: true
                                },
                                templateCode: {
                                    required: true
                                }
                        },
                        messages: {
                                department: {
                                    required: "Unit bisnis harus diisi."
                                },
                                divisionCode: {
                                    required: "Divisi harus diisi."
                                },
                                letterDate: {
                                    required: "Tgl. surat harus diisi"
                                },
                                about: {
                                    required: "Hal harus diisi"
                                },
                                toward: {
                                    required: "Kepada harus diisi"
                                },
                                templateCode: {
                                    required: "Template harus diisi"
                                }
                        },
    
                        invalidHandler: function (event, validator) { //display error alert on form submit              
                                $("#alertMessage").html("Tidak dapat melanjutkan. Silahkan periksa isian anda.");
                                error1.removeClass("hide");
                                FormValidation.scrollTo(error1, -200);
                        },
    
                        highlight: function (element) { // hightlight error inputs
                                $(element).closest('.required').removeClass('has-success').addClass('has-error'); // set error class to the control group
                        },
    
                        unhighlight: function (element) { // revert the change done by hightlight
                                $(element).closest('.required').removeClass('has-success').removeClass('has-error'); // set error class to the control group
                        },
    
                        success: function (label) {
                                label.closest('.required').removeClass('has-error').addClass('has-success'); // set success class to the control group
                        },
        
                        submitHandler: function (form) {
                                form.submit();
                        }
                    
                });
            
        }

        return {
                //main function to initiate the module
                init: function () {
                        handleValidation1();
                },
        
                // wrapper function to scroll to an element
                scrollTo: function (el, offeset) {
                        pos = el ? el.offset().top : 0;
                        jQuery('html,body').animate({
                                scrollTop: pos + (offeset ? offeset : 0)
                        }, 'slow');
                }

        };

}();