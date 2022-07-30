<?= $this->extend('/layouts/template') ?>
<?= $this->section('content') ?>
<div class="container my-5">
<table class="table align-middle">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Sampul</th>
      <th scope="col">Judul</th>
      <th scope="col">Penulis</th>
      <th scope="col">Penerbit</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $count = 1;
    foreach($comics as $comic){ ?>
    <tr>
      <th scope="row"><?= $count++ ?></th>
      <td><img src="/img/<?= $comic['sampul'] ?>" width="70" alt=""></td>
      <td><?= $comic['judul'] ?></td>
      <td><?= $comic['penulis'] ?></td>
      <td><?= $comic['penerbit'] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<?= $this->endSection() ?>