<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    use HasFactory;

    public function reachesHalfIncomingQuantity(): bool
    {
        return ($this->outcoming_quantity/$this->incoming_quantity * 100) >= 50;
    }

    public function recordNotification(): void
    {
        $this->merchant_notified_at= now();
        $this->save();
    }
    public function merchantHasRecentlyNotified(): bool
    {
        return !is_null($this->merchant_notified_at);
    }
}
