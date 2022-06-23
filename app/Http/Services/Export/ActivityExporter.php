<?php

namespace App\Http\Services\Export;

class ActivityExporter extends Exporter
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHeaders(): array
    {
        return [
            __('S.N.'),
            __('User'),
            __('Project'),
            __('Start At'),
            __('End At'),
            __('Total minutes')
        ];
    }

    public function getFileName(): string
    {
        return 'activity' . '-' . date('Y-m-d') . '.csv';
    }

    /**
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function downloadData($data)
    {
        $exportData = [];
        foreach($data as $key => $item) {
            $index = $key + 1;
            $exportData[] = [
                $index,
                $item->user->name,
                $item->project->name,
                $item->start_date_time,
                $item->end_date_time,
                floor($item->total_hours * 60),
            ];
        }

        $this->download($exportData);
    }
}
