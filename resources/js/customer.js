
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

//get customer images.. args:{"customer_id":CustomerId}
function getImages(CustomerId){
    var args = {"customer_id": CustomerId};
    
    doAjax (
        "{{ URL('getCustomerImages') }}"
        ,args
        ,(JsData) => {
            var data = JsData.Data;
            for (var key in data) {
                for (var i = 0; i < data[key].length; i++) {
                    var delHandlerArgs = {"id":data[key][i].id, "customer_id":CustomerId};
                    addImageUrlToGallery(data[key][i], "file_"+key, deleteFile, delHandlerArgs);
                }
            }
        }
        ,(JsData) => {
            alert("Fail to get images.Error:"+JsData.Status+" - "+JsData.Message);
        }
    );
}

//delete customer file.. 
function deleteFile(args){
    var formdata = new FormData();
    formdata.append('customer_id', args.customer_id);
    formdata.append('image_id',args.id);

    //
    doAjax (
        "{{ URL('Customer/deleteFile') }}"
        ,formDataToJson(formdata)
        ,(JsData) => {
            toastr["success"]("file deleted successfully")
        }
        ,(JsData) => {
            toastr["error"](JsData.Message);
        }
    );
}


// function updateCustomer