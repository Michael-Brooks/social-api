<?php

namespace App\Jobs;

class ProcessAsset extends Job
{
	protected $filePath;
	protected $fileName;

	/**
	 * ProcessAsset constructor.
	 *
	 * @param $filePath
	 * @param $fileName
	 */
	public function __construct( $filePath, $fileName )
	{
		$this->filePath = __DIR__ . '/../../../storage/app/videos';
		$this->fileName = $fileName;
	}

	/**
	 * * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		//
	}
}