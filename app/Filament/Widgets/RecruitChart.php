<?php

namespace App\Filament\Widgets;

use App\Models\Recruit;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class RecruitChart extends ChartWidget
{
	protected static ?string $heading = 'Chart';



	protected function getData(): array
	{
		$data = Trend::model(Recruit::class)
			->between(
				start: now()->startOfYear(),
				end: now()->endOfYear(),
			)
			->perMonth()
			->count();

		return [
			'datasets' => [
				[
					'label' => 'Recruit created',
					'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
				],
			],
			'labels' => $data->map(fn (TrendValue $value) => $value->date),
		];
	}

	protected function getType(): string
	{
		return 'line';
	}
}
