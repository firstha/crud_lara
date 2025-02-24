<?php

namespace App\Filament\Widgets;

use App\Models\Books;
use Filament\Widgets\ChartWidget;

class PeminjamanChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Peminjaman Buku';

    protected function getType(): string
    {
        return 'line'; 
    }

    protected function getData(): array
    {

        $data = Books::selectRaw('DATE(tanggal) as date, count(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $data->pluck('date')->toArray();
        $total = $data->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peminjaman',
                    'data' => $total,
                    'borderColor' => '#4CAF50', 
                    'fill' => false, 
                ],
            ],
            'labels' => $dates, 
        ];
    }
}
