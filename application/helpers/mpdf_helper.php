<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('create_pdf')) {

        function pdf_create($html_data, $file_name = "") {
            ini_set("memory_limit","1000M");
            

            require 'mpdf/mpdf.php';
            //$mypdf = new mPDF("a4");
            $mypdf = new mPDF('', 'A4', '', '', '18', '12', '12', '12', '', '5');
           // ('', 'A4', '', '', $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer)
            
            $footer = "<hr><div style='font-size:7pt;' align='center'>Head Office : Jl Terusan Buah Batu No. 12 Bandung  Telp +62-22-88884388  Fax +62-22-88884422</div>";
            $mypdf->SetHTMLFooter($footer);

            $stylesheet = file_get_contents(base_url().'assets/css/style-surat.css');
            $mypdf->WriteHTML($stylesheet, 1);

            $mypdf->WriteHTML($html_data);
           // $mypdf->Output($file_name . '.pdf', 'D');

            $new_filename = str_replace("/", "_", $file_name);

            $file_to_save = FCPATH . 'assets/surat_acara/' . $new_filename . '.pdf';

            $mypdf->Output($file_to_save, 'F');

        }

    }