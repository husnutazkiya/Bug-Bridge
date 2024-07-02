<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel_export {

    public function __construct() {
        // Load required CodeIgniter libraries
        $this->ci =& get_instance();
    }

    public function export($data, $filename) {
        // Load PhpSpreadsheet library
        $this->ci->load->library('PhpSpreadsheet');

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        $headers = array_keys($data[0]);
        $sheet->fromArray([$headers], null, 'A1');

        // Add data
        $sheet->fromArray($data, null, 'A2');

        // Save the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
    }
}
