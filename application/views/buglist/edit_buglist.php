<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1"><?= $title ?></h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Form <strong><?= $title ?></strong>
                        </div>
                        <div class="card-body card-block">
                            <?= form_open_multipart("fitur/changeBook") ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tanggal</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="hidden" name="id" value="<?= $buglist['id'] ?>">
                                    <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d\TH:i', strtotime($buglist['tanggal'])) ?>">
                                    <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Modul</label>
                                </div>
                                <img id="image-preview" src="#" alt="Uploaded Image" style="max-width:100%; max-height:200px; display:none;">
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="modul" name="modul" value="<?= $buglist['modul'] ?>">
                                    <?= form_error('modul', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Test Case</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="test_case" name="test_case" value="<?= $buglist['test_case'] ?>">
                                    <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Test Step</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="test_step" name="test_step" value="<?= $buglist['test_step'] ?>">
                                    <?= form_error('test_step', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="modal-body">
                                <!-- ... Bidang formulir lainnya ... -->
                                <div class="col-12 col-md-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url('assets/lampiran/') . $buglist['screenshoot'] ?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment" name="attachment">
                                                <label class="custom-file-label" for="attachment">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ... Bidang formulir lainnya ... -->
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="pic" class="form-control-label">PIC</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="custom-select" id="pic" name="pic">
                                        <?php foreach ($listpic as $pic) : ?>
                                            <?php if ($pic == $buglist['pic']) : ?>
                                                <option value="<?= $pic; ?>" selected><?= $pic ?></option>
                                            <?php else : ?>
                                                <option value="<?= $pic; ?>"><?= $pic ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="status" class="form-control-label">Status</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="custom-select" id="status" name="status">
                                        <?php foreach ($liststatus as $list) : ?>
                                            <?php if ($list == $buglist['status']) : ?>
                                                <option value="<?= $list; ?>" selected><?= $list ?></option>
                                            <?php else : ?>
                                                <option value="<?= $list; ?>"><?= $list ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">QA Note</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="qa_note" name="qa_note" value="<?= $buglist['qa_note'] ?>">
                                    <?= form_error('qa_note', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Dev Note</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="dev_note" name="dev_note" value="<?= $buglist['dev_note'] ?>">
                                    <?= form_error('dev_note', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Dev Pic</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="dev_pic" name="dev_pic" value="<?= $buglist['dev_pic'] ?>">
                                    <?= form_error('dev_pic', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="status" class="form-control-label">Severity</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="custom-select" id="severity" name="severity">
                                        <?php foreach ($listseverity as $severity) : ?>
                                            <?php if ($severity == $buglist['status']) : ?>
                                                <option value="<?= $severity; ?>" selected><?= $severity ?></option>
                                            <?php else : ?>
                                                <option value="<?= $severity; ?>"><?= $severity ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->