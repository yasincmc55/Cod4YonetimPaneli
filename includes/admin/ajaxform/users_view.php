<script>
    $(document).ready(function () {
        //Kayıt işlemi
        $('.saveButton').click(function () {
            var formData = new FormData();
            formData.append('username', $('#username').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('user_group', $('#user_group').val());
            formData.append('status', $('#status').val());

            $.ajax({
                url: '<?= base_url("admin/user-add"); ?>',
                type: 'POST',
                data: formData,
                processData: false, // FormData kullanıldığı için gerekli
                contentType: false, // FormData kullanıldığı için gerekli
                success: function (response) {
                    console.log(response);

                    // Modalı kapat
                    $('#addRoomModal').modal('hide');

                    // Başarı mesajı göster
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: response.message,
                        confirmButtonText: 'Tamam'
                    });

                    // Sayfayı yenile
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
                error: function (xhr, status, error) {
                    console.error("Hata:", error);

                    // Hata mesajı göster
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata!',
                        text: response.message,
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        });

        //Düzenleme işlemi
        $(".editButton").click(function () {
            var userId = $(this).data("id");
            $.ajax({
                url: '<?= base_url("admin/user-get-single"); ?>',
                type: "POST",
                data: {id: userId},
                success: function (response) {
                    // Konsolda gelen veriyi görün
                    console.log(response);

                    if (response.status === "success") {
                        // Modal içindeki inputları doldur
                        $("#username_edit").val(response.data.username);
                        $("#email_edit").val(response.data.email);
                        $("#user_group_edit").val(response.data.user_group_id);
                        $("#status_edit").val(response.data.status);
                        $("#user_id_edit").val(response.data.id);

                        // Modalı aç
                        $("#editUserModal").modal("show");
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

        //Güncelleme işlemi
        $(".updateButton").click(function () {
            $.ajax({
                url: '<?= base_url("admin/user-update"); ?>',
                type: "POST",
                data: {
                    id: $("#user_id_edit").val(),
                    username: $("#username_edit").val(),
                    email: $("#email_edit").val(),
                    role: $("#user_group_edit").val(),
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
    function deleteUser(id) {
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
                    url: '<?= base_url("admin/user-delete"); ?>',
                    type: "POST",
                    data: {id: id},
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