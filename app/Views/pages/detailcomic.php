<?= $this->extend('/layouts/template') ?>

<?= $this->section('content') ?>
<div class="container py-5 col-5">
<div class="card">
  <div class="card-header">
    <?= $comic['judul'] ?>
  </div>
  <div class="card-body">
    <img src="/img/<?= $comic['sampul'] ?>" width="200" alt="">
    <h5 class="card-title">Penulis : <?= $comic['penulis'] ?></h5>
    <p class="card-text">Penerbit : <?= $comic['penerbit'] ?></p>
  </div>
</div>
</div>
<?= $this->endSection() ?>