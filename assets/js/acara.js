$(function() {
    var opts = {vMin: '0.00', vMax: '100.00'};
    
    $("#supplierResponsibility").autoNumeric('init', opts);
    $("#ydsResponsibility").autoNumeric('init', opts);
    $("#margin").autoNumeric('init', opts);
    
    FormValidation.init();
    
    //$("#btnSubmit").click(function() {
       //submitEvent();
    //});
    
});

function submitEvent() {
    var dateTillcode = "";
    var dateEventStartDate = "";
    var dateEventEndDate = "";
    
    var locationTillcode = "";
    var locationLocationCode = "";
    var locationStoreCode = "";
    
    var eventTillcode = "";
    var eventSupplierCode = "";
    var eventSupplierResponsibility = "";
    var eventYdsResponsibility = "";
    var eventIsPkp = "";
    var eventMargin = "";
    var eventNotes = "";
    
    var sameDate = $("#sameDate").prop("checked") ? 1 : 0;
    var sameLocation = $("#sameLocation").prop("checked") ? 1 : 0;
    
    var pkp = "";
    var loc = "";
    var sto = "";
    
    $("#datatableY .dateTillcode").each(function() {
        dateTillcode += $(this).html() + "#";
    });
    dateTillcode = dateTillcode.substr(0, dateTillcode.length-1);
    
    $("#datatableY .dateEventStartDate").each(function() {
        dateEventStartDate += $(this).html() + "#";
    });
    dateEventStartDate = dateEventStartDate.substr(0, dateEventStartDate.length-1);
    
    $("#datatableY .dateEventEndDate").each(function() {
        dateEventEndDate += $(this).html() + "#";
    });
    dateEventEndDate = dateEventEndDate.substr(0, dateEventEndDate.length-1);
    
    $("#datatableZ .locationTillcode").each(function() {
        locationTillcode += $(this).html() + "#";
    });
    locationTillcode = locationTillcode.substr(0, locationTillcode.length-1);
     
    $("#datatableZ .locationLocationCode").each(function() {
        loc = arrLocation[$(this).html()];
        locationLocationCode += loc + "#";
    });
    locationLocationCode = locationLocationCode.substr(0, locationLocationCode.length-1);
      
    $("#datatableZ .locationStoreCode").each(function() {
        sto = arrStore[$(this).html()];
        locationStoreCode += sto + "#";
    });
    locationStoreCode = locationStoreCode.substr(0, locationStoreCode.length-1);
    
    $("#datatableX .eventTillcode").each(function() {
        eventTillcode += $(this).html() + "#";
    });
    eventTillcode = eventTillcode.substr(0, eventTillcode.length-1);
    
    $("#datatableX .eventSupplierCode").each(function() {
        eventSupplierCode += $(this).html() + "#";
    });
    eventSupplierCode = eventSupplierCode.substr(0, eventSupplierCode.length-1);
    
    $("#datatableX .eventSupplierResponsibility").each(function() {
        eventSupplierResponsibility += $(this).html() + "#";
    });
    eventSupplierResponsibility = eventSupplierResponsibility.substr(0, eventSupplierResponsibility.length-1);
    
    $("#datatableX .eventYdsResponsibility").each(function() {
        eventYdsResponsibility += $(this).html() + "#";
    });
    eventYdsResponsibility = eventYdsResponsibility.substr(0, eventYdsResponsibility.length-1);
    
    $("#datatableX .eventIsPkp").each(function() {
        pkp = $(this).html() == "PKP" ? "1" : "0";
        eventIsPkp += pkp + "#";
    });
    eventIsPkp = eventIsPkp.substr(0, eventIsPkp.length-1);
    
    $("#datatableX .eventMargin").each(function() {
        eventMargin += $(this).html() + "#";
    });
    eventMargin = eventMargin.substr(0, eventMargin.length-1);
    
    $("#datatableX .eventNotes").each(function() {
        eventNotes += $(this).html() + "#";
    });
    eventNotes = eventNotes.substr(0, eventNotes.length-1);
    
    var dataString = "dateTillcode=" + dateTillcode + "&dateEventStartDate=" + dateEventStartDate + "&dateEventEndDate=" + dateEventEndDate +
                    "&locationTillcode=" + locationTillcode + "&locationLocationCode=" + locationLocationCode + "&locationStoreCode=" + locationStoreCode +
                    "&eventTillcode=" + eventTillcode + "&eventSupplierCode=" + eventSupplierCode + "&eventSupplierResponsibility=" + eventSupplierResponsibility +
                    "&eventYdsResponsibility=" + eventYdsResponsibility + "&eventIsPkp=" + eventIsPkp + "&eventMargin=" + eventMargin + "&eventNotes=" + eventNotes +
                    "&sameLocation=" + sameLocation + "&sameDate=" + sameDate;
    
    $.ajax({
        type: "POST",
        url: baseUrl+"acara/save",
        data: dataString,
        beforeSend: function() {
            //$("#imgLoading").removeClass("hide");
        },
        success: function(data) {
            alert("Input berhasil");
        },
        error: function(xhr, textStatus, errorThrown) {
            //alert("Error: " + errorThrown);
        },
        complete: function(xhr, textStatus) {
            //$("#imgLoading").addClass("hide");
        }
    });
    
}

$("#frmAcaraNext").on("reset", function() {
    resetDetailTables();
});

function resetDetailTables() {
    var row =   "<tr id='dummyRowY'>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                "</tr>";
    
    $("#datatableY tr:gt(0)").remove();
    $("#datatableY > tbody:last").append(row);
    
    var row =   "<tr id='dummyRowZ'>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                "</tr>";
    
    $("#datatableZ tr:gt(0)").remove();
    $("#datatableZ > tbody:last").append(row);
    
    var row =   "<tr id='dummyRowX'>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                    "<td>&nbsp;</td>" + 
                "</tr>";
    
    $("#datatableX tr:gt(0)").remove();
    $("#datatableX > tbody:last").append(row);
}

function addDeleteRowEvent(id) {
    $(".btnRowDelete").click(function() {
        $(this).closest("tr").remove();
        
        var rowCount = $("#" + id + " tr").length;
        
        if (rowCount == 1) {
            if (id == "datatableY") {
               var row =   "<tr id='dummyRowY'>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                            "</tr>";
                
                $("#datatableY > tbody:last").append(row);
            }
            else if (id == "datatableZ") {
                var row =   "<tr id='dummyRowZ'>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                            "</tr>";
                
                $("#datatableZ > tbody:last").append(row);
            }
            else if (id == "datatableX") {
                var row =   "<tr id='dummyRowX'>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                                "<td>&nbsp;</td>" + 
                            "</tr>";
                
                $("#datatableX > tbody:last").append(row);
            }
        }
    });
}

function locationExist(tillcode, sameLocation, locationCode, storeCode) {
    var check = "";
    var ret = false;
    
    if (sameLocation) {
        var row = locationCode + storeCode;
    }
    else {
        var row = tillcode + locationCode + storeCode;
    }
    
    $("#datatableZ > tbody  > tr").each(function() {
    
        check = "";    
        $("td", this).each(function (index) {
            if (sameLocation) {
                if (index > 0 && index < 3) {
                    check += $(this).html().trim();
                }
            }
            else {
                if (index < 3) {
                    check += $(this).html().trim();
                }
            }
        });
        
        if (check == row) {
            ret = true;
            return false;
        }
        
        return true;
    });
    
    return ret;
}

function dateExist(tillcode, sameDate, eventStartDate, eventEndDate) {
    var check = "";
    var ret = false;
    
    if (sameDate) {
        var row = eventStartDate + "" + eventEndDate;
    }
    else {
        var row = tillcode + "" + eventStartDate + "" + eventEndDate;
    }
    
    $("#datatableY > tbody  > tr").each(function() {
    
        check = "";    
        $("td", this).each(function (index) {
            if (sameDate) {
                if (index > 0 && index < 3) {
                    check += $(this).html().trim();
                }
            }
            else {
                if (index < 3) {
                    check += $(this).html().trim();
                }
            }
        });
        
        if (check == row) {
            ret = true;
            return false;
        }
        
        return true;
    });
    
    return ret;
}

function tillcodeExist(tillcode, supplierCode, supplierResponsibility, ydsResponsibility, isPkp, margin, notes) {
    var check = "";
    var ret = false;
    var row = tillcode + supplierCode + supplierResponsibility + ydsResponsibility + isPkp + margin + notes;
    
    $("#datatableX > tbody  > tr").each(function() {
    
        check = "";    
        $("td", this).each(function (index) {
            if (index < 7) {
                check += $(this).html().trim();
            }
        });
        
        if (check == row) {
            ret = true;
            return false;
        }
        
        return true;
    });
    
    return ret;
}

$("#btnAddDate").click(function() {
    var tillcode = $("#tillcode option:selected").val(); 
    var sameDate = $("#sameDate").prop("checked");
    var eventStartDate = $("#eventStartDate").val();
    var eventEndDate = $("#eventEndDate").val();
    
    if (tillcode == "" || (eventStartDate == "" && eventEndDate == "")) {
        alert("Silahkan mengisi tillcode dan tanggal terlebih dahulu.");
        return;
    }
    
    if (sameDate) tillcode = "";
    if (eventStartDate == eventEndDate)  eventEndDate = "";
    if (eventStartDate == "" && eventEndDate != "") {
        eventStartDate = eventEndDate;
        eventEndDate = "";
    }
    
    if (!(dateExist(tillcode, sameDate, eventStartDate, eventEndDate))) {
        var row =   "<tr>" + 
                        "<td class='dateTillcode'>" + tillcode + "</td>" + 
                        "<td class='dateEventStartDate'>" + eventStartDate + "</td>" + 
                        "<td class='dateEventEndDate'>" + eventEndDate + "</td>" + 
                        "<td>" + 
                            "<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" + 
                                "<i class='fa fa-trash-o'></i> delete" + 
                            "</a>" + 
                        "</td>" + 
                    "</tr>";
        
        if ($("#datatableY tr#dummyRowY").length) {
            $("#datatableY tr#dummyRowY").remove();
        }
        
        $("#datatableY > tbody:last").append(row);
        
        addDeleteRowEvent("datatableY");
        $("#eventStartDate").val("");
        $("#eventEndDate").val("");
    }
    else {
        alert("Data tanggal sudah ada.");
    }
});

$("#btnAddLocation").click(function() {
    var tillcode = $("#tillcode option:selected").val(); 
    var sameLocation = $("#sameLocation").prop("checked");
    var locationCode = $("#locationCode").val();
    var storeCode = $("#storeCode").val();
    
    if (tillcode == "" || locationCode == "" || storeCode == "") {
        alert("Silahkan mengisi tillcode dan lokasi terlebih dahulu.");
        return;
    }
    
    if (sameLocation) tillcode = "";
    
    if (!locationExist(tillcode, sameLocation, locationCode, storeCode)) {
        var row =   "<tr>" + 
                        "<td class='locationTillcode'>" + tillcode + "</td>" + 
                        "<td class='locationLocationCode'>" + locationCode + "</td>" + 
                        "<td class='locationStoreCode'>" + storeCode + "</td>" + 
                        "<td>" + 
                            "<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" + 
                                "<i class='fa fa-trash-o'></i> delete" + 
                            "</a>" + 
                        "</td>" + 
                    "</tr>";
        
        if ($("#datatableZ tr#dummyRowZ").length) {
            $("#datatableZ tr#dummyRowZ").remove();
        }
        
        $("#datatableZ > tbody:last").append(row);
        
        addDeleteRowEvent("datatableZ");
        $("#locationCode").val("");
        $("#storeCode").val("");
    }
    else {
        alert("Data lokasi sudah ada.");
    }
});

$("#btnPoolTillcode").click(function() {
    var tillcode = $("#tillcode option:selected").val(); 
    var notes = $("#notes").val();
    var supplierCode = $("#supplierCode option:selected").val();
    var supplierResponsibility = $("#supplierResponsibility").val();
    var ydsResponsibility = $("#ydsResponsibility").val();
    var isPkp = $("#isPkp option:selected").val();
    var margin = $("#margin").val();
    
    isPkp = isPkp == "1" ? "PKP" : "NPKP";
    
    if (tillcode == "" || supplierCode == "" || supplierResponsibility == "" || ydsResponsibility == "" || isPkp =="" || margin == "") {
        alert("Silahkan lengkapi isian terlebih dahulu.");
        return;
    }
    
    if (!tillcodeExist(tillcode, supplierCode, supplierResponsibility, ydsResponsibility, isPkp, margin, notes)) {
        var row =   "<tr>" + 
                        "<td class='eventTillcode'>" + tillcode + "</td>" +
                        "<td class='eventSupplierCode'>" + supplierCode + "</td>" +
                        "<td class='eventSupplierResponsibility'>" + supplierResponsibility + "</td>" +
                        "<td class='eventYdsResponsibility'>" + ydsResponsibility + "</td>" +
                        "<td class='eventIsPkp'>" + isPkp + "</td>" + 
                        "<td class='eventMargin'>" + margin + "</td>" + 
                        "<td class='eventNotes'>" + notes + "</td>" + 
                        "<td>" + 
                            "<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" + 
                                "<i class='fa fa-trash-o'></i> delete" + 
                            "</a>" + 
                        "</td>" + 
                    "</tr>";
        
        if ($("#datatableX tr#dummyRowX").length) {
            $("#datatableX tr#dummyRowX").remove();
        }
        
        $("#datatableX > tbody:last").append(row);
        
        addDeleteRowEvent("datatableX");
        //$(this).closest("#frmAcaraNext").find("input[type=text], select").val("");
    }
    else {
        alert("Data tillcode sudah ada.");
    }
});

var FormValidation = function () {

        var handleValidation1 = function() {
                // for more info visit the official plugin documentation: 
                // http://docs.jquery.com/Plugins/Validation

                var form1 = $('#frmAcaraNext');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                        errorElement: 'span', //default input error message container
                        errorClass: 'help-inline', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "",
                        rules: {
                                supplierCode: {
                                    required: true
                                },
                                categoryCode: {
                                    required: true
                                },
                                tillcode: {
                                    required: true
                                },
                                supplierResponsibility: {
                                    required: true
                                },
                                ydsResponsibility: {
                                    required: true
                                },
                                isPkp: {
                                    required: true
                                },
                                margin: {
                                    required: true
                                }
                        },
                        messages: {
                                supplierCode: {
                                    required: "Supplier harus diisi."
                                },
                                categoryCode: {
                                    required: "Kategori harus diisi."
                                },
                                tillcode: {
                                    required: "Tillcode harus diisi."
                                },
                                supplierResponsibility: {
                                    required: "Pert. supplier harus diisi."
                                },
                                ydsResponsibility: {
                                    required: "Pert. yogya harus diisi."
                                },
                                isPkp: {
                                    required: "Tipe margin harus diisi."
                                },
                                margin: {
                                    required: "Margin harus diisi."
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
                                //form.submit();
                                submitEvent();
                                //alert('aye');
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