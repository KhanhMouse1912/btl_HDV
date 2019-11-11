
$(document).ready(function () {

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    // $("#btn-close").click(function () {
    //
    // });


    $(".update_button").click( function() {

        var kindOfRelationship_json = JSON.parse($('#kindOfRelationShip_id').attr('value'));
        var relationship =  $(this).attr('value');
        var key='';
        for (var i in relationship) {
          key += relationship[i];
          break;
        }
        var relationshipJson = JSON.stringify(relationship);
       var jsons = JSON.parse(relationship);
        var optsKindOf =  "<option value='"+ jsons['kind_of_relation'].id_kindOfRelationship+"'>"+jsons['kind_of_relation'].nameOfRelationship+"</option>";
        $.each(kindOfRelationship_json, function (i,item) {
            if( item.id_kindOfRelationship != jsons['kind_of_relation'].id_kindOfRelationship) {
                optsKindOf += "<option value='"+ item.id_kindOfRelationship+"'>"+item.nameOfRelationship+"</option>";
            }

        });
        $('#kindOfRelationShip_id').html(optsKindOf);
        $(".create--rela").addClass('active');
        $("#name-relationship-noti").val(jsons.name);
        $("#phone-number-noti").val(jsons.phoneNumber);
        $("#time-met-noti").val(jsons.time_met);
        $("textarea#note_relationship-noti").val(jsons.note);
        $("#form-relationship").attr("action","/relationship/update")
        $("#infor").append(" <div class=\"form-group\" id='id_remove'>\n" +
            "                            <label for=\"exampleInputEmail1\">ID</label>\n" +
            "                            <input type=\"text\" class=\"form-control\" id=\"id-relationship-noti\"\n" +
            "                                aria-describedby=\"emailHelp\" name=\"id_relationship\" readonly required>\n" +
            "                        </div>");
        $("#id-relationship-noti").val(jsons.id_relationship);
        var opts_ward = "<option value='"+ jsons['addresses'].wards+"'>" + jsons['addresses'].ward_name + "</option>";
        var opts_district = "<option value='"+ jsons['addresses'].district+"'>" + jsons['addresses'].district_name + "</option>";
        var opts_city = "<option value='"+ jsons['addresses'].city+"'>" + jsons['addresses'].city_name + "</option>";
        var address_json = JSON.parse($('#address').attr('value'));

        for (let j =0;j<address_json.length;j++) {
                if(address_json[j].ID != jsons['addresses'].city)
                opts_city += "<option value='"+ address_json[j].ID+"'>"+address_json[j].Title+"</option>";

            }
            // opts_city += "<option value='"+item.ID+"'>" +item.Title+ "</option>";

        $("#ward").html(opts_ward);
        $("#district").html(opts_district);
        $("#address").html(opts_city);

        // $.ajax({
        //     type: "GET",
        //     url: "/getWard",
        //     data: {id_ward:id},
        //     // dataType: 'json',
        //     cache: false,
        //     timeout: 600000,
        //     success: function (data) {
        //         var opts;
        //         for(let i=0;i<data.length;i++) {
        //             opts += "<option value='" + data[i].ID + "'>" + data[i].Title + "</option>";
        //         }
        //         $("#ward").append(opts);
        //     },
        //     error: function (e) {
        //
        //         var json = "<h4>Ajax Response</h4><pre>"
        //             + e.responseText + "</pre>";
        //         $('#feedback').html(json);
        //
        //         console.log("ERROR : ", e);
        //         $("#btn-search").prop("disabled", false);
        //
        //     }
        // });


    } );

    $("#address").change(function (event) {

        //stop submit the form, we will post it manually.
        event.preventDefault();
        $("#district").find("option").remove();
        $("#ward").find("option").remove();
        getDistrict();

    });
    $("#district").change(function (event) {

        //stop submit the form, we will post it manually.
        event.preventDefault();
        $("#ward").find("option").remove();

        getWard();

    });

});

function getWard() {
    var id = $("#district option:selected").val();
    $.ajax({
        type: "GET",
        url: "/getWard",
        data: {id_ward:id},
        // dataType: 'json',
        cache: false,
        timeout: 600000,
        success: function (data) {
            var opts;
            for(let i=0;i<data.length;i++) {
                opts += "<option value='" + data[i].ID + "'>" + data[i].Title + "</option>";
            }
            $("#ward").append(opts);
        },
        error: function (e) {

            var json = "<h4>Ajax Response</h4><pre>"
                + e.responseText + "</pre>";
            $('#feedback').html(json);

            console.log("ERROR : ", e);
            $("#btn-search").prop("disabled", false);

        }
    });

}

function getDistrict() {


    var id = $("#address option:selected").val();


    $.ajax({
        type: "GET",
        url: "/getDistrict",
        data: {id_city:id},
        // dataType: 'json',
        cache: false,
        timeout: 600000,
        success: function (data) {
            var opts;
            for(let i=0;i<data.length;i++) {
                opts += "<option value='" + data[i].ID + "'>" + data[i].Title + "</option>";
            }
            $("#district").append(opts);
        },
        error: function (e) {

            var json = "<h4>Ajax Response</h4><pre>"
                + e.responseText + "</pre>";
            $('#feedback').html(json);

            console.log("ERROR : ", e);
            $("#btn-search").prop("disabled", false);

        }
    });

}
