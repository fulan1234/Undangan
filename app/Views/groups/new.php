<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Gawe &mdash; yukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('groups') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create Gawe</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Buat Grup Kontak</h4>
            </div>
            <div class="card-body col-md-6">
                <?php $validation = \Config\Services::validation(); ?>
                <form action="<?= site_url('groups') ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>     <!-- buat tangkis dari alert error dari crsf, atau bisa dibilang klo ada ini, hanya form ini yg bisa diinput/ bisa dibilang juga surat izin -->
                    <div class="form-group">
                        <label for="">Nama group</label>
                        <input type="text" name="name_group" class="form-control <?= $validation->hasError('name_group') ? 'is-invalid' : null ?>" value="<?= old('name_group') ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('name_group') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Info Group</label>
                        <textarea type="text" name="info_group" class="form-control <?= $validation->hasError('info_group') ? 'is-invalid' : null ?>"><?= old('info_group') ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('info_group') ?>
                        </div> 
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>