document.addEventListener("DOMContentLoaded", ()=>{
    let deletebuttons = document.querySelectorAll(".delete-cart");
    deletebuttons.forEach(delete_button => {
        delete_button.addEventListener("click", () => {
            let productId = delete_button.querySelector(".productId").value;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "./handles/delete-cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = () => {
                if (xhr.status === 200 && xhr.readyState === 4) {
                    let parentCartItem = delete_button.closest(".aCartItem");
                    if (parentCartItem) {
                        parentCartItem.remove();
                    }
                }
            };
            xhr.send("productId=" + productId);
        });
    });
});
