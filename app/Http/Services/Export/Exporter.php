<?php

namespace App\Http\Services\Export;

use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

abstract class Exporter
{
    public function __construct()
    {
    }

    abstract public function getHeaders();
    abstract public function getFileName();

    private function createCell($data): array
    {
        $cells = [];
        foreach ($data as $cell) {
            $cells[] = WriterEntityFactory::createCell($cell);
        }
        return $cells;
    }

    private function createRow($data): Row
    {
        $cells = $this->createCell($data);
        return WriterEntityFactory::createRow($cells);
    }

    /**
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function download($data): void
    {
        $fileName = $this->getFileName();
        $headers = $this->getHeaders();

        $writer = WriterEntityFactory::createCSVWriter();
        $writer->openToBrowser($fileName);
        $row = $this->createRow($headers);
        $writer->addRow($row);

        foreach ($data as $item) {
            $row = $this->createRow($item);
            $writer->addRow($row);
        }

        $writer->close();
    }
}
