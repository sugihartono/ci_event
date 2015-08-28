$(function() {
    
    $("#btnSubmit").click(function() {
       submitEvent();
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
            locationLocationCode += $(this).html() + "#";
        });
        locationLocationCode = locationLocationCode.substr(0, locationLocationCode.length-1);
          
        $("#datatableZ .locationStoreCode").each(function() {
            locationStoreCode += $(this).html() + "#";
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
            eventIsPkp += $(this).html() + "#";
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
                alert("Error: " + errorThrown);
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
    
    $("#btnAddDate").click(function() {
        var tillcode = $("#tillcode option:selected").val(); 
        var sameDate = $("#sameDate").prop("checked");
        var eventStartDate = $("#eventStartDate").val();
        var eventEndDate = $("#eventEndDate").val();
        
        if (sameDate) tillcode = "";
        if (eventStartDate == eventEndDate)  eventEndDate = "";
        if (eventStartDate == "" && eventEndDate != "") {
            eventStartDate = eventEndDate;
            eventEndDate = "";
        }
        
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
    });
    
    $("#btnAddLocation").click(function() {
        var tillcode = $("#tillcode option:selected").val(); 
        var sameLocation = $("#sameLocation").prop("checked");
        var locationCode = $("#locationCode").val();
        var storeCode = $("#storeCode").val();
        
        if (sameLocation) tillcode = "";
        
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
    });
    
    $("#btnPoolTillcode").click(function() {
        var tillcode = $("#tillcode option:selected").val(); 
        var sameDate = $("#sameDate").prop("checked");
        var sameLocation = $("#sameLocation").prop("checked");
        var notes = $("#notes").val();
        var supplierCode = $("#supplierCode option:selected").val();
        var supplierResponsibility = $("#supplierResponsibility").val();
        var ydsResponsibility = $("#ydsResponsibility").val();
        var isPkp = $("#isPkp option:selected").val();
        var margin = $("#margin").val();
        
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
    });
    
    
});