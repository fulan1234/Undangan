<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Groups &mdash; yukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>groups</h1>
        <div class="section-header-button">
            <a href="<?= site_url('groups/new')  ?>" class="btn btn-primary">Back</a>
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
                <h4>Data groups Kontak - Trash</h4>
            <div class="card-header-action">
                <a href="<?= site_url('groups/restore') ?>" class="btn btn-info">
                    <i class="fa fa-trash">
                        Restore All</i>
                </a>
            </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>Nama Groups</th>
                            <th>Info</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($groups as $key => $value) :?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value->name_group ?></td>
                            <td><?= $value->info_group ?></td>
                            <td class="text-center" style="width:17% ;">
                                <a
                                    href="<?= site_url('groups/restore/'.$value->id_group) ?>"
                                    class="btn btn-info btn-sm">
                                    Restore
                                </a>
                                <form
                                    action="<?= site_url('groups/delete2/'.$value->id_group) ?>"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin nih mau hapus data')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger btn-sm">Delete Permanent</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>