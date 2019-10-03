let img = [];
let modulImg = [];

let handleOpenModal = (event) => {
    if (event.target.classList[0] === "gallery_img") {
        for (let i = 0; i < img.length; i++) {
            $img = document.createElement("img");
            $img.src = img[i];
            $img.classList.add("img");
            if (img[i] === event.target.getAttribute("src")) {
                let $preview = document.getElementById("preview");
                $preview.appendChild($img.cloneNode(true));
                $img.classList.add("active");
            }
            modulImg.push($img);
        }
        let $modal = document.getElementById("modal");
        $modal.style.display = "block";
        let $thumbnails = document.getElementById("thumbnails");
        for (let i = 0; i < modulImg.length; i++) {
            let $li = document.createElement("li");
            $li.appendChild(modulImg[i]);
            $thumbnails.appendChild($li);
        }
    }
};
let handleCloseModal = (event) => {
    let $modal = document.getElementById("modal");
    if ($modal.getAttribute("style") === "display: block;") {
        if (event.target === $modal) {
            $modal.style.display = "none";
            // Очищаем html структуру модального окна
            let $preview = document.getElementById("preview");
            $preview.removeChild($preview.children[0]);
            let $thumbnails = document.getElementById("thumbnails");
            let $thumbnailsArr = $thumbnails.children;
            for (let i = modulImg.length - 1; i >= 0; i--) {
                $thumbnails.removeChild($thumbnails.children[0]);
            }
            // Очищаем массив
            modulImg.length = 0;
        }
    }
}

let handleThumbnailsClickMouse = (event) => {
    let $onActive = event.target;
    if ($onActive.classList[0] === "img") {
        if ($onActive.classList.contains("active")) {
            return;
        }
        $offActive = document.getElementsByClassName("active");
        $offActive[0].classList.remove("active");
        $onActive.classList.add("active");
        let $preview = document.getElementById("preview");
        let tempImg = $onActive.getAttribute("src");
        $preview.children[0].setAttribute("src" , tempImg);

    }
}

let handleThumbnailsClickKeybord = (event) => {
    let $modal = document.getElementById("modal");
    if ($modal.style.display === "block") {
        let $preview = document.getElementById("preview");
        $offActive = document.getElementsByClassName("active");
        let indexActivElement = modulImg.indexOf($offActive[0]);
        let tempImg;
        switch (event.code) {
            case "ArrowRight":
                if (modulImg[indexActivElement + 1] === undefined) {
                    modulImg[0].classList.add("active");
                    let tempImg = modulImg[0].getAttribute("src");
                    $preview.children[0].setAttribute("src" , tempImg);
                    break;
                }
                modulImg[indexActivElement + 1].classList.add("active");
                tempImg = modulImg[indexActivElement + 1].getAttribute("src");
                $preview.children[0].setAttribute("src" , tempImg);
                break;
            case "ArrowLeft":
                if (modulImg[indexActivElement - 1] === undefined) {
                    modulImg[modulImg.length - 1].classList.add("active");
                    let tempImg = modulImg[modulImg.length - 1].getAttribute("src");
                    $preview.children[0].setAttribute("src" , tempImg);
                    break;
                }
                modulImg[indexActivElement - 1].classList.add("active");
                tempImg = modulImg[indexActivElement - 1].getAttribute("src");
                $preview.children[0].setAttribute("src" , tempImg);
                break;
        }
        modulImg[indexActivElement].classList.remove("active");
    }
}



let init = () => {
    // Получим ссылки на картинки с DOM
    let $modalArr = document.getElementsByClassName("gallery_img");
    for (let i = 0; i < $modalArr.length; i++) {
        img.push($modalArr[i].getAttribute("src"));
    }
    let $boxModal = document.getElementById("gallery");
    $boxModal.addEventListener("click", handleOpenModal);
    window.addEventListener("click", handleCloseModal);
    let $thumbnailsClick = document.getElementById("thumbnails");
    $thumbnailsClick.addEventListener("click", handleThumbnailsClickMouse);
    window.addEventListener("keydown", handleThumbnailsClickKeybord);
};
window.addEventListener('load', init);