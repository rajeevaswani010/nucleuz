

// function formatBytes(size, decimals = 2) {
//     if (size === 0) return '0 bytes';
//     const k = 1024;
//     const dm = decimals < 0 ? 0 : decimals;
//     const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

//     const i = Math.floor(Math.log(size) / Math.log(k));

//     return parseFloat((size / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
// }

// function uploadFiles(fileInput){
//         var selectedFiles = fileInput.files;
//         console.log(selectedFiles);
//         var formdata = new FormData();
//         formdata.append('customer_id', CustomerId);
//         formdata.append('type',"driving_license");
//         for (var i = 0; i < fileInput.files.length; i++) {
//             formdata.append('files[]', fileInput.files[i]);
//         }
//         console.log(formdata);
//         $.ajax({
//             url: "{{ URL('Customer/uploadFiles') }}",
//             type: "POST",
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             data: formdata,
//             contentType: false,
//             cache: false,
//             processData:false,
//             success: function( data, textStatus, jqXHR ) {
//                 JsData = JSON.parse(data);
//                 console.log(JsData);
//                 if(JsData.Status == 0){
//                     toastr["error"](JsData.Message);
//                 }else{
//                     toastr["success"]("file uploaded successfully")
//                 }
//             },
//             error: function( jqXHR, textStatus, errorThrown ) {
//             //error handle herer TODO
//                 toastr["error"]("Internal Error");
//             }
//         });
//         e.preventDefault();
// }

function showFileSelection(fileinput,parentId) {
    $('#'+parentId+' .gallery').empty();
    // gallery.empty();
    const files = fileinput.files;

    for (let i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.filename = file.name;
        
        //reader onload is called for every file read.. 
        reader.onload = function (e) {
            addImageToGallery(
                e.target.result,
                parentId,
                null,
                null
            );
        }

        reader.readAsDataURL(file);
    }
}


function updateFileList(fileinput,parentId) {
    const files = fileinput.files;

    for (let i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.filename = file.name;
        
        //reader onload is called for every file read.. 
        reader.onload = function (e) {
            var delHandler = function(args,index){

                const imageContainer = document.querySelector('#'+parentId+' .gallery');
                const images = imageContainer.querySelectorAll('.gallery-item img');

                var dt = new DataTransfer();

                for(var i = 0; i<images.length; i++){
                // images.forEach(function (image, index, images) {
                    var image = images[i];
                    // Access the image source and alt text
                    const src = image.getAttribute('src');
                    const alt = image.getAttribute('alt');

                    const fileType = src.split(';')[0].split(':')[1];

                    // Perform actions with the image data (example: log to console)
                    console.log(`Image ${i + 1}:`);
                    console.log(`Source: ${src}`);
                    console.log(`Alt Text: ${alt}`);
                    console.log('---');

                    dt.items.add(new File([src],"test.png",{"type":fileType}));
                    // dt.items.add(new Image([src],alt));
                };
                fileinput.files = dt.files;
            };
            addImageToGallery(
                e.target.result,
                parentId,
                i,
                delHandler,
                null
            );
        }

        reader.readAsDataURL(file);
    }
}

function addImageToGallery(imgSrc,parentDivId,delHandler, delHandlerArgs){
    const gallery = $("#"+parentDivId+" .gallery");
    const div = document.createElement('div');    
    div.classList.add("gallery-item")
    const divImg = document.createElement('div');
    divImg.classList.add('image');
    divImg.innerHTML = `
        <img src="${imgSrc}"/> 
    `; //"
    // <p><b>${imgName}</b>  <i>[${formatBytes(imgSize)}]</i></p>
    div.appendChild(divImg);


    if(delHandler) {
        const deleteButton = document.createElement('button');
        deleteButton.classList.add('btn');
        deleteButton.classList.add('btn-danger');
        deleteButton.classList.add('btn-sm');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', function(event){
            div.remove();
            delHandler(delHandlerArgs) ;
            event.preventDefault();
        });
        div.appendChild(deleteButton);
    }
    gallery.append(div);
}


function addImageUrlToGallery(image,parentDivId, delHandler, delHandlerArgs){
    var xhr = new XMLHttpRequest();
    var imageUrl = image.link;
    console.log(imageUrl)
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            addImageToGallery(reader.result,parentDivId, delHandler, delHandlerArgs);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', "/public/"+imageUrl);
    xhr.responseType = 'blob';
    xhr.send();
}