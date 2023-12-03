<?php

namespace App\Models;

use App\Models\Traits\CodeTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    # Traits
    use CodeTrait, HasApiTokens, HasFactory, Notifiable;


    # Atributos
    protected $fillable = ['uuid', 'name', 'email', 'password', 'image_path', 'active'];


    # Métodos
    public function setImage(string $path, bool $silent)
    {
        if($silent)
        {
            # Silencioso - Não acionar observer, caso exista.
            return DB::table('users')
                        ->where('id', $this->id)
                        ->update(['image_path' => $path]);
        }
        else
        {
            # Não silencioso - Acionar observer, caso exista.
            return $this->update(['image_path' => $path]);
        }
    }


    # Ocultar Campos
    protected $hidden = ['password', 'remember_token'];


    # Enviar Campos
    protected $casts = ['email_verified_at' => 'datetime'];
}
