$(document).ready(function() {
    $('#notification-btn').click(function(){
        $('#notification-panel').toggle();
    });

    // for(var i = 1; i<10; i++){
    //     var newDiv = $("<div>");

    //     // Add content or attributes to the new <div> if needed
    //     newDiv.addClass("notification card");

    //     var heading = $("<div>");
    //     heading.addClass("heading");
    //     heading.html("<h5>heading</h5>");

    //     var content = $("<div>");
    //     content.text("This is a new div - " + i);

    //     var action = $("<div>");

    //     newDiv.append(heading,content,action);

    
    //     // Append the new <div> to the existing <div> with id "container"
    //     $("#notification-panel").append(newDiv);    
    // }

    $.ajax({
        url: "/GetNotifications",
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Set the content type to false to let the server handle it
        success: function( data, textStatus, jqXHR ) {
            JsData = JSON.parse(data);
            console.log(JsData);
            if(JsData.Status == 1){
                JsData.Data.forEach(function(element){
                    var notif = $("<div>");
                    notif.addClass("notification card");

                    // Add content or attributes to the new <div> if needed
                    var heading = $("<div>");
                    heading.addClass("heading");
                    heading.html("<h5>"+element.title+"</h5>");

                    var content = $("<div>");
                    content.text(element.desp);

                    var action = $("<div>");
                    notif.append(heading,content,action);
                
                    // Append the new <div> to the existing <div> with id "container"
                    $("#notification-panel").append(notif);    

                });
            } else {
                hideloading();
                alert(JsData.Message);
            }
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            console.error("Fail to get images. Error:"+jqXHR.status);
            hideloading();
            toastr["error"](jqXHR.statusText);
        }              
    });

});