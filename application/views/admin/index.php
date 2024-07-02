<style>
    .badge-lg {
        font-size: 1.25em;
        /* Ubah ukuran teks sesuai kebutuhan */
    }

    .status-badge {
        font-size: 0.75em; /* Ukuran teks badge */
        padding: 5px 10px; /* Padding agar badge terlihat lebih jelas */
        border-radius: 10px; /* Membuat sudut badge melengkung */
        display: inline-block; /* Membuat badge menjadi inline block */
        text-align: center; /* Pusatkan teks di dalam badge */
        margin-bottom: 5px; /* Jarak antara badge */
    }

    /* Atur warna latar belakang untuk status Open */
    .status-open {
        background-color: green;
        color: white;
    }

    /* Atur warna latar belakang untuk status Waiting Close */
    .status-waiting {
        background-color: orange;
        color: white;
    }

    .status-not-set {
        background-color: red;
        color: white;
    }

    #buglist-chart {
            max-width: 300px; /* Set maximum width */
            max-height: 300px; /* Set maximum height */
            width: 100%; /* Make it responsive */
            height: auto; /* Make it responsive */
            margin: 0 auto;
        }
    #developer-progress-chart {
        max-width: 300px; /* Set maximum width */
        max-height: 300px; /* Set maximum height */
        width: 100%; /* Make it responsive */
        height: auto; /* Make it responsive */
        margin: 0 auto;
    }
</style>
<!-- MAIN CONTENT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <div class="main-content">
            <div class="row offset-lg-1">
                <!-- Chart untuk Count Status Buglist -->
                <div class="col-lg-5 ml-4">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <div class="section__content section__content--p30">
                                <h2 class="text-center mb-4">Count Status Buglist</h2>
                                <canvas id="buglist-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart untuk Count Progress Developer -->
                <div class="col-lg-5 ml-4">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <div class="section__content section__content--p30">
                                <h2 class="text-center mb-4">Progress Developer</h2>
                                <canvas id="developer-progress-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-10 offset-lg-1"> 
                    <div class="au-card">
                        <div class="au-card-inner">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Developer</th>
                                            <th>Open</th>
                                            <th>Close</th>
                                            <th>Ready to Test</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bugCount as $developer => $counts) : ?>
                                            <tr>
                                                <td><?php echo $developer; ?></td>
                                                <td><?php echo $counts['Open']; ?></td>
                                                <td><?php echo $counts['Close']; ?></td>
                                                <td><?php echo $counts['Ready to Test']; ?></td>
                                                <td><?php echo $counts['Total']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo $total; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- <div class="container-fluid">   
                    <div class="row"></div>
                        <button type="button" class="btn btn-danger mb-3" id="logbookButton">
                            Open
                        </button>     
                        <button type="button" class="btn btn-primary mb-3" id="checklistButton">
                            Ready to test
                        </button>
                        <button type="button" class="btn btn-success mb-3" id="closetablebutton">
                            close
                        </button>
                    <form action="<?= site_url('admin/search') ?>" method="get" id="searchForm">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= isset($keyword) ? esc($keyword) : '' ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>

                    <?php foreach ($unit as $u) : ?>
                        <h2 class="title-1">Open : <?= $u->unit ?></h2>
                    <?php endforeach; ?>
                    <div class="row m-t-25">
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

                        <div class="table-responsive table--no-card m-b-30" id="checklistTable">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Modul</th>
                                        <th>Test Case</th>
                                        <th>Test Step</th>
                                        <th>Screenshoot</th>
                                        <th>Status</th>
                                        <th>QA Note</th>
                                        <th>Dev Note</th>
                                        <th>Dev PIC</th>
                                        <th>Severity</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php if (!empty($ready)) : ?>
                                        <?php foreach ($ready as $rdy) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('Y-m-d H:i', strtotime($rdy->tanggal)) ?></td>
                                                <td><?= $rdy->modul; ?></td>
                                                <td><?= $rdy->test_case ?></td>
                                                <td><?= $rdy->test_step ?></td>
                                                <td>
                                                    <?php if (!empty($rdy->screenshoot)) : ?>
                                                        <img src="<?= base_url('assets/lampiran/' . $rdy->screenshoot) ?>" alt="Uploaded Image" style="max-width:150px; max-height:150px;">
                                                    <?php else : ?>
                                                        Tidak ada lampiran
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $rdy->status ?></td>
                                                <td><?= $rdy->qa_note ?></td>
                                                <td><?= $rdy->dev_note ?></td>
                                                <td><?= $rdy->dev_pic ?></td>
                                                <td><?= $rdy->severity ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>Tidak ada buglist ready to test.</p>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive table--no-card m-b-30" id="closetable">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Modul</th>
                                        <th>Test Case</th>
                                        <th>Test Step</th>
                                        <th>Screenshoot</th>
                                        <th>Status</th>
                                        <th>QA Note</th>
                                        <th>Dev Note</th>
                                        <th>Dev PIC</th>
                                        <th>Severity</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php if (!empty($close)) : ?>
                                        <?php foreach ($close as $cls) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('Y-m-d H:i', strtotime($cls->tanggal)) ?></td>
                                                <td><?= $cls->modul; ?></td>
                                                <td><?= $cls->test_case ?></td>
                                                <td><?= $cls->test_step ?></td>
                                                <td>
                                                    <?php if (!empty($cls->screenshoot)) : ?>
                                                        <img src="<?= base_url('assets/lampiran/' . $cls->screenshoot) ?>" alt="Uploaded Image" style="max-width:150px; max-height:150px;">
                                                    <?php else : ?>
                                                        Tidak ada lampiran
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $cls->status ?></td>
                                                <td><?= $cls->qa_note ?></td>
                                                <td><?= $cls->dev_note ?></td>
                                                <td><?= $cls->dev_pic ?></td>
                                                <td><?= $cls->severity ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>Tidak ada buglist close.</p>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div> -->
        </div>
    </div>
</div>

<?php
    $status_counts = array(
        'Open' => count($log),
        'Ready to test' => count($ready),
        'Close' => count($close)
    );
?>


<script>
    // Log the data to the console
    console.log(<?php echo json_encode($log); ?>);
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
        $(document).ready(function () {
            console.log(<?php echo json_encode($log); ?>);

            $('#checklistTable').hide();
            $('#closetable').hide();

            $('#logbookButton').on('click', function () {
                $('#logbookTable').show();
                $('#checklistTable').hide();
                $('#closetable').hide();
            });

            $('#checklistButton').on('click', function () {
                $('#logbookTable').hide();
                $('#checklistTable').show();
                $('#closetable').hide();
            });

            $('#closetablebutton').on('click', function () {
                $('#logbookTable').hide();
                $('#checklistTable').hide();
                $('#closetable').show();
            });

    });

</script>

<!-- pie chart for status -->
<script>
    // JavaScript code to render the chart
    var ctx = document.getElementById('buglist-chart').getContext('2d');
    var buglistChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Open', 'Ready to test', 'Close'],
            datasets: [{
                label: 'Buglist Status',
                data: [<?php echo $openCount ?>, <?php echo $readyCount ?>, <?php echo $closeCount ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',  // Red for Open
                    'rgba(255, 206, 86, 0.2)',  // Yellow for Ready to test
                    'rgba(75, 192, 192, 0.2)'   // Green for Close
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',    // Red for Open
                    'rgba(255, 206, 86, 1)',    // Yellow for Ready to test
                    'rgba(75, 192, 192, 1)'     // Green for Close
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

<!-- pie chart for Developer -->
<script>
    var ctx = document.getElementById('developer-progress-chart').getContext('2d');
    var developerProgressChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(array_keys($developerProgress)); ?>,
            datasets: [{
                label: 'Progress Developer',
                data: <?php echo json_encode(array_values($developerProgress)); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Red
                    'rgba(255, 206, 86, 0.2)', // Yellow
                    'rgba(75, 192, 192, 0.2)', // Green
                    'rgba(201, 203, 207, 0.2)', // Gray for No pic
                    'rgba(54, 162, 235, 0.2)', // Blue
                    'rgba(153, 102, 255, 0.2)', // Purple
                    'rgba(255, 159, 64, 0.2)'  // Orange
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Red
                    'rgba(255, 206, 86, 1)', // Yellow
                    'rgba(75, 192, 192, 1)', // Green
                    'rgba(201, 203, 207, 1)', // Gray for No pic
                    'rgba(54, 162, 235, 1)', // Blue
                    'rgba(153, 102, 255, 1)', // Purple
                    'rgba(255, 159, 64, 1)'  // Orange
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>



<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->