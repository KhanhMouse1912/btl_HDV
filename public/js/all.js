// function openCity(evt, cityName) {
//   var i, tabcontent, tablinks;
//   tabcontent = document.getElementsByClassName("tabcontent");
//   for (i = 0; i < tabcontent.length; i++) {
//     tabcontent[i].style.display = "none";
//   }
//   tablinks = document.getElementsByClassName("tablinks");
//   for (i = 0; i < tablinks.length; i++) {
//     tablinks[i].className = tablinks[i].className.replace(" active", "");
//   }
//   document.getElementById(cityName).style.display = "block";
//   evt.currentTarget.className += " active";
// }

// Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();

  $(document).ready(function () {

    $(".info").click( function() {
      $("#more--info").toggleClass("active");
    });
    // $(".info--user .info").siblings().removeClass('active');
    $(".notifications--newest").click( function() {
      $(".detail--notification").toggleClass("active");
    });

    // =================== RELATIONSHIPS
    $(".view--more").click( function() {
      console.log($(this).parent().toggleClass("active"));
      $(this).parent().toggleClass("active");
    } );
    $(".show--actions").click( function() {
      $(this).parent().find(".actions--rela").toggleClass('active');
    });
    $(".actions--delete").click( function() {
      if(confirm('Are you sure?')) {
        $.post("/api/reminder/delete/"+$(this).data('id'), function(data, status){
          location.reload();
        });
      }
    });
    $("#datepicker").datepicker({
      autoclose: true, 
      todayHighlight: true
    }).datepicker('update', new Date());
    $("#datepicker1").datepicker({ 
      autoclose: true, 
      todayHighlight: true
    }).datepicker('update', new Date());

    // Create relationship
    $(".create--relationship").click( function() {
        $("#name-relationship-noti").val('');
        $("#id_remove").remove();
        $("#phone-number-noti").val('');
        $("#form-relationship").attr("action","/relationship/create");
        $("#note_relationship-noti").val('');
        var opts_city = "";
        var address_json = JSON.parse($('#address').attr('value'));
        for (let j =0;j<address_json.length;j++) {
                opts_city += "<option value='"+ address_json[j].ID+"'>"+address_json[j].Title+"</option>";
        }
        $('#address').html(opts_city);
        $('#district').html("");
        $('#ward').html("");
        $(".create--rela").addClass('active');
    } );
    $(".btn--skip").click( function() {
      $(".create--rela").removeClass('active');
        $("#id_remove").remove();
    } );

    // Create kind of relationship

    $(".kindof--relationship").click( function() {
        $(".kindof--rela").addClass('active');
    } );
    $(".btn--skip").click( function() {
        $(".kindof--rela").removeClass('active');
        $(".create--noti").removeClass('active');
    } );

      // Show popup delete
    $(".delete--relationship").click( function() {
        $(".delete--rela").addClass('active');
    } );
    $(".btn--skip").click( function() {
        $(".delete--rela").removeClass('active');
    } );

    // Create create--notification

    $("#create--notification").click( function() {
      $(".create--noti").addClass('active');
    }) 

  });
