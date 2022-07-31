<?= $this->extend('/layouts/template') ?>
<?= $this->section('content') ?>
<div class="container my-5">
  <a href="/comic/action/create" class="btn btn-primary mb-5">Add New Comic</a>
  
  <?php if (session()->getFlashdata('message')) { ?>
    <div class="alert alert-primary" role="alert">
      <?= session()->getFlashdata('message') ?>
    </div>
  <?php } ?>
  <?php if (session()->getFlashdata('deleted')) { ?>
    <div class="alert alert-danger" role="alert">
      <?= session()->getFlashdata('deleted') ?>
    </div>
  <?php } ?>
<table class="table align-middle">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Sampul</th>
      <th scope="col">Judul</th>
      <th scope="col">Penulis</th>
      <th scope="col">Penerbit</th>
      <th scope="col">Aksi</th>
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
      <td class="d-flex">
        <a href="/comic/<?= $comic['slug'] ?>" class="btn btn-primary" >Detail</a>
        <a href="/comic/<?= $comic['slug'] ?>/edit" class="btn btn-warning mx-2" >Edit</a>
        <form action="/comic/action/delete/<?= $comic['id'] ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="DELETE">
          <button class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<?= $this->endSection() ?>