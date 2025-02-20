<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>YETKİ DÜZENLEME</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                        <li class="breadcrumb-item active">Yetki Düzenleme</li>
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
                            <h3 class="card-title">YETKİLER</h3>

                            <div class="card-tools d-flex align-items-center">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                        data-target="#addPerModal">Yetki Ekle</button>
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Sıra</th>
                                    <th>Yetki Adı</th>
                                    <th>Yetki Anahtar</th>
                                    <th>Durum</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($permissions as $per): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?=$per['name'] ?></td>
                                        <td><?=$per['per_key']?></td>
                                        <td><?=$per['status'] == 1 ? 'Aktif' : 'Pasif' ?></td>
                                        <td>
                                            <!-- Edit button triggers a modal -->
                                            <button type="button" class="btn btn-info btn-sm editButton"
                                                    data-toggle="modal"
                                                    data-target="#editPerModal"
                                                    data-id="<?= $per['id'] ?>">
                                                <i class="fas fa-edit"></i> Düzenle
                                            </button>

                                            <!-- Delete button sends a delete request -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deletePermission(<?= $per['id'] ?>)">
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

    <!-- Yetki Ekle Modal Start -->
    <div class="modal fade" id="addPerModal" tabindex="-1" aria-labelledby="addPerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPerModalLabel">Yetki Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Yetki Adı</label>
                        <input type="text" class="form-control" id="per_name" placeholder="Yetki Adı" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Anahtar Adı</label>
                        <input type="text" class="form-control" id="per_key" placeholder="Anahtar Adı" required>
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
    <!-- Yetki Ekle Modal End -->


    <!-- Yetki Düzenle Modal Start -->
    <div class="modal fade" id="editPerModal" tabindex="-1" aria-labelledby="editPerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPerModalLabel">Yetki Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Yetki Adı</label>
                        <input type="text" class="form-control" id="per_name_edit" placeholder="Yetki Adı" required>
                    </div>
                    <input type="hidden" id="per_id_edit">
                    <div class="form-group">
                        <label for="username">Anahtar Adı</label>
                        <input type="text" class="form-control" id="per_key_edit" placeholder="Anahtar Adı" required>
                    </div>

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
    <!-- Yetki Düzenle Modal End -->
</div>

<?php include 'includes/admin/ajaxform/permissions_view.php' ?>




