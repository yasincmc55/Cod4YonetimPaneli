<script>
    $(document).ready(function () {
        //Kayıt işlemi
        $('.saveButton').click(function () {
            var formData = new FormData();
            formData.append('group_name', $('#user_group_name').val());
            formData.append('status', $('#status').val());

            $.ajax({
                url: '<?= base_url("admin/user-group-add"); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#addGroupModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: response.message,
                        confirmButtonText: 'Tamam'
                    });

                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata!',
                        text: 'Grup eklenemedi!',
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        });


        //Düzenleme işlemi
        $(".editButton").click(function () {
            var groupId = $(this).data("id");
            $.ajax({
                url: '<?= base_url("admin/group-get-single"); ?>',
                type: "POST",
                data: {id: groupId},
                success: function (response) {
                    if (response.status === "success") {
                        $("#user_group_edit").val(response.data.name);
                        $("#status_edit").val(response.data.status);
                        $("#user_group_id_edit").val(response.data.id);

                        $("#editGroupModal").modal("show");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Hata!",
                            text: response.message,
                            confirmButtonText: "Tamam",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: "Veri alınamadı!",
                        confirmButtonText: "Tamam",
                    });
                }
            });
        });


        //Güncelleme işlemi
        $(".updateButton").click(function () {
            $.ajax({
                url: '<?= base_url("admin/group-update"); ?>',
                type: "POST",
                data: {
                    id: $("#user_group_id_edit").val(),
                    name: $("#user_group_edit").val(),
                    status: $("#status_edit").val(),
                },
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Başarılı!",
                            text: response.message,
                            confirmButtonText: "Tamam",
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Hata!",
                            text: response.message,
                            confirmButtonText: "Tamam",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: "Güncelleme başarısız!",
                        confirmButtonText: "Tamam",
                    });
                }
            });
        });

    });

    //silme işlemi
    function deleteUser(id) {
        Swal.fire({
            title: "Emin misiniz?",
            text: "Bu veriyi silmek istediniğinizden emin misiniz?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Evet, sil!",
            cancelButtonText: "İptal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("admin/user-group-delete"); ?>',
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