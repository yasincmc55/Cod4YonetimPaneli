<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>KULLANICI GURUBU DÜZENLE</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item active">Kullanıcı Gurubu İşlemleri</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">KULLANICI GURUPLARI</h3>

                            <div class="card-tools d-flex">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                        data-target="#addGroupModal">Kullanıcı Gurubu Ekle
                                </button>
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                           placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Sıra</th>
                                    <th>Gurup Adı</th>
                                    <th>Durum</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                foreach ($ugroups as $ug): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $ug['name'] ?></td>
                                        <td><?=$ug['status'] == 1 ? 'Aktif' : 'Pasif'?></td>
                                        <td>
                                            <!-- Edit button triggers a modal -->
                                            <button type="button" class="editButton btn btn-info btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#editUserModal" data-id="<?= $ug['id'] ?>">
                                                <i class="fas fa-edit"></i> Düzenle
                                            </button>
                                            <!-- Delete button sends a delete request -->
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="deleteUser(<?= $ug['id'] ?>)">
                                                <i class="fas fa-trash"></i> Sil
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Oda Ekle Modal Start -->
    <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModalLabel">Kullanıcı Gurubu Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="usergroupname">Kullanıcı Gurup Adı</label>
                        <input type="text" class="form-control" id="user_group_name" placeholder="Kullanıcı Gurup Adı" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Durum</label>
                        <select class="form-control" id="status" required>
                            <option value="1">Aktif</option>
                            <option value="0">Pasif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="saveButton btn btn-primary">Kaydet</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Oda Ekle Modal End -->

    <!-- Kullanıcı Düzenle Modal Start -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">Gurup Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_group_name">Kullanınıcı Gurup Adı</label>
                        <input type="text" class="form-control" id="user_group_edit" placeholder="Kullanıcı Gurup Adı" required>
                    </div>
                    <input type="hidden" id="user_group_id_edit">

                    <div class="form-group">
                        <label for="status">Durum</label>
                        <select class="form-control" id="status_edit" required>
                            <option value="1">Aktif</option>
                            <option value="0">Pasif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="updateButton btn btn-primary">Kaydet</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Kullanıcı Düzenle Modal End -->
</div>

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
