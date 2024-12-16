document.addEventListener("DOMContentLoaded", function () { // Giúp đồng bộ thống nhất với HTML
    let checkout = document.getElementById("CHECKOUT");
    checkout.addEventListener("click", function () {
        let total = document.getElementById("total");
        let fullName = document.getElementById("fullname");
        let email = document.getElementById("email");
        let address = document.getElementById("address");
        let numberphone = document.getElementById("numberphone");
        let note = document.getElementById("note");
        let isValid = true;
        
        if((total.value).trim() <= 0){
            isValid = false;
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Lỗi tiền tiền tiền tiền tiền',})
        }
        if((fullName.value).trim() == ""){
            isValid = false;
            fullName.style.borderColor = "red";
        }else{
            fullName.style.borderColor = "gray";
        }
        if((email.value).trim() == ""){
            isValid = false;
            email.style.borderColor = "red";
        }else{
            email.style.borderColor = "gray";
        }
        if((address.value).trim() == ""){
            isValid = false;
            address.style.borderColor = "red";
        }else{
            address.style.borderColor = "gray";
        }
        if((numberphone.value).trim() == ""){
            isValid = false;
        }else{
            numberphone.style.borderColor = "gray";
        }
        if(!isValid){
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Chưa nhập đầy đủ thông tin!',});
        }else{
            var xhr = new XMLHttpRequest();
            xhr.open(
                "POST",
                "./handles/checkout.php",
                true
            );
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = ()=>{
                if(xhr.readyState === 4 && xhr.status === 200){
                    let result = xhr.responseText;
                    if(result == "Thành công"){
                        Swal.fire({icon: 'success',title: 'Đặt hàng thành công',text: 'Cảm ơn đã tin tưởng chúng tôi', allowOutsideClick: false,}).then((result) => { if (result.isConfirmed) {window.location.href = '?page=profile';}});
                    }else if(result === "Bạn chưa đăng nhập"){
                        Swal.fire({icon: 'error',title: 'Oops...',text: 'Bạn chưa đăng nhập!',allowOutsideClick: false,}).then((result) => { if (result.isConfirmed) {window.location.href = './auth/?auth=login';}});
                    }else if(result === "Email không hợp lệ"){
                        Swal.fire({icon: 'error',title: 'Oops...',text: 'Email không hợp lệ ???',});
                    }else{
                        Swal.fire({icon: 'error',title: 'Oops...',text: result,});
                    }
                }
            }
            xhr.send("fullname=" + fullName.value +
                    "&email=" + email.value +
                    "&numberphone=" + numberphone.value +
                    "&address=" + address.value +
                    "&note=" + note.value +
                    "&total=" + total.value)
        }
    });
});