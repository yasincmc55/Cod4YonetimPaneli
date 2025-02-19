<script>
$(document).ready(function () {
    //ekleme işlemi
    $(".saveButton").click(function () {
        var formData = new FormData();
        formData.append("per_name", $("#per_name").val());
        formData.append("per_key", $("#per_key").val());
        formData.append("status", $("#status").val());

        $.ajax({
            url: '<?= base_url("admin/permission-add"); ?>',
            type: "POST",
            data: formData,
            processData: false, // FormData kullanıldığı için gerekli
            contentType: false, // FormData kullanıldığı için gerekli
            success: function (response) {
                if (response.status === "success") {
                    // Modalı kapat
                    $("#addPerModal").modal("hide");

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                        width: "32em",
                    });
                    setTimeout(() => location.reload(), 2500);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "İşlem Başarısız!",
                        text: response.message,
                        confirmButtonText: "Tamam",
                    });
                }
            },
        });
    });

    //Düzenleme işlemi
    $(".editButton").click(function () {
        var perId = $(this).data("id");

        $.ajax({
            url: '<?= base_url("admin/permission-get-single"); ?>',
            type: "POST",
            data: { id: perId },
            success: function (response) {
                // Konsolda gelen veriyi görün
                console.log(response);

                if (response.status === "success") {
                    // Modal içindeki inputları doldur
                    $("#per_name_edit").val(response.data.name);
                    $("#per_key_edit").val(response.data.per_key);
                    $("#status_edit").val(response.data.status);
                    $("#per_id_edit").val(response.data.id);

                    // Modalı aç
                    $("#editPerModal").modal("show");
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: response.message,
                        confirmButtonText: "Tamam",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Hata:", error);
                Swal.fire({
                    icon: "error",
                    title: "Hata!",
                    text: "Veri alınamadı!",
                    confirmButtonText: "Tamam",
                });
            },
        });
    });

    //güncelleme işlemi
    $(".updateButton").click(function () {
        $.ajax({
            url: '<?= base_url("admin/permission-update"); ?>',
            type: "POST",
            data: {
                id: $("#per_id_edit").val(),
                per_name: $("#per_name_edit").val(),
                per_key: $("#per_key_edit").val(),
                status: $("#status_edit").val(),
            },
            success: function (response) {
                console.log("Gelen Cevap:", response);

                if (response.status === "success") {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                        width: "32em",
                    });
                    $("#editPerModal").modal("hide"); // Modalı kapat
                    setTimeout(() => location.reload(), 1500);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: response.message,
                        confirmButtonText: "Tamam",
                    });
                }
            },
        });
    });
});
//silme işlemi
function deletePermission(id) {
    Swal.fire({
        title: "Emin misiniz?",
        text: "Bu izni silmek istediğinize emin misiniz?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Evet, sil!",
        cancelButtonText: "İptal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url("admin/permission-delete"); ?>',
                type: "POST",
                data: { id: id },
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Başarılı!",
                            text: response.message,
                            confirmButtonText: "Tamam",
                        });
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Hata!",
                            text: response.message,
                            confirmButtonText: "Tamam",
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Hata:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Sunucu Hatası!",
                        text: "Bir hata oluştu, lütfen tekrar deneyin.",
                        confirmButtonText: "Tamam",
                    });
                },
            });
        }
    });
}
</script>