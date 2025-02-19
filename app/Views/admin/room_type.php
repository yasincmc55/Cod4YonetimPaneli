<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>ODA TİPİ YÖNETİMİ</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
                  <li class="breadcrumb-item active">Oda Tipleri</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>

   <!-- Oda Tipi Ekle Modal -->
   <div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="addRoomTypeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="addRoomTypeModalLabel">Oda Tipi Ekle</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <!-- Dil Sekmeleri -->
               <ul class="nav nav-tabs" id="languageTab" role="tablist">
                  <?php foreach ($languages as $index => $language): ?>
                  <li class="nav-item">
                     <a class="nav-link <?= $index === 0 ? 'active' : '' ?>"
                        id="tab-<?=$language['code']?>"
                        data-toggle="tab"
                        href="#<?=$language['code']?>"
                        role="tab">
                     <?= $language['name'] ?>
                     </a>
                  </li>
                  <?php endforeach; ?>
               </ul>
               <!-- Form Sekme İçeriği -->
               <div class="tab-content">
                  <?php foreach ($languages as $index => $language): ?>
                  <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>"
                     id="<?= $language['code'] ?>"
                     role="tabpanel">
                     <form class="language-form">
                        <input type="hidden" name="language_code[]" value="<?= $language['code'] ?>">
                        <div class="form-group">
                           <label for="type_name_<?= $language['code'] ?>">Oda Tipi Adı (<?=  $language['name'] ?>)</label>
                           <input type="text" class="form-control" name="type_name[]" 
                              id="type_name_<?= $language['code'] ?>" 
                              placeholder="Oda Tipi Adı">
                        </div>
                        <div class="form-group">
                           <label for="description_<?= $language['code'] ?>">Açıklama (<?= $language['name'] ?>)</label>
                           <textarea class="form-control" name="description[]" 
                              id="description_<?= $language['code'] ?>" 
                              rows="3" placeholder="Açıklama"></textarea>
                        </div>
                     </form>
                  </div>
                  <?php endforeach; ?>
               </div>
               <!-- Ortak Alanlar -->
               <div class="form-group mt-3">
                  <label for="max_occupancy">Kişi Kapasitesi (En Fazla)</label>
                  <input type="number" class="form-control" id="max_occupancy" name="max_occupancy" placeholder="Kişi Kapasitesi">
               </div>
               <div class="form-group">
                  <label for="per_night_price">Gecelik Fiyat</label>
                  <input type="number" class="form-control" id="per_night_price" name="per_night_price" placeholder="Gecelik Fiyat">
               </div>
               <div class="form-group">
                  <label for="status">Durum</label>
                  <select class="form-control" id="status" name="status">
                     <option value="1">Aktif</option>
                     <option value="0">Pasif</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
               <button type="button" class="btn btn-primary" id="saveRoomTypeBtn">Kaydet</button>
            </div>
         </div>
      </div>
   </div>
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">ODA TİPLERİ</h3>
                     <div class="card-tools d-flex">
                        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addRoomTypeModal">Oda Tipi Ekle</button> <!-- Oda Tipi Ekle butonu -->
                        <div class="input-group input-group-sm" style="width: 150px;">
                           <input type="text" name="table_search" class="form-control float-right" placeholder="Ara">
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
                              <th>ID</th>
                              <th>Oda Tipi Adı</th>
                              <th>Açıklama</th>
                              <th>Durum</th>
                              <th>İşlemler</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($room_types as $rm): ?>
                           <tr>
                              <td><?= $rm->id ?></td>
                              <td><?= translate('room_type_title','tr') ?></td>
                              <td><?= translate('room_type_description','tr') ?></td>
                               <td> <?= $rm->status == 1 ? "Aktif" : "Pasif" ?> </td>
                               <td>
                                 <!-- Düzenle ve Sil butonları eklenebilir -->
                                 <button class="duzenle btn btn-sm btn-warning" data-id="<?= $rm->id ?>" >Düzenle</button>
                                 <button class="btn btn-sm btn-danger">Sil</button>
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
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
   <!-- Oda Tipi Düzenle Modal -->
   <div class="modal fade" id="editRoomTypeModal" tabindex="-1" aria-labelledby="editRoomTypeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="editRoomTypeModalLabel">Oda Tipi Düzenle</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form id="editRoomTypeForm">
                  <div class="form-group">
                     <label for="type_name">Oda Tipi Adı</label>
                     <input type="text" class="form-control" id="type_name" placeholder="Oda Tipi Adı">
                  </div>
                  <div class="form-group">
                     <label for="maxoccupancy">Kişi Kapasitesi(en fazla)</label>
                     <input class="form-control" id="max_occupancy" rows="3" placeholder="Kişi Kapasitesi"></input>
                  </div>
                  <div class="form-group">
                     <label for="perNightPrice">Gecelik Fiyat</label>
                     <input type="number" class="form-control" id="per_night_price" rows="3" placeholder="Gecelik Fiyat"></input>
                  </div>
                  <div class="form-group">
                     <label for="description">Açıklama</label>
                     <textarea class="form-control" id="description" rows="3" placeholder="Açıklama"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="status">Durum</label>
                     <select class="form-control" id="status">
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                     </select>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
               <button type="button" class="btn btn-primary" id="saveRoomTypeBtn">Kaydet</button>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    $(document).ready(function() {
        // Kaydet butonuna tıklandığında
        $('#saveRoomTypeBtn').on('click', function() {
            // Ortak alan verilerini toplama
            let data = {
                max_occupancy: $('#max_occupancy').val(),
                per_night_price: $('#per_night_price').val(),
                status: $('#status').val(),
                translations: []
            };

            // Her dil sekmesi içindeki verileri topla
            $('.language-form').each(function() {
                const languageCode = $(this).find('input[name="language_code[]"]').val();
                const typeName = $(this).find('input[name="type_name[]"]').val();
                const description = $(this).find('textarea[name="description[]"]').val();

                data.translations.push(
                    { key: 'room_type_title', value: typeName, language_code: languageCode },
                    { key: 'room_type_description', value: description, language_code: languageCode }
                );
            });

            // AJAX ile veri gönder
            $.ajax({
                url: '<?= base_url("/api/add/save_room_type"); ?>',
                type: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    $('#addRoomTypeModal').modal('hide');
                    showToast('Oda tipi başarıyla kaydedildi.');
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Hatası:", status, error);
                    showToast('Bir hata oluştu. Lütfen tekrar deneyin.', 'error');
                }
            });
        });
    });
</script>