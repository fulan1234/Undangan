tampil kontak<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Contacts &mdash; yukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Contacts</h1>
        <div class="section-header-button">
            <a href="<?= site_url('contacts/new')  ?>" class="btn btn-primary">Add New</a>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">x</button>
            <b>Success!siuu</b>
            <?= session()->getFlashdata('success')?>
        </div>
    </div>
    <?php endif ?>

    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">x</button>
            <b>Error !</b>
            <?= session()->getFlashdata('error')?>
        </div>
    </div>
    <?php endif ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Contacts Saya</h4>
                <div class="card-header">
                    <form action="" method="get" autocomplete="off">
                        <div class="float-left">
                            <input type="text" name="keyword" value="<?= $keyword ?>" class="form-control" style="width:155pt;" placeholder="Keyword Pencarian" id="">
                        </div>
                        <div class="float-right ml-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kontak</th>
                            <th>Alias</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Info</th>
                            <th>Grup</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $no = 1 + (10*($page - 1));
                    foreach($contacts as $key => $value) :?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value->name_contact ?></td>
                            <td><?= $value->name_alias ?></td>
                            <td><?= $value->phone ?></td>
                            <td><?= $value->email ?></td>
                            <td><?= $value->address ?></td>
                            <td><?= $value->info_contact ?></td>
                            <td><?= $value->name_group ?></td>
                            <td class="text-center" style="width:15% ;">
                                <a
                                    href="<?= site_url('contacts/'.$value->id_contact.'/edit') ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form
                                    action="<?= site_url('contacts/'.$value->id_contact) ?>"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin nih mau hapus data')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="float-left">
                    <i>Showing <?= 1 + (10*($page - 1)) ?> to <?= $no-1 ?> <?= $pager->getTotal() ?> entries</i>
                </div>
                <div class="float-right">
                <?= $pager->links('default', 'pagination') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>