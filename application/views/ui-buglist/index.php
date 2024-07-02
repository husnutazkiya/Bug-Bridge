<style>
    .text-danger {
        color: #ff0000; /* Red color */
    }
</style>
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
                    Tambah Bug 
                </button>
                            <script>
                document.getElementById('attachment').addEventListener('change', function() {
                    var selectedFile = this.files[0];
                    console.log('File yang diunggah:', selectedFile);
                });
            </script>

                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Action</th>
                                <th>Tanggal</th>
                                <th>Modul</th>
                                <th>Message</th>
                                <th>Test Step</th>
                                <th>Screenshoot</th>
                                <th>PIC</th>
                                <th>Status</th>
                                <th>QA Note</th>
                                <th>Dev Note</th>
                                <th>Severity</th>
                            <tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($buglist)): ?>
                            <?php $i = 1; ?>
                            <?php foreach ($buglist as $lbu) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>fitur/edit_buglist/<?= $lbu->id ?>" class="btn btn-success btn-sm">Update</a>
                                        <a href="<?= base_url(); ?>fitur/hapus_buglist/<?= $lbu->id ?>" class="btn btn-danger btn-sm tombol-hapus">Delete</a>
                                        <button type="button" class="btn btn-info btn-sm tombol-view" data-toggle="modal" data-target="#viewModal<?=$lbu->id?>">View</button>
                                    </td>
                                    <td><?= date('Y-m-d h:i A', strtotime($lbu->tanggal)) ?></td>
                                    <td><?= $lbu->modul ?></td>
                                    <td><?= $lbu->message ?></td>
                                    <td><?= $lbu->test_step ?></td>
                                    <td>
                                        <img src="<?= base_url('assets/lampiran/' . $lbu->screenshoot) ?>" alt="Uploaded Image" style="max-width:200px; max-height:200px;">
                                    </td>
                                    <td>
                                        <?php
                                            $pic = $lbu->pic;
                                            $picClass = isset($developerBadgeClasses[$pic]) ? $developerBadgeClasses[$pic] : 'badge badge-pill badge-primary';
                                        ?>
                                        <span class="<?= $picClass; ?>"><?= $pic; ?></span>
                                    </td>
                                    <td>
                                        <?php
                                            $statusClass = '';
                                            switch ($lbu->status) {
                                                case 'Open':
                                                    $statusClass = 'badge badge-pill badge-danger';
                                                    break;
                                                case 'Ready to test':
                                                    $statusClass = 'badge badge-pill badge-warning';
                                                    break;
                                                case 'Close':
                                                    $statusClass = 'badge badge-pill badge-success';
                                                    break;
                                                default:
                                            }
                                        ?>
                                        <span class="<?= $statusClass; ?>"><?= $lbu->status; ?></span>
                                    </td>
                                    <td><?= $lbu->qa_note ?></td>
                                    <td><?= $lbu->dev_note ?></td>
                                    <td><?= $lbu->severity ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12">No bug list available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Bug List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('fitur/add_UIbuglist', 'id="addLogBookForm"'); ?> 
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="kode" name="kode" value="<?= $user['kode'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="datetime-local" class="form-control" id="tgl" name="tgl">
                </div>
                <div class="form-group">
                <label for="Modul">Modul</label>
                    <textarea name="modul" id="modul" rows="3" placeholder="Tulis Modul" class="form-control"></textarea>
                </div>
                <div class="form-group">
                <label for="Message">Message</label>
                    <textarea name="message" id="message" rows="4" placeholder="Tulis Test Case" class="form-control"></textarea>
                </div>
                <div class="form-group">
                <label for="Test Step">Test Step</label>
                    <textarea name="test_step" id="test_step" rows="5" placeholder="Tulis Test Step" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="pic">PIC</label>
                    <select name="pic" id="pic" class="form-control">
                        <option value="">Select PIC</option>
                        <?php foreach ($developer as $dev): ?>
                            <option value="<?php echo $dev->id; ?>"><?php echo $dev->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="open" class="text-danger">Open</option>
                        <option value="ready to test">Ready to test</option>
                        <option value="close">Close</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="QA Note">Qa Note</label>
                    <textarea name="qa_note" id="qa_note" rows="7" placeholder="Tulis judul" class="form-control"></textarea>
                </div>
                <div class="form-group">
                <label for="Dev Note">Dev Note</label>
                    <textarea name="dev_note" id="dev_note" rows="8" placeholder="Tulis Test Case" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="severity">Severity</label>
                    <select name="severity" id="severity" class="form-control">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" class="form-control" id="attachment" name="attachment">
                        <small class="form-text text-muted">Pilih berkas dengan format jpg, jpeg, png, atau gif Max. 2 MB</small>
                    </div>
                    <!-- Add an <img> tag to display the uploaded image -->
                    <img id="image-preview" src="#" alt="Uploaded Image" style="max-width:100%; max-height:200px; display:none;">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="nama" name="nama" value="<?= $user['name'] ?>">
                    <input type="hidden" class="form-control" id="level" name="level" value="<?= $user['jabatan'] ?>">
                    <input type="hidden" class="form-control" id="kode" name="kode" value="<?= $user['kode'] ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- end modal medium -->
<!-- Modal View -->
<?php foreach ($buglist as $lbu) : ?>
    <div class="modal fade" id="viewModal<?= $lbu->id ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Bug List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>Tanggal:</td>
                            <td><?= date('Y-m-d / h:i A', strtotime($lbu->tanggal)) ?></td>
                        </tr>
                        <tr>
                            <td>Modul:</td>
                            <td><?= $lbu->modul ?></td>
                        </tr>
                        <tr>
                            <td>Test Case:</td>
                            <td><?= $lbu->test_case ?></td>
                        </tr>
                        <tr>
                            <td>Test Step:</td>
                            <td><?= $lbu->test_step ?></td>
                        </tr>
                        <tr>
                            <td>PIC:</td>
                            <td><?= $lbu->pic ?></td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td><?= $lbu->status ?></td>
                        </tr>
                        <tr>
                            <td>Qa Note:</td>
                            <td><?= $lbu->qa_note ?></td>
                        </tr>
                        <tr>
                            <td>Dev Note:</td>
                            <td><?= $lbu->dev_note ?></td>
                        </tr>
                        <tr>
                            <td>Dev Pic:</td>
                            <td><?= $lbu->dev_pic ?></td>
                        </tr>
                        <tr>
                            <td>Severity:</td>
                            <td><?= $lbu->severity ?></td>
                        </tr>
                        <tr>
                            <td>Screenshoot:</td>
                            <td>
                                <img src="<?= base_url('assets/lampiran/' . $lbu->screenshoot) ?>" alt="Uploaded Image" style="max-width:200px; max-height:200px;">
                            </td>
                        </tr>
                        <!-- Add more fields as needed -->
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script>
    $(document).ready(function () {
        // Function to handle filter option selection
        $('.filter-option').on('click', function () {
            var filterType = $(this).data('filter');

            // Show respective dropdown menu based on filter type
            if (filterType === 'status') {
                $('#statusDropdownContainer').toggle();
                $('#nameDropdownContainer').hide();
            } else if (filterType === 'name') {
                $('#nameDropdownContainer').toggle();
                $('#statusDropdownContainer').hide();
            }
        });

        // Function to handle status filter selection
        $('.status-filter-option').on('click', function () {
            var status = $(this).data('status');
            var nameFilter = $('.name-filter-option.active').data('name') || 'all';

            filterTable(status, nameFilter);
        });

        // Function to handle name filter selection
        $('.name-filter-option').on('click', function () {
            var name = $(this).data('name');
            var statusFilter = $('.status-filter-option.active').data('status') || 'all';

            filterTable(statusFilter, name);
        });

        // Function to filter tables
        function filterTable(status, name) {
            $('.table-responsive').hide();

            if (status === 'all' && name === 'all') {
                $('.table-responsive').show();
            } else {
                var selector = '#' + status + name.capitalize() + 'Table';
                $(selector).show();
            }
        }

        // Capitalize the first letter of a string
        String.prototype.capitalize = function() {
            return this.charAt(0).toUpperCase() + this.slice(1);
        };
    });
</script>

<script>
    // Define options for filter value based on selected filter search
    const filterValueOptions = {
        'status': ['All', 'Open', 'Ready to test', 'Close'],
        'name': ['All', 'Husnu', 'Adhi'],
        'date': [] // You can define options for date filter dynamically if needed
    };
    
    // Function to populate filter value options based on selected filter search
    function populateFilterValueOptions(selectedFilter) {
        const filterValueSelect = document.getElementById('filter-value');
        filterValueSelect.innerHTML = ''; // Clear previous options
        
        // Populate options based on selected filter search
        filterValueOptions[selectedFilter].forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option.toLowerCase().replace(/\s+/g, ''); // Convert to lowercase and remove spaces
            optionElement.textContent = option;
            filterValueSelect.appendChild(optionElement);
        });
    }
    
    // Event listener for filter search change
    document.getElementById('filter-search').addEventListener('change', function() {
        const selectedFilter = this.value;
        populateFilterValueOptions(selectedFilter);
    });
    
    // Event listener for filter button click
    document.getElementById('filter-button').addEventListener('click', function() {
        const selectedFilter = document.getElementById('filter-search').value;
        const selectedValue = document.getElementById('filter-value').value;
        const searchInputValue = document.getElementById('search-input').value;
        
        // Perform filtering based on selected filter and value
        // Implement your filtering logic here
        
        // For demonstration purposes, let's just log the selected options
        console.log('Filter Search:', selectedFilter);
        console.log('Filter Value:', selectedValue);
        console.log('Search Input:', searchInputValue);
    });
    
    // Event listener for reset button click
    document.getElementById('reset-button').addEventListener('click', function() {
        // Reset filter options and search input
        document.getElementById('filter-search').value = 'status';
        populateFilterValueOptions('status');
        document.getElementById('search-input').value = '';
        
        // Perform any additional reset actions as needed
    });
</script>

