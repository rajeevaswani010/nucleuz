class ProfileImageWithPreviewEdit extends HTMLElement {

    constructor() {
      super();
    }

    addImageToPreview(imgSrc){
        let imagePreview = document.querySelector("profile-image-preview  #"+this.id+" #image-preview-"+this.id);

        const div = document.createElement('div');    
        const divImg = document.createElement('div');
        divImg.classList.add('image');
        divImg.innerHTML = `
            <img src="${imgSrc}"/> 
        `; //"
        // <p><b>${imgName}</b>  <i>[${formatBytes(imgSize)}]</i></p>
        div.appendChild(divImg);
        imagePreview.innerHTML='';
        imagePreview.append(div);    
    }

    updateImage() {
        let fileInput = document.querySelector("profile-image-preview  #"+this.id+" input#actual-btn-"+this.id);
        let file = fileInput.files[0];
        let self = this;

        var reader = new FileReader();
        reader.filename = file.name;
            
        //reader onload is called for every file read.. 
        reader.onload = function (e) {
            
            //update image.. 

            //update image preview..
            self.addImageToPreview(
                e.target.result
            );
        }
        reader.readAsDataURL(file);
    }

    addInputChangeEventListener(lstnr){
        let fileInput = document.querySelector("profile-image-preview  #"+this.id+" input#actual-btn-"+this.id);
        fileInput.addEventListener('change', lstnr);
    }
    
    connectedCallback() {
        this.id = this.getAttribute('id');
        this.src = this.getAttribute('src');
        this.uploadImage = this.getAttribute("uploadFn");
        this.render();

        let fileInput = document.querySelector("profile-image-preview  #"+this.id+" input#actual-btn-"+this.id);
        fileInput.addEventListener('change', this.updateImage.bind(this));

        if(this.src !== undefined) {
            this.addImageToPreview(
                this.src
            );
        }
    }

    render() {
      this.innerHTML = `
        <div id="`+this.id+`" class="profileimage">
            <input type="file" id="actual-btn-`+this.id+`" class="actual-btn" hidden accept=".jpg,.jpeg,.png">
        <!--our custom file upload button-->
            <label id="actual-btn-label-`+this.id+`" for="actual-btn-`+this.id+`" class="actual-btn-label">Edit</label>

        <!-- preview of the image choosen -->
		    <div id="image-preview-`+this.id+`" class="circular--portrait image-preview">
                <p>No Image Selected</p>
            </div>
        
        </div>
        `;
    }

}
  
customElements.define("profile-image-preview", ProfileImageWithPreviewEdit);