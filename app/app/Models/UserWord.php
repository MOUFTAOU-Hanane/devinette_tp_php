<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserWord
 * 
 * @property int $id
 * @property int $users_id
 * @property int $words_id
 * @property int $score
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Word $word
 *
 * @package App\Models
 */
class UserWord extends Model
{
	protected $table = 'user_words';

	protected $casts = [
		'users_id' => 'int',
		'words_id' => 'int',
		'score' => 'int'
	];

	protected $fillable = [
		'users_id',
		'words_id',
		'score'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function word()
	{
		return $this->belongsTo(Word::class, 'words_id');
	}
}
