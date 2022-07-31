<?= $this->extend('/layouts/template') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h2>Lets Add New Comic</h2>
    <form action="/comic/action/create" method="post" enctype="multipart/form-data" >
    <?= csrf_field() ?>
    <div class="form-floating mb-3">
        <input type="text" name="judul" class="form-control" id="judul" placeholder="judul" value="<?= old('judul') ?>" >
        <label for="judul">Judul</label>
        <p class="text-danger"><?= $validation->getError('judul') ?></p>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="penulis" class="form-control" id="penulis" placeholder="penulis" value="<?= old('penulis') ?>">
        <label for="penulis">Penulis</label>
        <p class="text-danger"><?= $validation->getError('penulis') ?></p>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="penerbit" value="<?= old('penerbit') ?>">
        <label for="penerbit">Penerbit</label>
        <p class="text-danger"><?= $validation->getError('penerbit') ?></p>
        </div>
        <div class="form-floating mb-3">

        <div class="form-floation mb-3">
        <label for="sampul" class="form-label">Sampul</label>
        <input class="form-control" name="sampul" type="file" onchange="loadFile(event)" id="sampul">
        <img width="200" id="outputimg" alt="">
        </div>
        
        </div>
        <button class="btn btn-primary px-5 py-2">Add</button>
    </div>
    </form>
</div>
<?= $this->endSection() ?>