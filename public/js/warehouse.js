
document.getElementById('update-stock-form').addEventListener('submit', function (e) {
    e.preventDefault(); // chặn submit form mặc định

    Swal.fire({
        title: 'Xác nhận',
        text: "Bạn có chắc muốn cập nhật tồn kho không?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, cập nhật ngay!',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Nếu người dùng xác nhận, submit form thủ công
            e.target.submit();
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btn-edit-stock');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                const stock = this.getAttribute('data-stock');

                document.getElementById('modal_product_id').value = productId;
                document.getElementById('modal_product_name').value = productName;
                document.getElementById('modal_quantity').value = stock;
            });
        });
    });

