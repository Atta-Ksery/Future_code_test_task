<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile_number',
        'birthday',
        'wallet_value'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function myMarketingPages()
    {
        return $this->hasMany(MarketingPage::class);
    }

    public function blockedMarketingPages()
    {
        return $this->belongsToMany(MarketingPage::class, 'blocked_users');
    }

    public function subscribedMarketingPages()
    {
        return $this->belongsToMany(MarketingPage::class, 'members');
    }

    public function buyerOrders() {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function sellerOrders() {
        return $this->hasMany(Order::class, 'seller_id');
    }

    public function sendedFriendRequests()
    {
        return $this->belongsToMany(User::class, 'sender_id', 'receiver_id')
            ->wherePivot('is_accepted', false);
    }

    public function receivedFriendRequests()
    {
        return $this->belongsToMany(User::class, 'receiver_id', 'sender_id')
            ->wherePivot('is_accepted', false);
    }

    public function myFriends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
            ->orWhere(function ($query) {
                $query->where('receiver_id', $this->id);
            })
            ->wherePivot('is_accepted', true);
    }

    public function sendedFriendInvitations() {
        return $this->belongsToMany(User::class, 'purchase_invitations', 'receiver_id', 'sender_id')
        ->wherePivot('is_accepted', false);
    }

    public function receivedFriendInvitations() {
        return $this->belongsToMany(User::class, 'purchase_invitations', 'sender_id', 'receiver_id')
        ->wherePivot('is_accepted', false);
    }

    public function myInvitations()
    {
        return $this->belongsToMany(User::class, 'purchase_invitations', 'sender_id', 'receiver_id')
            ->orWhere(function ($query) {
                $query->where('receiver_id', $this->id);
            })
            ->wherePivot('is_accepted', true);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('user_photo')
            ->singleFile();
    }
}
