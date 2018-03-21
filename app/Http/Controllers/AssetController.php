<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessAsset;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Asset;

class AssetController
{
	use Helpers;

	public function upload( Request $request )
	{
		$file = $request->file( 'file' );
		if ( $file->isValid() ) {
			$mimeType = $file->getClientMimeType();
			$assets   = new Asset();
			$fileName = uniqid( $file->getClientSize() );
			if ( in_array( $mimeType, $assets->isImage() ) ) {
				// Start image conversion
				$directory = __DIR__ . '/../../../storage/app/images';

				$fullFileName = $fileName . '.' . $file->getClientOriginalExtension();
				$file->move( $directory, $fullFileName );

				$s3 = \AWS::createClient('s3');
				$s3->putObject([
					'Bucket'        => 'socialmike',
					'Key'           => $fullFileName,
					'SourceFile'    => $directory . '/' . $fullFileName
				]);
			}
			if ( in_array( $mimeType, $assets->isVideo() ) ) {
				$filePath = __DIR__ . '/../../../storage/app/videos';
				$file->move( $filePath, $fileName . '.' . $file->getClientOriginalExtension() );

			}
			if ( in_array( $mimeType, $assets->isAudio() ) ) {
				// Start audio conversion
			}
		}
	}
}