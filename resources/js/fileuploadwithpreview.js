class FileUploadWithPreview extends HTMLElement {

    constructor() {
        super();
        this.numFilesSelected = 0;
    }

    connectedCallback() {
        this.id = this.getAttribute('id');
        this.render();

        let fileInput = document.querySelector("file-upload-preview  #"+this.id+" input#actual-btn-"+this.id);
        fileInput.addEventListener('change', this.updateFileList.bind(this));

    }

    addImageToGallery(imgSrc, delHandler, delHandlerArgs){
        let gallery = document.querySelector("file-upload-preview  #"+this.id+" #fileinput-gallery-"+this.id);

        const div = document.createElement('div');    
        div.classList.add("gallery-item")
        const divImg = document.createElement('div');
        divImg.classList.add('image');
        divImg.innerHTML = `
            <img src="${imgSrc}"/> 
        `; //"
        // <p><b>${imgName}</b>  <i>[${formatBytes(imgSize)}]</i></p>
        div.appendChild(divImg);
        if(delHandler !== undefined) {
            const deleteButton = document.createElement('button');
            deleteButton.classList.add('btn');
            deleteButton.classList.add('btn-danger');
            deleteButton.classList.add('btn-sm');
            deleteButton.textContent = 'X';
            deleteButton.addEventListener('click', function(event){
                div.remove();
                delHandler(delHandlerArgs) ;
                event.preventDefault();
            });
            div.appendChild(deleteButton);
        }
        gallery.append(div);    
    }

    updateFileList() {
        let fileInput = document.querySelector("file-upload-preview  #"+this.id+" input#actual-btn-"+this.id);
        let files = fileInput.files;
        let self = this;

        let captionFileChosen = document.querySelector("file-upload-preview  #"+this.id+" span#file-chosen-"+this.id);
        this.numFilesSelected += fileInput.files.length;
        if(this.numFilesSelected > 0){
            captionFileChosen.textContent = this.numFilesSelected + " files selected"
        } else {
            captionFileChosen.textContent = "No file chosen";
        }

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.filename = file.name;
            
            //reader onload is called for every file read.. 
            reader.onload = function (e) {
                
                var delHandler = function(args){
                    const imageContainer = document.querySelector("file-upload-preview  #"+self.id+" #fileinput-gallery-"+self.id);
                    const images = imageContainer.querySelectorAll('.gallery-item img');
    
                    var dt = new DataTransfer();
    
                    for(var i = 0; i<images.length; i++){
                        var image = images[i];
                        const src = image.getAttribute('src');
                        const alt = image.getAttribute('alt');
                        const fileType = src.split(';')[0].split(':')[1];
    
                        dt.items.add(new File([src],"test.png",{"type":fileType}));
                        // dt.items.add(new Image([src],alt));
                    };
                    fileInput.files = dt.files;

                    self.numFilesSelected--;
                    if(self.numFilesSelected > 0){
                        captionFileChosen.textContent = self.numFilesSelected + " files selected"
                    } else {
                        captionFileChosen.textContent = "No file chosen";
                    }                        
                };
                self.addImageToGallery(
                    e.target.result,
                    delHandler,
                    null
                );
            }
    
            reader.readAsDataURL(file);
        }


    }

    render() {
        this.innerHTML = `
          <div id="`+this.id+`">
              <input type="file" id="actual-btn-`+this.id+`" class="actual-btn" multiple hidden accept=".jpg,.jpeg,.png">
            <!--our custom file upload button-->
              <label id="actual-btn-label-`+this.id+`" class="actual-btn-label" for="actual-btn-`+this.id+`">Choose File</label>
  
            <!-- name of file chosen -->
              <span id="file-chosen-`+this.id+`" class="file-chosen">No file chosen</span>
  
          <!-- preview of the files choosen -->
              <div id="fileinput-gallery-`+this.id+`" class="fileinput-gallery">
              </div>
          
          </div>
          `;
    }  
}
  
customElements.define("file-upload-preview", FileUploadWithPreview);
