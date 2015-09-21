<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Try increasing memory available, mostly for PDF generation
     */
    ini_set("memory_limit", "32M");

    function pdf_create($html, $filename, $stream=TRUE, $orientation="portrait") {
        require_once(APPATH . "application/libraries/dompdf/dompdf_config.inc.php");

        $dompdf = new DOMPDF();
        $dompdf->set_paper("a4", $orientation);
        $dompdf->load_html($html);
        $dompdf->render();
        if ($stream) { //open only
            $dompdf->stream($filename . ".pdf");
        } else { // save to file only, your going to load the file helper for this one
            write_file("pdf/$filename.pdf", $dompdf->output());
        }
    }

?>