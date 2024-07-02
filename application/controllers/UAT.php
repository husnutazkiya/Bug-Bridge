<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH .'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class UAT extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('UI_model');

    }

    // buglist dev
    public function index()
    {
        $data['title'] = 'Closed Bug Developer';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $kode = $data['user']['kode'];

        $data['log'] = [];
        $data['ready'] = [];
        $data['close'] = [];
        $openCount = 0;
        $readyCount = 0;
        $closeCount = 0;

        if (!empty($kode)) {
            $data['log'] = $this->Logbook_model->getBugclosed($kode);
            $data['ready'] = $this->Admin_model->getBugListReadyByKode($kode);
            $data['close'] = $this->Admin_model->getbuglistcloseByKode($kode);
        }

        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('ClosedBUg/Closedbugdev', $data);
        $this->load->view('templates/footer');
    }


    public function closedbugUI()
    {
        $data['title'] = 'Closed Bug UI/UX';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $kode = $data['user']['kode'];

        $data['log'] = [];
        if (!empty($kode)) {
            $data['log'] = $this->UI_model->getbuglistopenByKode($kode);
        }

        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('ClosedBUg/closedbugui', $data);
        $this->load->view('templates/footer');
    }

    public function export_excel() {
        $nip = $this->session->userdata('nip');
    
        // Panggil model untuk mendapatkan logbook milik pengguna yang sedang login
        $this->load->model('Logbook_model');
        // $logbook_list = $this->Logbook_model->logbook_list_for_user($nip);
    
        try {
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Kategori');
            $sheet->setCellValue('D1', 'Layanan');
            $sheet->setCellValue('E1', 'Judul');
    
            $row = 2;
            $no = 1; 
    
            foreach ($logbook_list as $log) {
                $sheet->setCellValue('A'.$row, $no);
                $sheet->setCellValue('B'.$row, $log->tgl);
                $sheet->setCellValue('C'.$row, $log->kategori);
                $sheet->setCellValue('D'.$row, $log->layanan);
                $sheet->setCellValue('E'.$row, $log->judul);
                $row++;
                $no++;
            }
    
            // Set header dan menyimpan file Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="logbook.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit(); // Ensure script execution ends after saving
        } catch (Exception $e) {
            // Handle any exceptions here
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function exportChecklistExcel() {
        $nip = $this->session->userdata('nip');

        try {
            $checklist_data = $this->Checklist_model->getChecklistExport($nip);

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Shift');
            $sheet->setCellValue('D1', 'HP');
            $sheet->setCellValue('E1', 'PC');
            $sheet->setCellValue('F1', 'Monitoring');
            $sheet->setCellValue('G1', 'AppTools');
            $sheet->setCellValue('H1', 'WebTools');
            $sheet->setCellValue('I1', 'Catatan');

            $row = 2;
            $no = 1;
            foreach ($checklist_data as $checklist) {
                $sheet->setCellValue('A'.$row, $no);
                $sheet->setCellValue('B'.$row, $checklist->tgl);
                $sheet->setCellValue('C'.$row, $checklist->shift);
                $sheet->setCellValue('D'.$row, $checklist->hp);
                $sheet->setCellValue('E'.$row, $checklist->pc);
                $sheet->setCellValue('F'.$row, $checklist->monitoring);
                $sheet->setCellValue('G'.$row, $checklist->apptools);
                $sheet->setCellValue('H'.$row, $checklist->webtools);
                $sheet->setCellValue('I'.$row, $checklist->catatan);
                $row++;
                $no++;
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="checklist.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit(); // Pastikan eksekusi script berhenti setelah menyimpan
        } catch (Exception $e) {
            // Tangani exception jika terjadi
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
    
}
