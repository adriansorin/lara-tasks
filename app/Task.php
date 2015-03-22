<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	protected $fillable = ['name', 'description', 'due_date', 'status'];


	public function user()
    {
        return $this->hasOne('App\UserTask');
    }

}
