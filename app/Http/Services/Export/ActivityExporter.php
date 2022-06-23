<?php

namespace App\Http\Services\Export;

use App\Http\Services\ActivityService;

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
            __('Total minutes'),
            __('Errors')
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
            $total_hours = '';
            $message = '';
            if ($item->status != 1) {
                $total_hours = ActivityService::formatTotalHours($item->total_hours);
            } else {
                $message = __('No end time');
            }
            $index = $key + 1;
            $exportData[] = [
                $index,
                $item->user->name,
                $item->project->name,
                $item->start_date_time,
                $item->end_date_time,
                $total_hours,
                $message
            ];
        }

        $this->download($exportData);
    }
}
