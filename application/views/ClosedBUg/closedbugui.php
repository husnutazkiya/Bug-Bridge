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
             <a href="<?= base_url('UAT/exportChecklistExcel') ?>" class="btn btn-success mb-3 ml-2">
                    Export Excel
            </a>
            <div class="table-responsive table--no-card m-b-30" id="logbookTable">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Modul</th>
                            <th>Test Case</th>
                            <th>Test Step</th>
                            <th>Screenshoot</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>QA Note</th>
                            <th>Dev Note</th>
                            <th>Dev PIC</th>
                            <th>Severity</th>
                        <tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php if (!empty($log)) : ?>
                            <?php foreach ($log as $lb) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($lb->tanggal)) ?></td>
                                    <td><?= $lb->modul; ?></td>
                                    <td><?= $lb->test_case ?></td>
                                    <td><?= $lb->test_step ?></td>
                                    <td>
                                        <?php if (!empty($lb->screenshoot)) : ?>
                                            <img src="<?= base_url('assets/lampiran/' . $lb->screenshoot) ?>" alt="Uploaded Image" style="max-width:150px; max-height:150px;">
                                        <?php else : ?>
                                            Tidak ada lampiran
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $lb->pic ?></td>
                                    <td><?= $lb->status ?></td>
                                    <td><?= $lb->qa_note ?></td>
                                    <td><?= $lb->dev_note ?></td>
                                    <td><?= $lb->dev_pic ?></td>
                                    <td><?= $lb->severity ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>Tidak ada data buglist open.</p>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>