<?php
// src/AppBundle/Service/DOMPDFShortcut.php
namespace AppBundle\Service;

use DOMPDF;

class DOMPDFShortcut
{
    private $_DOMPDFInstance;

    public function __construct()
    {
        $this->_DOMPDFInstance = new DOMPDF;
    }

    public function generatePdf($htmlTemplate)
    {
        $this->_DOMPDFInstance->load_html($htmlTemplate);
        $this->_DOMPDFInstance->render();

        return $this->_DOMPDFInstance->output();
    }
}