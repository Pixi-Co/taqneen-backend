<?php

namespace Modules\Subscription\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TrainerRate extends Model
{
    protected $table = "sub_trainer_rate";

    protected $fillable = [
        'trainer_id', 'ip', 'rate', 'date', 'comment', 'user'
    ]; 
     
    public function trainer() {
        return $this->belongsTo(Trainer::class, "trainer_id");
    }

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }



}
