<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Gawe &mdash; yukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('gawe') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create Gawe</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Gawe / Acara</h4>
            </div>
            <div class="card-body col-md-6">
            <?php $validation = \Config\Services::validation(); ?>
                <form action="<?= site_url('gawe') ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>     <!-- buat tangkis dari alert error dari crsf, atau bisa dibilang klo ada ini, hanya form ini yg bisa diinput/ bisa dibilang juga surat izin -->
                    <div class="form-group">
                        <label for="">Nama Gawe</label>
                        <input type="text" name="name_gawe" class="form-control <?= $validation->hasError('name_gawe') ? 'is-invalid' : null ?>" value="<?= old('name_gawe') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name_gawe') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Acara *</label>
                        <input type="date" name="date_gawe" class="form-control <?= $validation->hasError('date_gawe') ? 'is-invalid' : null ?>" value="<?= old('date_gawe') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('date_gawe') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Info</label>
                        <textarea type="text" name="info_gawe" class="form-control"></textarea>
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