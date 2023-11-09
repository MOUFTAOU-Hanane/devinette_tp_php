<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Word
 * 
 * @property int $id
 * @property string $word
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Word extends Model
{
	protected $table = 'words';

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'word',
		'date'
	];

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_words', 'words_id', 'users_id')
					->withPivot('id', 'score')
					->withTimestamps();
	}
}
