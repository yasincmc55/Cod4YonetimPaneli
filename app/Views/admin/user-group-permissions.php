<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kullanıcı Yetkileri Yönetimi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Yetki Yönetimi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Yetkileri Atama</h3>
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('admin/user-save-permissions') ?>">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Yetki</th>
                            <?php foreach ($groups as $group): ?>
                                <th><?= esc($group['name']) ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($permissions as $permission): ?>
                            <tr>
                                <td><?= esc($permission['name']) ?></td>
                                <?php foreach ($groups as $group): ?>
                                    <td>
                                        <input type="checkbox"
                                               class="form-check"
                                               name="permissions[<?= $group['id'] ?>][]"
                                               value="<?= $permission['id'] ?>"
                                            <?= isset($groupPermissions[$group['id']]) && in_array($permission['id'], $groupPermissions[$group['id']]) ? 'checked' : '' ?>>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mt-3">Kaydet</button>
                </form>
            </div>
        </div>
    </section>
</div>


<script>
    <?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "<?= session()->getFlashdata('success') ?>",
        showConfirmButton: false,
        timer: 2000,
        width:'32em'
    });
    <?php endif; ?>
</script>
