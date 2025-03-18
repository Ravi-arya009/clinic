function ImagePreview(uploadSelector, previewSelector) {
    const uploadInput = document.querySelector(uploadSelector);
    const previewContainer = document.querySelector(previewSelector);

    if (!uploadInput || !previewContainer) return;

    uploadInput.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (event) => {
            const imageData = event.target.result;
            const image = document.createElement("img");
            image.src = imageData;
            image.style.width = "100%";
            image.style.height = "100%";
            image.style.objectFit = "cover";
            previewContainer.innerHTML = "";
            previewContainer.appendChild(image);
        };
        reader.readAsDataURL(file);
    });
}
