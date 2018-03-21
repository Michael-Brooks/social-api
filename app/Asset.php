<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
	/**
	 * @var array
	 */
	protected $hidden = ['user_id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function isImage()
	{
		return [
			'image/bmp',
			'image/png',
			'image/jpeg',
		];
	}

	public function isVideo()
	{
		return [
			'video/avi',
			'video/mpeg',
			'video/mp4',
		];
	}

	public function isAudio()
	{
		return [
			'audio/mpeg3'
		];
	}
}