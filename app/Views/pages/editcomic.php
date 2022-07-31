<?= $this->extend('/layouts/template') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h2>Lets Edit Comic</h2>
    <form action="/comic/action/edit/<?= $comic['id'] ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT" >
    <div class="form-floating mb-3">
        <input type="text" name="judul" class="form-control" id="judul" placeholder="judul" value="<?= old('judul', $comic['judul']) ?>" >
        <input type="hidden" name="slug" value="<?= old('slug', $comic['slug']) ?>" >
        <label for="judul">Judul</label>
        <p class="text-danger"><?= $validation->getError('judul') ?></p>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="penulis" class="form-control" id="penulis" placeholder="penulis" value="<?= old('penulis', $comic['penulis']) ?>">
        <label for="penulis">Penulis</label>
        <p class="text-danger"><?= $validation->getError('penulis') ?></p>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="penerbit" value="<?= old('penerbit',$comic['penerbit']) ?>">
        <label for="penerbit">Penerbit</label>
        <p class="text-danger"><?= $validation->getError('penerbit') ?></p>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="sampul" class="form-control" id="sampul" placeholder="Sampul" value="<?= old('sampul',$comic['sampul']) ?>">
        <label for="sampul">Sampul</label>
        <p class="text-danger"><?= $validation->getError('sampul') ?></p>
        </div>
        <button class="btn btn-primary px-5 py-2">Edit</button>
    </div>
    </form>
</div>
<?= $this->endSection() ?>