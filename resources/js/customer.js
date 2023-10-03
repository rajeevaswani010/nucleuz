
function formDataToJson(formData) {
    const jsonObject = {};
    formData.forEach((value, key) => {
      jsonObject[key] = value;
    });
    return jsonObject;
}
  
function doAjax(url, reqData, onSuccess, onFailure) {
    //get images
    $.ajax({
        url: url,
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: reqData,
         // processData: false, // Prevent jQuery from processing the data
         //contentType: false, // Set the content type to false to let the server handle it
        success: function( data, textStatus, jqXHR ) {
            JsData = JSON.parse(data);
            console.log(JsData);
            if(JsData.Status == 1){
                onSuccess(JsData);
            } else {
                onFailure(JsData);
            }
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            console.error("Fail to get images. Error:"+jqXHR.status);
            onFailure({
                "Status":jqXHR.status
                ,"Message":jqXHR.statusText
            });
        }              
    });
}

function __uploadFiles(url,fileInput, appendIdAndType,onSuccess,onFailure ){
    console.log("upload file called");
    var files = fileInput.files;

    var formdata = new FormData();
    appendIdAndType(formdata); //append custoemr id and filetype
    for (var i = 0; i < files.length; i++) {
        formdata.append('files[]', files[i]);
    }

    $.ajax({
        url: url,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formdata,
        contentType: false,
        cache: false,
        processData:false,
        success: function( data, textStatus, jqXHR ) {
            JsData = JSON.parse(data);
            console.log(JsData);
            if(JsData.Status == 1){
                onSuccess(JsData);
            } else {
                onFailure(JsData);
            }
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            console.error("Fail to get images. Error:"+jqXHR.status);
            onFailure({
                "Status":jqXHR.status
                ,"Message":jqXHR.statusText
            });
        }              
    });
}


// function updateCustomer