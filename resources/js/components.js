
//Image preview component in a modal dialog-----------------------------------------------

class ImagePreviewModal {
    constructor(_divId,_images,_options){
        //TODO
        this.parentDivId = _divId;
        this.imagesArr = _images;
        this.options = _options;

            // Create the carousel structure
        this.carouselHTML = `
                <div id="carousal-container">
                    <div id="dynamicCarousel" class="carousel slide" data-ride="carousel" data-bs-interval="false">
                        <div class="carousel-inner">
                        </div>
                        <a class="carousel-control-prev" href="#dynamicCarousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#dynamicCarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            `;

            $('#'+this.parentDivId).empty();//clear contents
            this._render();
    }

    _render() {
        // Create a new modal element
        const modal = document.createElement("div");
        modal.classList.add("modal", "fade");
        modal.setAttribute("id", "imagePreviewModal");
        // modal.style.width = "70vw";
        // modal.style.height = "50vh";

        // Modal dialog
        const modalDialog = document.createElement("div");
        modalDialog.classList.add("modal-dialog");

        // Modal header
        const modalHeader = document.createElement("div");
        modalHeader.classList.add("modal-header");
        const modalTitle = document.createElement("div");
        modalTitle.classList.add("modal-title");
        modalTitle.innerHTML = "Images";
        modalHeader.appendChild(modalTitle);

        // Close button
        const closeButton = document.createElement("button");
        closeButton.setAttribute("type", "button");
        closeButton.setAttribute("data-bs-dismiss", "modal");
        closeButton.classList.add("close");
        closeButton.innerHTML = "&times;";
        modalHeader.appendChild(closeButton);

        // Modal content
        const modalContent = document.createElement("div");
        modalContent.classList.add("modal-content");

        // Modal body
        const modalBody = document.createElement("div");
        modalBody.classList.add("modal-body");
        const carouselContainer = document.createElement("div");
        carouselContainer.innerHTML = this.carouselHTML;
        modalBody.appendChild(carouselContainer);

        modalContent.appendChild(modalHeader);
        modalContent.appendChild(modalBody);
        modalDialog.appendChild(modalContent);
        modal.appendChild(modalDialog);

        // Append the modal to the body
        $('#'+this.parentDivId).append(modal);  

        //add images to carousel
        this._addImages();

        //initiate carousel
        $("#dynamicCarousel").carousel();
    }

    show(){
        $("#imagePreviewModal").modal('show');
    }

    _addImages(){
        for(var i=0; i<(Object.keys(this.imagesArr)).length; i++){
            var caption = Object.keys(this.imagesArr)[i];
            console.log(caption);
            var images = this.imagesArr[caption];
            console.log(caption+" - "+ images.length);
            for(var j=0;j<images.length;j++){
                const imgDiv = document.createElement("div");
                imgDiv.classList.add("carousel-item");
                if(i==0 & j==0)imgDiv.classList.add("active");
                    imgDiv.innerHTML = `
                        <img class="d-block w-100" src="/public/`+images[j]+`" alt="First slide">
                        <div class="carousel-caption d-none d-md-block mt-2">
                        <b>`+caption+` - Image#`+j+`</b>
                        </div>
                    `;
                    $("#dynamicCarousel .carousel-inner").append(imgDiv);
            }
        }
    }

}

// -----------------------------


class uploadFileWithPreview {
    constructor(_divId,_images,_options){

        //init attributes...
        this.parentDivId = _divId;
        this.options = _options;

        // Create the carousel structure
        this.html = `
        
        `;

        this._render();
    }

    _render(){

    }
    
}
