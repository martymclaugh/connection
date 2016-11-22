<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    // list of friends where id is friend_one_id
    public function myFriends() {
      return $this->belongsToMany(get_class($this), 'friends', 'friend_one_id');
    }

    // list of friends where id is friend_two_id
    public function friendOf() {
      return $this->belongsToMany(get_class($this), 'friends', 'friend_two_id', 'friend_one_id');
    }

    // list of all friends
    public function allFriends() {
      return $this->myFriends->merge($this->friendOf);
    }
    // use '$user->allFriends()' to get list of all friends
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //  add attributes to user array
    protected $fillable = [
        'first_name', 'last_name', 'favorite_color',
    ];
}
