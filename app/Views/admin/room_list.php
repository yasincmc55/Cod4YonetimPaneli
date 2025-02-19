
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ODA YÖNTEMİ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
              <li class="breadcrumb-item active">Oda Yönetimi</li>
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
            <h3 class="card-title">ODALAR</h3>

            <div class="card-tools d-flex">
            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addRoomModal">Oda Ekle</button> <!-- Oda Ekle butonu -->
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
          <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Reason</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="tag tag-success">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="tag tag-warning">Pending</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
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

<!-- Oda Ekle Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRoomModalLabel">Oda Ekle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="room_number">Oda Numarası</label>
            <input type="text" class="form-control" id="room_number" placeholder="Oda Numarası">
          </div>
          <div class="form-group">
            <label for="room_type_id">Oda Tipi</label>
            <select class="form-control" id="room_type_id">
              <option value="1">Standart</option>
              <option value="2">Deluxe</option>
              <option value="3">Suite</option>
              <!-- Oda tiplerini buraya ekleyebilirsin -->
            </select>
          </div>
          <div class="form-group">
            <label for="description">Açıklama</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Açıklama"></textarea>
          </div>
          <div class="form-group">
            <label for="price">Fiyat</label>
            <input type="number" class="form-control" id="price" placeholder="Fiyat">
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
        <button type="button" class="btn btn-primary">Kaydet</button>
      </div>
    </div>
  </div>
</div>

</div>

