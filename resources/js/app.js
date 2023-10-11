//import './bootstrap';


// multiple file upload support javascript functions.. 

   //utility function which formats byte size in required unit.
function formatBytes(size, decimals = 2) {
    if (size === 0) return '0 bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(size) / Math.log(k));

    return parseFloat((size / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// call this function on fileinput element 'change' event...   
// arg1 - this (fileinput item itself)
// arg2 - fileinput id.  Make sure gallery id is mentioned as  <fileinputid>-gallery
//
// example ui
//
		// <input type="file" id="fileInput" multiple >
		// <div id="fileInput-gallery" class="gallery">

		// </div>
        // <script>
        //      document.getElementById('fileInput').addEventListener('change', function () {
		//          updateFileList(this,'fileInput-gallery');
	    //      });
        //  </script>
        // 
        // 

function toDataUrl(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}

        // toDataUrl("http://myImageUrl",function(x){
        //     base64Image = x;
        //     console.log("x :- " + x);
        // })
        
function updateFileList(fileinput,gallery_id) {
    var gallery = $('#'+gallery_id);
    gallery.empty();
    const files = fileinput.files;

    for (let i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.filename = file.name;
        
        //reader onload is called for every file read.. 
        reader.onload = function (e) {
            addImageToGallery(
                e.target.filename,
                e.target.result,
                e.total,
                gallery,
                    function () { //delete click handler
                        var index = i;
                        const dt = new DataTransfer();
                        const files = fileinput.files;
                        console.log(files.length);

                        if (index >= 0 && index < files.length) {

                            for (let i = 0; i < files.length; i++) {
                                if (i !== index) {
                                    dt.items.add(files[i]);
                                } else {
                                    console.log("ignoring file - " + i); 
                                }
                            }

                            fileinput.files = dt.files;
                            updateFileList(fileinput,gallery_id);
                        }
                    }
            );
        }

        reader.readAsDataURL(file);
    }
}

function openImage(imgSrc){
    var image = new Image();
    image.src = "data:image/jpg;base64," + imgSrc;

    var w = window.open("");
    w.document.write(image.outerHTML);
}

function addImageToGallery(imgName,imgSrc,imgSize,parentDiv, delEventHandler){
    const div = document.createElement('div');    
    div.classList.add("gallery-item")
    const divImg = document.createElement('div');
    divImg.classList.add('image');
    divImg.innerHTML = `
        <img src="${imgSrc}" alt="${imgName}" />
    `;
    // <p><b>${imgName}</b>  <i>[${formatBytes(imgSize)}]</i></p>
    div.appendChild(divImg);

    // const deleteButton = document.createElement('button');
    // deleteButton.classList.add('btn');
    // deleteButton.classList.add('btn-danger');
    // deleteButton.classList.add('btn-sm');
    // deleteButton.textContent = 'Delete';
    // deleteButton.addEventListener('click', delEventHandler);
    // div.appendChild(deleteButton);
    parentDiv.append(div);
}

function addImageHrefToGallery(imgLink,parentDivId,delEventHandler){
    const parentDiv = $("#"+parentDivId);
    const div = document.createElement('div');    
    div.classList.add("gallery-item")
    const divImg = document.createElement('div');
    divImg.classList.add('image');
    divImg.innerHTML = `
            <a href="/public/${imgLink}" target="_blank">
                <img src="/public/${imgLink}" style="max-width: 100%" />
            </a>                        
    `;
    div.appendChild(divImg);
    parentDiv.append(div);

    var i=0;
    let base64Image = "/public/"+imgLink;
    console.log("img url:"+base64Image)
    toDataUrl(base64Image,function(x){
        base64Image = x;
        console.log(x);
        var dt = new DataTransfer(); // specs compliant (as of March 2018 only Chrome)
        // dt.items.add(base64Image,new File(['myNewFile']));
        var filename = "file"+i; i=i+1;
        dt.items.add(new File([base64Image],filename));
        console.log(document.querySelector('#file_residency_card').files);
        document.querySelector('#file_residency_card').files+=dt.files;
    })
}

// ---------------------------------------------------


// gets first and last date of the month when passed month name.. 
function getFirstAndLastDateOfMonth(monthName) {
    // Define an array of month names
    const months = [
        'Jan',
        'Feb',
        'March',
        'April',
        'May',
        'June',
        'July',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
    ];
  
    // Parse the input month name and find its index in the array
    const monthIndex = months.findIndex(month => month.toLowerCase() === monthName.toLowerCase());
  
    // Check if the month name is valid
    if (monthIndex === -1) {
      return "Invalid month name";
    }
  
    // Create a new Date object for the specified month
    const firstDate = new Date(new Date().getFullYear(), monthIndex, 1);
    const lastDate = new Date(new Date().getFullYear(), monthIndex + 1, 0);
  
    // Format the dates as "mm/dd/yy"
    const formatDate = date => {
        const mm = (date.getMonth() + 1).toString().padStart(2, '0');
        const dd = date.getDate().toString().padStart(2, '0');
        const yy = date.getFullYear().toString();
        return `${yy}-${mm}-${dd}`;
    };

    return {
      firstDate: formatDate(firstDate),
      lastDate: formatDate(lastDate)
    };
  }
  
  
  