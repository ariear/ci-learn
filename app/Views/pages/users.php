<?= $this->extend('/layouts/template') ?>
<?= $this->section('content') ?>
<div class="container my-5">
  
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

  <form method="get">
      <div class="input-group mb-3">
      <input type="search" class="form-control" placeholder="Search" name="name" >
      <button class="btn btn-primary" type="button" id="button-addon2">Button</button>
    </div>
  </form>

<table class="table align-middle">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $count = 1 + (10 * ($currentPage - 1)) ;
    foreach($users as $user){ ?>
    <tr>
      <th scope="row"><?= $count++ ?></th>
      <td><?= $user['name'] ?></td>
      <td><?= $user['address'] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
        <?= $pager->links('user', 'user_pagination') ?>
</div>
<?= $this->endSection() ?>