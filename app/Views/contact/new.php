<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data contact &mdash; yukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('contacts') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create contact</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Buat Grup Kontak</h4>
            </div>
            <div class="card-body col-md-6">
            <?php $validation = \Config\Services::validation(); ?>
                <?php $errors = session()->getFlashdata('errors') ?>
                <form action="<?= site_url('contacts') ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>     <!-- buat tangkis dari alert error dari crsf, atau bisa dibilang klo ada ini, hanya form ini yg bisa diinput/ bisa dibilang juga surat izin -->
                <div class="form-group">
                        <label for="Group">Group *</label>
                        <select class="form-control <?= isset($errors['id_group']) ? 'is-invalid' : null ?> " name="id_group">
                            <option value="" hidden></option>               <!-- option ini dibikin kosong biar pas sebelum milih kolomnya kosong /hidden !-->
                            <?php foreach($groups as $key => $value) : ?>
                                <option value="<?= $value->id_group?>" <?= old('id_group') == $value->id_group? 'selected' : null ?> ><?= $value->name_group; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_group') ?>
                            <?= isset($errors['id_group']) ? $errors['id_group'] : null ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Kontak</label>
                        <input type="text" name="name_contact" class="form-control <?= isset($errors['id_group']) ? 'is-invalid' : null ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name_contact') ?>
                            <?= isset($errors['name_contact']) ? $errors['name_contact'] : null ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Alias</label>
                        <input type="text" name="name_alias" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea type="text" name="address" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Info</label>
                        <textarea type="text" name="info_contact" class="form-control"></textarea>
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