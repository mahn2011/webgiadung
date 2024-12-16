document.addEventListener("DOMContentLoaded", ()=>{
    let comment = document.getElementById("comment");
    comment.addEventListener("click", ()=>{
        let content_comment = document.getElementById("content-comment").value;
        let productId = document.getElementById("productId");
        // Hiển thị biểu tượng "Loading" trước khi gửi yêu cầu Ajax
        if(content_comment.trim() !== "" && productId.value !== ""){
            let loadingElement = document.getElementById("loading");
            loadingElement.style.display = "block";
            let xhr = new XMLHttpRequest();
            xhr.open(
                "POST",
                "./handles/comment-action.php",
                true
            );
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = () =>{
                document.getElementById("new-comment").innerHTML = xhr.responseText;
                loadingElement.style.display = "none";
                Swal.fire({icon: 'success',title: 'Thành công',text: 'Cảm ơn bạn đã đánh giá',});
                document.getElementById("content-comment").value = "";
                // if(xhr.status === 4 && xhr.readyState === 200){
                //     let result = xhr.responseText;
                //     if(result !== ""){
                //     }else{
                //         Swal.fire({icon: 'error',title: 'Oops...',text: 'Something went wrong!',});
                //     }
                // }
            }
            xhr.send("content=" + content_comment + "&productId=" + productId.value);
        }else{
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Xảy ra lỗi!',});
        }
    });
});