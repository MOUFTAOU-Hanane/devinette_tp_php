<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $avatar
 * @property Carbon|null $lastdate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $uid
 * @property array|null $friends
 * 
 * @property Collection|Word[] $words
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'lastdate' => 'datetime',
		'friends' => 'json'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'email',
		'password',
		'avatar',
		'lastdate',
		'uid',
		'friends'
	];

	public function words()
	{
		return $this->belongsToMany(Word::class, 'user_words', 'users_id', 'words_id')
					->withPivot('id', 'score', 'response', 'note', 'found_word')
					->withTimestamps();
	}
}
