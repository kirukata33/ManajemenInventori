<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper untuk merekam log aktivitas dengan mudah
     * 
     * @param string $action
     * @param string $description
     */
    public static function record($action, $description = null)
    {
        return self::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description
        ]);
    }
}
