<?php

namespace App\Models;

trait ModelTrait
{
    protected function getStatusHtmlAttribute()
    {
        $className = $this->status == 1 ? 'text-green-500 bg-green-100' : 'text-red-500 bg-red-100';
        $text = $this->status == 1 ? 'Active' : 'Inactive';

        return '<span class="font-bold px-2 py-1 ' . $className .'">' . $text . '</span>';
    }

    public function getShortDateAttribute()
    {
        return date(config()->get('custom.date.short'), strtotime($this->created_at));
    }
}
