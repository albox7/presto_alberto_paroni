<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Image;
use Spatie\Image\Enums\Unit;


class ResizeImage implements ShouldQueue
{
    use Queueable;

	private $w, $h, $fileName, $path;

	public function __construct($filePath, $w, $h)
	{
		$this->path = dirname($filePath);
		$this->fileName = basename($filePath);
		$this->w = $w;
		$this->h = $h;
	}

	public function handle(): void
	{
		$w = $this->w;
		$h = $this->h;
		$srcPath = storage_path() . '/app/public/' . $this->path . '/' . $this->fileName;
		$destPath = storage_path() . '/app/public/' . $this->path . "/crop_{$w}x{$h}_" . $this->fileName;

		Image::load($srcPath)
			->fit(Fit::Contain, $w, $h)
			->crop($w, $h, CropPosition::Center)
			->watermark(
				base_path('resources/img/watermark.png'),
				width: 40,
				height: 40,
				paddingX: 8,
				paddingY: 8,
				paddingUnit: Unit::Percent
			)
			->save($destPath);
	}

}
