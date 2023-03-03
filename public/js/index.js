


const coverImage = document.querySelector('.cover-image');
const smallImages = document.querySelectorAll('.small-image');
const smallImagesBoxes = document.querySelectorAll('.small-images-column');

smallImages.forEach(
    smallImage => {
        smallImage.addEventListener(
            'click',
            () => {
                coverImage.src = smallImage.src;
            }
        );
    }
);

let selected = null;

smallImagesBoxes.forEach(
    smallImagesBox => {
        smallImagesBox.style.borderColor = '';
        smallImagesBox.addEventListener(
            'click',
            () => {
                if (selected !== null) {
                    selected.style.borderColor = '';
                }
                smallImagesBox.style.borderColor = "#bb5555";
                selected = smallImagesBox;
            }
        )   
    }
)


