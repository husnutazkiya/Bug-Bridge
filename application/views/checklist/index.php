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
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#mediumModal">
                    Tambah Checklist
                </button>
                <a href="<?= base_url('Fitur/exportChecklistExcel') ?>" class="btn btn-success mb-3 ml-2">
                    Export Excel
                </a>
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Shift</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($checklist as $cl) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= isset($cl['username']) ? $cl['username'] : '' ?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($cl['tgl'])) ?></td>
                                    <td><?= $cl['shift'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm tombol-view" data-toggle="modal" data-target="#viewModal<?= $cl['id'] ?>">View</button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal<?= $cl['id'] ?>" >Edit</button>
                                        
                                        <a href="<?= base_url(); ?>fitur/hapus_checklist/<?= $cl['id']  ?>" class="btn btn-danger btn-sm tombol-hapus">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
            <?php if ($this->session->flashdata('flash')) : ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->

<!-- modal medium -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Checklist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('fitur/add_checklist', 'id="addChecklist" onsubmit="handleFormSubmit()"'); ?>
            <div class="modal-body">
            <div class="form-group">
                    <input type="hidden" class="form-control" id="nip" name="nip" value="<?= $user['nip'] ?>">
                </div>
                <div class="row form-group">
                    <div class="col-12 col-md-14">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="datetime-local" class="form-control" id="tgl" name="tgl">
                </div>
                <div class="form-group">
                    <label for="care_center">Care Center</label>
                    <select name="care_center" id="care_center" class="form-control">
                        <option value="Care Center 1">Care Center 1</option>
                        <option value="Care Center 2">Care Center 2</option>
                        <option value="Care Center 3">Care Center 3</option>
                        <option value="Care Center 4">Care Center 4</option>
                        <option value="Care Center 5">Care Center 5</option>
                        <option value="Care Center 6">Care Center 6</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="shift">Shift</label>
                    <select name="shift" id="shift" class="form-control">
                        <option value="Pagi">Pagi</option>
                        <option value="Siang">Siang</option>
                        <option value="Sore">Sore</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="hp">HP</label>
                    <select name="hp" id="hp" class="form-control">
                        <option value="OK">OK</option>
                        <option value="NOK">NOK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pc">All PC</label>
                    <select name="pc" id="pc" class="form-control">
                        <option value="OK">OK</option>
                        <option value="NOK">NOK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="monitoring">All Monitoring</label>
                    <select name="monitoring" id="monitoring" class="form-control">
                        <option value="OK">OK</option>
                        <option value="NOK">NOK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="apptools">All App Tools</label>
                    <select name="apptools" id="apptools" class="form-control">
                        <option value="OK">OK</option>
                        <option value="NOK">NOK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="webtools">All Web Tools</label>
                    <select name="webtools" id="webtools" class="form-control">
                        <option value="OK">OK</option>
                        <option value="NOK">NOK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        <?= form_close(); ?>

        </div>
    </div>
</div>
<!-- end modal medium -->

<!-- modal edit -->
<?php foreach ($checklist as $cl) : ?>
    <div class="modal fade" id="editModal<?= $cl['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <?= form_open_multipart("fitur/updateChecklist/{$cl['id']}", 'id="updateChecklist"'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="nip_edit" name="nip" value="<?= $user['nip'] ?>">
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-14">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username_edit" name="username" value="<?= $user['username'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl">Tanggal</label>
                        <input value=<?= $cl['tgl'] ?> type="datetime-local" class="form-control" id="tgl_edit" name="tgl">
                    </div>
                    <div class="form-group">
                        <label for="care_center">Care Center</label>
                        <select name="care_center" id="care_center_edit" class="form-control">
                            <option value="Care Center 1" <?= ($cl['care_center'] == 'Care Center 1') ? 'selected' : '' ?>>Care Center 1</option>
                            <option value="Care Center 2" <?= ($cl['care_center'] == 'Care Center 2') ? 'selected' : '' ?>>Care Center 2</option>
                            <option value="Care Center 3" <?= ($cl['care_center'] == 'Care Center 3') ? 'selected' : '' ?>>Care Center 3</option>
                            <option value="Care Center 4" <?= ($cl['care_center'] == 'Care Center 4') ? 'selected' : '' ?>>Care Center 4</option>
                            <option value="Care Center 5" <?= ($cl['care_center'] == 'Care Center 5') ? 'selected' : '' ?>>Care Center 5</option>
                            <option value="Care Center 6" <?= ($cl['care_center'] == 'Care Center 6') ? 'selected' : '' ?>>Care Center 6</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="shift">Shift</label>
                        <select name="shift" id="shift_edit" class="form-control">
                            <option value="Pagi" <?= ($cl['shift'] == 'Pagi') ? 'selected' : '' ?>>Pagi</option>
                            <option value="Siang" <?= ($cl['shift'] == 'Siang') ? 'selected' : '' ?>>Siang</option>
                            <option value="Sore" <?= ($cl['shift'] == 'Sore') ? 'selected' : '' ?>>Sore</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hp">HP</label>
                        <select name="hp" id="hp_edit" class="form-control">
                            <option value="OK" <?= ($cl['hp'] == 'OK') ? 'selected' : '' ?>>OK</option>
                            <option value="NOK" <?= ($cl['hp'] == 'NOK') ? 'selected' : '' ?>>NOK</option>
                            <option value="Normal" <?= ($cl['hp'] == 'Normal') ? 'selected' : '' ?>>Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pc">All PC</label>
                        <select name="pc" id="pc_edit" class="form-control">
                            <option value="OK" <?= ($cl['pc'] == 'OK') ? 'selected' : '' ?>>OK</option>
                            <option value="NOK" <?= ($cl['pc'] == 'NOK') ? 'selected' : '' ?>>NOK</option>
                            <option value="Normal" <?= ($cl['pc'] == 'Normal') ? 'selected' : '' ?>>Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="monitoring">All Monitoring</label>
                        <select name="monitoring" id="monitoring_edit" class="form-control">
                            <option value="OK" <?= ($cl['monitoring'] == 'OK') ? 'selected' : '' ?>>OK</option>
                            <option value="NOK" <?= ($cl['monitoring'] == 'NOK') ? 'selected' : '' ?>>NOK</option>
                            <option value="Normal" <?= ($cl['monitoring'] == 'Normal') ? 'selected' : '' ?>>Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="apptools">All App Tools</label>
                        <select name="apptools" id="apptools_edit" class="form-control">
                            <option value="OK" <?= ($cl['apptools'] == 'OK') ? 'selected' : '' ?>>OK</option>
                            <option value="NOK" <?= ($cl['apptools'] == 'NOK') ? 'selected' : '' ?>>NOK</option>
                            <option value="Normal" <?= ($cl['apptools'] == 'Normal') ? 'selected' : '' ?>>Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="webtools">All Web Tools</label>
                        <select name="webtools" id="webtools_edit" class="form-control">
                            <option value="OK" <?= ($cl['webtools'] == 'OK') ? 'selected' : '' ?>>OK</option>
                            <option value="NOK" <?= ($cl['webtools'] == 'NOK') ? 'selected' : '' ?>>NOK</option>
                            <option value="Normal" <?= ($cl['webtools'] == 'Normal') ? 'selected' : '' ?>>Normal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan_edit" name="catatan"><?= $cl['catatan'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- end modal medium -->

<!-- Modal View -->
<?php foreach ($checklist as $cl) : ?>
    <div class="modal fade" id="viewModal<?= $cl['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Checklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>Nama:</td>
                            <td><?= $user['username'] ?></td> 
                        </tr>
                        <tr>
                            <td>Tanggal:</td>
                            <td><?= $cl['tgl']?></td>
                        </tr>
                        <tr>
                            <td>Care Center:</td>
                            <td><?= $cl['care_center']?></td>
                        </tr>
                        <tr>
                            <td>Shift:</td>
                            <td><?= $cl['shift']?></td>
                        </tr>
                        <tr>
                            <td>HP Operasional:</td>
                            <td><?= $cl['hp'] ?></td>
                        </tr>
                        <tr>
                            <td>PC Operasional:</td>
                            <td><?= $cl['pc']?></td>
                        </tr>
                        <tr>
                            <td>All Apps Monitoring:</td>
                            <td><?= $cl['monitoring']?></td>
                        </tr>
                        <tr>
                            <td>All Apps Tools:</td>
                            <td><?= $cl['apptools']?></td>
                        </tr>
                        <tr>
                            <td>All Web Tools:</td>
                            <td><?= $cl['webtools']?></td>
                        </tr>
                        <tr>
                            <td>Catatan:</td>
                            <td><?= $cl['catatan']?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
