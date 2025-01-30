<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpQuery\PhpQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of ExportExcelController
 *
 * @author aurelien.stride
 */
class ExportExcelController extends AbstractController {

    //put your code here

    private $pq;
    private $colors;
    private $bgColors;
    private $iLogo;
    private $unmerge;
    private $hasRowSpan;

    /**
     * @Route("/export-excel", name="export_excel")
     */
    public function exportTableExcel(Request $request) {

        @unlink('/var/www/capex/var/log/export-excel.log');

        $this->hasRowSpan = false;
        $this->setColorsFromCSS();

        $title = $request->get('title');
        $tableHtml = $request->get('html');
        $this->unmerge = $request->get('unmerge');

        $this->pq = new PhpQuery();
        $this->pq->load_str($tableHtml);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());


        //Header
        $sheet->setCellValue('A1', str_replace(["\n", "\r"], '', $title));
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $q = 'tbody tr';
        if (!count($this->pq->query($q)))
            $q = 'tr';
        if (($nbCols = $this->setNbCols($this->pq->query('thead tr:eq(0) th'))) == 0):
            $nbCols = $this->setNbCols($this->pq->query($q . ':eq(0) td'));
        endif;

        $sheet->getStyle('A1')
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        //Columns
        $iRow = 2;
        $autoFilterStart = 'A3';
        $autoFilterEnd = 'A3';
        $maxColumnNbr = 1;
        foreach ($this->pq->query('thead tr') as $row):
            $iRow++;
            $sheet->getRowDimension($iRow)->setRowHeight(25); //Auto row height?
            $iCol = 1;
            foreach ($this->pq->query('th', $row) as $th):
                $cell = $cell = $this->setColLetter($iCol) . $iRow;
                $c = $sheet->getCell($cell);
                if (!$this->unmerge):
                    while ($this->checkMergedCell($sheet, $c)) {
                        $iCol++;
                        $cell = $this->setColLetter($iCol) . $iRow;
                        $c = $sheet->getCell($cell);
                    }
                else:
                    while ($c->getValue() <> ''):
                        $iCol++;
                        $cell = $this->setColLetter($iCol) . $iRow;
                        $c = $sheet->getCell($cell);
                    endwhile;
                endif;
                $autoFilterEnd = $cell;
                $this->setCell($sheet, $iRow, $iCol, $th, \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);
                $iCol += $this->getNbCols($th);
                if ($iCol > $maxColumnNbr)
                    $maxColumnNbr = $iCol;
                $this->logFile($iRow, 'TH');
                $th = null;
                $c = null;
            endforeach;
            $row = null;
        endforeach;

        //Content
        foreach ($this->pq->query($q) as $row):
            $iRow++;
            $iCol = 1;
            foreach ($this->pq->query('td', $row) as $td):
                $this->logFile($iRow, 'TD');
                $cell = $this->setColLetter($iCol) . $iRow;
                $c = $sheet->getCell($cell);
                if (!$this->unmerge):
                    while ($this->checkMergedCell($sheet, $c)) {
                        $iCol++;
                        $cell = $this->setColLetter($iCol) . $iRow;
                        $c = $sheet->getCell($cell);
                    }
                else:
                    while ($c->getValue() <> ''):
                        $iCol++;
                        $cell = $this->setColLetter($iCol) . $iRow;
                        $c = $sheet->getCell($cell);
                    endwhile;
                endif;
                $this->setCell($sheet, $iRow, $iCol, $td);
                $autoFilterEnd = $cell;
                $iCol += $this->getNbCols($td);
                if ($iCol > $maxColumnNbr)
                    $maxColumnNbr = $iCol;
                $c = null;
                $td = null;
            endforeach;
            $row = null;
        endforeach;

        //Foot
        foreach ($this->pq->query('tfoot tr') as $row):
            $iRow++;
            $iCol = 1;
            foreach ($this->pq->query('td', $row) as $td):
                $cell = $this->setColLetter($iCol) . $iRow;
                $autoFilterEnd = $cell;
                $this->setCell($sheet, $iRow, $iCol, $td);
                $iCol += $this->getNbCols($td);
                if ($iCol > $maxColumnNbr)
                    $maxColumnNbr = $iCol;
                $this->logFile($iRow, 'TF');
                $td = null;
            endforeach;
            $row = null;
        endforeach;

        /*
         * Title merge
         */
        $range = 'A1:' . $this->setColLetter($maxColumnNbr - 1) . '1';
        $sheet->mergeCells($range);

        //$sheet->setAutoFilter($autoFilterStart . ':' . $autoFilterEnd);
        $writer = new Xlsx($spreadsheet);
        $fileName = str_replace(['/', '\\'], '|', $title) . '.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        $writer->save($temp_file);
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    private function logFile($iRow, $cellType) {
//        $dt = \DateTime::createFromFormat('0.u00 U', microtime());
//        file_put_contents('/var/www/capex/var/log/export-excel.log',
//                'ROW ' . $iRow . ' / ' . $cellType . ' : ' .
//                $dt->format('H:i:s:u') .
//                "\n", FILE_APPEND);
    }

    private function checkMergedCell(&$sheet, $cell) {
        if (!$this->hasRowSpan)
            return false;
        foreach ($sheet->getMergeCells() as $cells) {
            if ($cell->isInRange($cells)) {
                $this->logFile(0, 'Check Merged Cells : found');
                // Cell is merged!
                return true;
            }
        }
        $this->logFile(0, 'Check Merged Cells : not found');
        return false;
    }

    /**
     * Colors from CSS
     */
    private function setColorsFromCSS() {
        $css = file_get_contents(__DIR__ . '/../../public/css/main.css');
        $colorsTmp = null;
        $this->colors = [];
        $this->bgColors = [];
        preg_match_all('/\-\-standard-[a-z]*:\ \#[0-9a-fA-F]*/', $css, $colorsTmp);
        foreach ($colorsTmp[0] as $tmp):
            $t = explode(': #', $tmp);
            $this->colors[substr($t[0], 2)] = strtoupper($t[1]);
            $this->bgColors[str_replace('standard-', 'standard-bg-', substr($t[0], 2))] = strtoupper($t[1]);
            $this->bgColors[str_replace('standard-', 'standard-bg-', substr($t[0], 2)) . '-forced'] = strtoupper($t[1]);
        endforeach;
    }

    /**
     * Number of columns, according to colspans
     * @param DOMNodeList $tDom
     * @return type
     */
    private function setNbCols($tDom) {
        $nb = 0;
        foreach ($tDom as $dom):
            $nb += $this->getNbCols($dom);
        endforeach;
        return $nb ?: 1;
    }

    private function getNbRows($td) {
        if ($span = $td->getAttribute('rowspan')):
            return (int) $span;
        else:
            return 1;
        endif;
    }

    private function getNbCols($td) {
        //return 1;
        if ($span = $td->getAttribute('colspan')):
            if (!$this->unmerge)
                return (int) $span;
            else
                return 1;
        else:
            return 1;
        endif;
    }

    /**
     * Merge columns
     * @param type $sheet
     * @param int $row
     * @param int $col
     * @param DOMElement $td
     */
    private function mergeCells(&$sheet, $row, $col, $td) {
        $this->logFile($row, 'Merge Cells');
        $newRow = $row;
        $newCol = $col;
        if (!$this->unmerge):
            if ($span = $td->getAttribute('colspan')):
                $newCol = $col + $span - 1;
            endif;
            if ($span = $td->getAttribute('rowspan')):
                $newRow = $row + $span - 1;
                $this->hasRowSpan = true;
            endif;
            $range = $this->setColLetter($col) . $row . ':' . $this->setColLetter($newCol) . $newRow;
            $sheet->mergeCells($range);
        endif;
    }

    /**
     * Set column letter from integer 
     */
    private function setColLetter($i) {
        if (!$i)
            $i = 1;
        $lettres = '';
        if ($i > 26):
            $j = floor(($i - 1) / 26);
            $lettres .= chr(64 + $j);
            $i = $i - (26 * $j);
        endif;
        if (!$i)
            $i = 1;
        $lettres .= chr(64 + $i);
        return $lettres;
    }

    /**
     * Set all cells parameters & value from DOMElement
     * @param Worksheet $sheet
     * @param type $row
     * @param type $col
     * @param type $td
     */
    private function setCell(&$sheet, $row, $col, $td, $alignV = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP) {
        $cell = $this->setColLetter($col) . $row;

        $raw = rtrim(trim($this->getRecursiveTextContent($td), " _:\t\n\r"), '-');
        $text = str_replace(["\t"], "", $raw);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = utf8_decode(trim($text));


        if (!$text && $input = $this->pq->query('input', $td)[0]):
            $text = $input->getAttribute('placeholder');
        endif;
        if (!$text && $input = $this->pq->query('input', $td)[0]):
            $text = $input->getAttribute('placeholder');
        endif;

        if ($text && strpos($text, "\n") === false && is_numeric(str_replace([' ', ',', '%'], ['', '.', ''], $text)) && count(explode('.', $text)) <= 1):
            $text = (float) str_replace([' ', ',', '%'], ['', '.', ''], $text);
            if (strpos($raw, '%') !== false):
                $text /= 100;
            endif;
        endif;

        if (!$this->unmerge):
            $this->setFrontColorFromClass($sheet, $cell, $td);
            $this->setBackColorFromClass($sheet, $cell, $td);
            $this->mergeCells($sheet, $row, $col, $td);
            $sheet->setCellValue($cell, $text);
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $this->setStyleFromClass($sheet, $cell, $td, $alignV);
        else:
            for ($i = 0; $i < $this->getNbRows($td); $i++):
                $cell = $this->setColLetter($col) . ($row + $i);
                $this->setFrontColorFromClass($sheet, $cell, $td);
                $this->setBackColorFromClass($sheet, $cell, $td);
                $sheet->setCellValue($cell, $text);
                $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                $this->setStyleFromClass($sheet, $cell, $td, $alignV);
            endfor;
        endif;

        if (is_float($text) && strpos($raw, '%') !== false):
            $sheet->getStyle($cell)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);
        elseif (strlen($text) == 10 && substr($text, 4, 1) == '-' && substr($text, 7, 1) == '-'):
            $sheet->getStyle($cell)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
        elseif (strpos($text, "\n") === false):
            $sheet->getStyle($cell)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
        endif;

        //$sheet->getColumnDimension($this->setColLetter($col))->setAutoSize(true);
    }

    private function setFrontColorFromClass(&$sheet, $cell, $td) {
        if (get_class($td) == 'DOMDocument')
            return;
        $classes = explode(' ', trim($td->getAttribute('class')));
        foreach ($classes as $class):
            if (isset($this->colors[$class])):
                $sheet->getStyle($cell)
                        ->getFont()->getColor()->setARGB('FF' . $this->colors[$class]);
            endif;
        endforeach;
        $this->setFrontColorFromClass($sheet, $cell, $td->parentNode);
    }

    private function setBackColorFromClass(&$sheet, $cell, $td) {
        if (get_class($td) == 'DOMDocument')
            return;
        $styles = explode(';', trim($td->getAttribute('style')));
        foreach ($styles as $style):
            $t = explode(':', $style);
            if (trim($t[0]) == 'background-color' && substr(trim($t[1]), 0, 1) == '#'):
                $color = substr(trim($t[1]), 1);
                $sheet->getStyle($cell)
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle($cell)
                        ->getFill()->getStartColor()->setARGB('FF' . $color);
                break;
            endif;
        endforeach;
        $classes = explode(' ', trim($td->getAttribute('class')));
        foreach ($classes as $class):
            if (isset($this->bgColors[$class])):
                $sheet->getStyle($cell)
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle($cell)
                        ->getFill()->getStartColor()->setARGB('FF' . $this->bgColors[$class]);
                break;
            endif;

            switch ($class):
                case 'standard-customer-intimacy-bg-color':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FFa9e64b');
                    break 2;
                case 'standard-operational-excellence-bg-color':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FF184c74');
                    break 2;
                case 'standard-employees-development-bg-color':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FF5eacea');
                    break 2;
                case 'standard-competitive-costs-bg-color':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FF959595');
                    break 2;
                case 'standard-profitable-growth-bg-color':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FF565656');
                    break;
                case 'standard-bg-vertical-gradient-to-red':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
                    $sheet->getStyle($cell)
                            ->getFill()->setRotation(90);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FFFFFFFF');
                    $sheet->getStyle($cell)
                            ->getFill()->getEndColor()->setARGB('FF' . $this->colors['standard-red']);
                    break 2;
                case 'standard-bg-vertical-gradient-to-orange':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
                    $sheet->getStyle($cell)
                            ->getFill()->setRotation(90);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FFFFFFFF');
                    $sheet->getStyle($cell)
                            ->getFill()->getEndColor()->setARGB('FF' . $this->colors['standard-orange']);
                    break 2;
                case 'standard-bg-vertical-gradient-to-green':
                    $sheet->getStyle($cell)
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
                    $sheet->getStyle($cell)
                            ->getFill()->setRotation(90);
                    $sheet->getStyle($cell)
                            ->getFill()->getStartColor()->setARGB('FFFFFFFF');
                    $sheet->getStyle($cell)
                            ->getFill()->getEndColor()->setARGB('FF' . $this->colors['standard-green']);
                    break 2;
            endswitch;
        endforeach;
        $this->setBackColorFromClass($sheet, $cell, $td->parentNode);
    }

    private function setStyleFromClass(&$sheet, $cell, $td, $alignV = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP) {
        if (get_class($td) == 'DOMDocument')
            return;

        $sheet->getStyle($cell)
                ->getAlignment()
                ->setVertical($alignV);
        $sheet->getStyle($cell)
                ->getAlignment()
                ->setWrapText(true);
        $sheet->getStyle($cell)
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_GENERAL);

        $classes = explode(' ', trim($td->getAttribute('class')));
        foreach ($classes as $class):
            switch ($class):
                case 'fw-bold':
                case 'font-weight-bold':
                    $sheet->getStyle($cell)->getFont()->setBold(true);
                    break;
                case 'text-center':
                    $sheet->getStyle($cell)
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    break;
                case 'text-end':
                case 'text-right':
                    $sheet->getStyle($cell)
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                    break;
                case 'text-start':
                case 'text-left':
                    $sheet->getStyle($cell)
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                    break;
                case 'small':
                    $sheet->getStyle($cell)->getFont()->setSize(9);
                    break;
                case 'border-start':
                    $styleArray = [
                        'borders' => [
                            'left' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => 'FF000000'],
                            ],
                        ],
                    ];
                    $sheet->getStyle($cell)->applyFromArray($styleArray);
                    break;
                case 'border-end':
                    $styleArray = [
                        'borders' => [
                            'right' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => 'FF000000'],
                            ],
                        ],
                    ];
                    $sheet->getStyle($cell)->applyFromArray($styleArray);
                    break;
            endswitch;
        endforeach;

        foreach ($td->childNodes as $node):
            switch (strtoupper($node->nodeName)):
                case 'STRONG':
                    $sheet->getStyle($cell)->getFont()->setBold(true);
                    break;
                case 'IMG':
                    if ($this->getNbRows($td) == 1):
                        $this->setRowHeight($sheet, $cell, 36);
                    endif;
                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                    if (!$this->iLogo)
                        $this->iLogo = 0;
                    $this->iLogo++;
                    $drawing->setName('Logo ' . $this->iLogo);
                    $drawing->setDescription('Logo ' . $this->iLogo);
                    $drawing->setPath(__DIR__ . '/../../public' . $node->getAttribute('src'));
                    if (trim($sheet->getCell($cell)->getValue()) == ''):
                        $drawing->setHeight(36);
                        $drawing->setHeight(36 + 15 * ($this->getNbRows($td) - 1));
                    else:
                        $drawing->setWidth(36);
                        $sheet->getStyle($cell)->getAlignment()->setIndent(4);
                    endif;
                    $drawing->setCoordinates($cell);
                    $drawing->setWorksheet($sheet);
                    break;
            endswitch;
        endforeach;
        $this->setStyleFromClass($sheet, $cell, $td->parentNode);
    }

    private function setRowHeight(&$sheet, $cell, $height) {
        $matches = null;
        preg_match_all('!\d+!', $cell, $matches);
        $sheet->getRowDimension((float) $matches[0][0])->setRowHeight($height);
    }

    private function getRecursiveTextContent($dom) {
        $text = '';

        if (strpos($dom->getAttribute('style'), 'display:none') !== false)
            return $text;
        if (strpos($dom->getAttribute('class'), 'no-excel') !== false)
            return $text;
        if (strpos($dom->getAttribute('class'), 'highcharts-container') !== false)
            return $text;

        foreach ($dom->childNodes as $child):
            switch ($child->nodeType) {

                case XML_TEXT_NODE:
                    $text .= ' ' . html_entity_decode($child->nodeValue);
                    break;

                case XML_ELEMENT_NODE:
                    if (strToUpper($child->nodeName) == 'INPUT' && $child->getAttribute('type') != 'hidden'):
                        if (strpos($child->getAttribute('class'), 'col-12') !== false)
                            $text .= "\n\r";
                        $text .= ' ' . $child->getAttribute('value');
                    elseif ($child->nodeName == 'BR'):
                        $text .= "\n";
                    elseif ($child->nodeName == 'HR'):
                        $text .= "\n";
                    else:
                        $text .= ' ' . $this->getRecursiveTextContent($child);
                    endif;
                    break;
            }
        endforeach;
        return trim($text);
    }

}
