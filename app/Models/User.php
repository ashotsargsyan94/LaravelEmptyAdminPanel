<?php

namespace App\Models;

use App\Notifications\RegisteredNotification;
use App\Notifications\ResetAdminPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use App\Services\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'phone', 'verification'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function checkAdmin($email, $password) {
        $user = self::getAdmin($email);
        if (!$user || !Hash::check($password, $user->password)) return false;
        return $user;
    }

    public static function getAdmin($email) {
        $user = self::where('email', $email)->where('admin', '>', 0)->first();
        if ($user===null) return false;
        return $user;
    }

    public static function getUsers(){
        return self::where('admin', 0)->sort()->get();
    }


    public static function getUser($email) {
        return User::where(['email'=>$email, 'admin'=>0])->first();
    }

    public static function checkRecoverToken($email, $token){
        $result = DB::table('password_resets')->select('token')->where('email', $email)->first();
        if (!$result) return false;
        return Hash::check($token, $result->token);
    }

    public static function action($user, $inputs){
        $user['name'] = $inputs['name'];
        $user['email'] = $inputs['email'];
        if (!empty($inputs['change_password'])) {
            $user['password'] = Hash::make($inputs['new_password']);
        }
        $result = $user->save();
        Auth::login($user);
        return $result;
    }

    public static function recoverPassword($email, $password){
        $user = self::where('email', $email)->first();
        return self::recoverUserPassword($user, $password);
    }

    public static function recoverUserPassword($user, $password) {
        DB::table('password_resets')->where('email', $user->email)->delete();
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        if (!empty($user->verification)) $user->verification = null;
        $user->save();
//        event(new PasswordReset($user));
        return $user;
    }

    public function isAdmin(){
        return $this->admin > 0;
    }

    public function sendPasswordResetNotification($token)
    {
        if ($this->isAdmin()) {
            try {
                $this->notify(new ResetAdminPasswordNotification($token, $this->email));
            } catch (\Exception $e) {}
        }
        else {
            try {
                $this->notify(new ResetPasswordNotification($token, $this->email));
            } catch (\Exception $e) {}
        }
    }

    public function sendRegisteredNotification($token) {
        try {
            $this->notify(new RegisteredNotification($this->email, $token));
        } catch (\Exception $e) {}
    }

    public function isVerified(){
        return (empty($this->verification) || $this->admin>0);
    }


    private static $auth = null;

    public static function auth(){
        if (self::$auth===null) {
            $user = Auth::user();
            if (!$user) {
                self::$auth = false;
            }
            else if (!$user->isVerified()) {
                Auth::logout();
                self::$auth = false;
            }
            else if ($user->active==0) {
                Auth::logout();
                self::$auth = false;
            }
            else self::$auth = $user;
        }
        return self::$auth;
    }

    public function scopeSort($q){
        return $q->orderBy('id','asc');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order', 'user_id', 'id')->sort();
    }
}
