<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH .'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $user_id = $this->session->userdata('user_id'); // Gantilah dengan cara Anda mendapatkan ID pengguna (user_id).
        $user_nip = $this->session->userdata('nip'); // Gantilah dengan cara Anda mendapatkan ID pengguna (user_id).
        $user_kode = $this->session->userdata('kode'); // Gantilah dengan cara Anda mendapatkan ID pengguna (user_id).
        if ($user_id == 1) {
            $data['buglist'] = $this->Admin_model->getAllbuglist();
        } else {
            $data['buglist'] = $this->Admin_model->getAllbuglist($user_nip);
        }
        

        $kode = $data['user']['kode'];

        $data['log'] = [];
        $data['ready'] = [];
        $data['close'] = [];
        $openCount = 0;
        $readyCount = 0;
        $closeCount = 0;

        if (!empty($kode)) {
            $data['log'] = $this->Admin_model->getbuglistopenByKode($kode);
            $data['ready'] = $this->Admin_model->getBugListReadyByKode($kode);
            $data['close'] = $this->Admin_model->getbuglistcloseByKode($kode);

            $openCount = count($this->Admin_model->getbuglistopenByKode($kode));
            $readyCount = count($this->Admin_model->getBugListReadyByKode($kode));
            $closeCount = count($this->Admin_model->getbuglistcloseByKode($kode));
        }

        // Add counts to data array
        $data['openCount'] = $openCount;
        $data['readyCount'] = $readyCount;
        $data['closeCount'] = $closeCount;

        //count developer
        $data['developer']= $this->Logbook_model->getdeveloper($kode);
        $developerProgress = array();
        foreach ($data['developer'] as $developer) {
            $developerProgress[$developer->name] = 0;
        }
        $developerProgress['No pic'] = 0;

        foreach ($data['buglist'] as $bug) {
            if (isset($developerProgress[$bug->pic])) {
                $developerProgress[$bug->pic]++;
            } else {
                $developerProgress['No pic']++;
            }
        }

        $data['developerProgress'] = $developerProgress;

        $bugCount = array();
        $total = 0;
        foreach ($data['developer'] as $developer) {
            $bugCount[$developer->name] = array(
                'Open' => 0,
                'Close' => 0,
                'Ready to Test' => 0,
                'Total' => 0
            );
        }
    
        foreach ($data['buglist'] as $bug) {
            if (isset($bugCount[$bug->pic])) {
                switch ($bug->status) {
                    case 'Open':
                        $bugCount[$bug->pic]['Open']++;
                        break;
                    case 'Close':
                        $bugCount[$bug->pic]['Close']++;
                        break;
                    case 'Ready to Test':
                        $bugCount[$bug->pic]['Ready to Test']++;
                        break;
                }
                $bugCount[$bug->pic]['Total']++;
                $total++;
            }
        }
    
        $data['bugCount'] = $bugCount;
        $data['total'] = $total;
    
        $data['unit'] = $this->User_model->getUnitbyNip();
        
        // $data['checklist'] = $this->Checklist_model->getAllChecklistData();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function dataUser(){
    $data['title'] = 'Data User';
    $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->load->library('pagination');

    $data['categories'] = array(
        'Monitoring',
        'Customer Complain'
        // Tambahkan kategori lainnya sesuai dengan daftar Anda
    );

    // Mendefinisikan daftar layanan (gantilah dengan daftar sebenarnya)
    $data['services'] = array(
        'BBS Bakti',
        'Ai Bakti',
        'Vsatstar',
        'Remote Vsat IP',
        'Mobile Vsat IP',
        'Mangosfamily',
        'Radio IP',
        'MCS (Mobile Conectivity Service)',
        'Maritim Gyro',
        'Broadcast',
        'Vsat SCPC',
        'Vsat DSCPC',
        'MPLS',
        'BGAN (Broadband Global Area Network)',
        'MSP',
        'FBB (Fleet Broadband)',
        'SBB (Swift Broadband)',
        'CPE',
        'HT satellite',
        'SN (Support Network)',
        'SGN (Solution Global Network)'
        // Tambahkan layanan lainnya sesuai dengan daftar Anda
    );

    // Fitur searching
    if ($this->input->post('submit')){
        $data['search'] = $this->input->post('search');
        $this->session->set_userdata('search', $data['search']);
    } else {
        $data['search'] = $this->session->userdata('search') ?? ''; // Gunakan default string kosong jika session tidak ada
    }

    if ($this->input->post('submit_sort_service')) {
        $data['sort_service'] = $this->input->post('sort_service');
        $this->session->set_userdata('sort_service', $data['sort_service']);
    } else {
        $data['sort_service'] = $this->session->userdata('sort_service');
    }
    
    // Fitur sorting berdasarkan kategori
    if ($this->input->post('submit_sort_category')) {
        $data['sort_category'] = $this->input->post('sort_category');
        $this->session->set_userdata('sort_category', $data['sort_category']);
    } else {
        $data['sort_category'] = $this->session->userdata('sort_category');
    }

    if (!$this->input->post('submit_sort_service') && !$this->input->post('submit_sort_category')) {
        $this->session->unset_userdata('sort_service');
        $this->session->unset_userdata('sort_category');
    }
    if ($this->input->post('reset')) {
        $this->session->unset_userdata('search');
        $this->session->unset_userdata('start_date');
        $this->session->unset_userdata('end_date');
        $this->session->unset_userdata('sort_service');
        $this->session->unset_userdata('sort_category');
        redirect('admin/datauser'); // Redirect to the close view after resetting
        return; // Return to prevent further execution of the method
    }


    // Konfigurasi pagination
    $config['base_url'] = base_url('admin/datauser/');
    $config['total_rows'] = $this->Logbook_model->countAllLogbook();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    $config['full_tag_open'] = '<nav> <ul class="pagination pagination-lg justify-content-end">';
    $config['full_tag_close'] = '</ul> </nav>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = array('class' => 'page-link');

    $this->pagination->initialize($config);

    // Ambil parameter segmen URI untuk offset
    $data['start'] = $this->uri->segment(3);

    // Panggil fungsi yang mengambil semua data logbook dengan parameter pencarian
    $data['logbooks'] = $this->Logbook_model->getAllLogbook(
        $config['per_page'],
        $data['start'],
        $data['search'],
        $data['sort_category'], // Tambahkan parameter sorting kategori
        $data['sort_service']  // Tambahkan parameter sorting layanan
    );

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/datauser', $data);
    $this->load->view('templates/footer');
}

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
            redirect('admin/role');
        }
    }

    public function hapus($id)
    {
        $this->Admin_model->hapusDataRole($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/role');
    }

    public function edit_role($id)
    {
        $data['title'] = 'Edit Role';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user_role'] = $this->Admin_model->getRoleById($id);

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/edit_role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editDataRole();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses level berhasil diubah!</div>');
    }

    public function user()
    {
        $data['title'] = 'User';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['unit'] = $this->db->get('tb_unit')->result_array();
        $data['alluser'] = $this->User_model->getAllUser();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/user', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->addUser();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New user added!</div>');
            redirect('admin/user');
        }
    }

    public function hapus_user($id)
    {
        $this->Admin_model->hapusUser($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/user');
    }

    public function unit()
    {
        $data['title'] = 'Unit';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['unit'] = $this->db->get('tb_unit')->result_array();

        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/unit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->addUnit();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New unit added!</div>');
            redirect('admin/unit');
        }
    }

    public function hapus_unit($id_unit)
    {
        $this->Admin_model->hapusUnit($id_unit);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/unit');
    }

    public function changeStatus($logbook_id)
    {
        // Mengambil data status yang dikirim melalui HTTP POST
        $new_status = $this->input->post('status', true);

        // Memastikan data status yang dikirim adalah valid
        if ($new_status === 'Open' || $new_status === 'Waiting Close') {
            // Memanggil model Logbook_model untuk melakukan pembaruan status
            $this->load->model('Logbook_model');
            $this->Logbook_model->changeStatus($logbook_id, $new_status);

            // Redirect atau tampilkan pesan sukses
            redirect('admin/datauser'); // Ganti 'datauser' dengan URL tujuan yang sesuai
        } else {
            // Status yang dikirim tidak valid, tampilkan pesan kesalahan atau sesuaikan dengan kebutuhan Anda
            echo "Status tidak valid.";
        }
    }

    public function moveLogbook(){
        $logbookId = $this->input->post('logbookId');
        $this->load->model('Logbook_model');
        
        $result = $this->Logbook_model->moveLogbook($logbookId);
        
        echo json_encode(['success' => $result]);
    }

public function export_excel()
{
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Get logbook data
    $logbooks = $this->Logbook_model->getClosedLogbooks($limit, $start, $search = null, $sortCategory = null, $sortService = null, $start_date = '', $end_date = '');

    // Set the column headers
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'No')
        ->setCellValue('B1', 'Created By')
        ->setCellValue('C1', 'Tanggal')
        ->setCellValue('D1', 'Kategori')
        ->setCellValue('E1', 'Layanan')
        ->setCellValue('F1', 'Judul');

    // Set data from the database
    $row = 2;
    $no = 1;
    foreach ($logbooks as $lbu) {
        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $no++)
            ->setCellValue('B' . $row, $lbu['name'])
            ->setCellValue('C' . $row, date('Y-m-d h:i A', strtotime($lbu['tgl'])))
            ->setCellValue('D' . $row, $lbu['kategori'])
            ->setCellValue('E' . $row, $lbu['layanan'])
            ->setCellValue('F' . $row, $lbu['judul']);
        $row++;
    }

    // Set headers for download
    $filename = 'logbook_export_' . date('YmdHis') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Save the Excel file to PHP output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    // Clear the output buffer
    ob_end_clean();

    // Exit the script
    exit;
}

// public function export_excel() {
//     // $this->load->model('Logbook_model');
//     $logbooks = $this->Logbook_model->getClosedLogbooks();

//     try {
//         $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
//         $sheet = $spreadsheet->getActiveSheet(0);
//         $sheet->setCellValue('A1', 'No');
//         $sheet->setCellValue('B1', 'Created By');
//         $sheet->setCellValue('C1', 'Tanggal');
//         $sheet->setCellValue('D1', 'Kategori');
//         $sheet->setCellValue('E1', 'Layanan');
//         $sheet->setCellValue('F1', 'Judul');

//         $row = 2;
//         $no = 1; 

//         foreach ($logbook_list as $log) {
//             $sheet->setCellValue('A' . $row, $no++);
//             $sheet->setCellValue('B' . $row, $lbu['name']);
//             $sheet->setCellValue('C' . $row, date('Y-m-d h:i A', strtotime($lbu['tgl'])));
//             $sheet->setCellValue('D' . $row, $lbu['kategori']);
//             $sheet->setCellValue('E' . $row, $lbu['layanan']);
//             $sheet->setCellValue('F' . $row, $lbu['judul']);
//             $row++;
//             $no++;
//         }

//         // Set header dan menyimpan file Excel
//         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//         header('Content-Disposition: attachment;filename="logbook.xlsx"');
//         header('Cache-Control: max-age=0');
//         $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
//         $writer->save('php://output');
//         exit(); // Ensure script execution ends after saving
//     } catch (Exception $e) {
//         // Handle any exceptions here
//         echo 'Caught exception: ',  $e->getMessage(), "\n";
//     }
// }


}
