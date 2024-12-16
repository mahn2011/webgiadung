let imageMain = document.getElementById("imageMain");
let quantitySubImage = document.getElementById("quantitySubImage").value;
for(let i = 0; i < quantitySubImage; i++) {
    function nextImage(i){
        imageMain.src = document.getElementById("nextImageMore"+i).src;
    }
}
