// Xác nhận xóa
function confirmDelete(url) {
  Swal.fire({
    title: "Bạn chắc chắn chứ?",
    text: "Bạn sẽ không thể hoàn tác hành động này!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Có, xóa nó đi!",
    cancelButtonText: "Không, hủy bỏ!",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = url;
    } else {
      isValid = false;
    }
  });
  return false;
}

// Xác nhận hành động
function confirmAction(url) {
  Swal.fire({
    title: "Bạn chắc chắn chứ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Có, tiếp tục!",
    cancelButtonText: "Không, hủy bỏ!",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = url;
    } else {
      isValid = false;
    }
  });
  return false;
}
