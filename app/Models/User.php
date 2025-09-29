<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Definindo os atributos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_profile',
        'address',
        'whatsapp',
        'instagram',
        'description_profile'
    ];

    // Atributos que devem ser ocultados quando o objeto for convertido para array ou JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Definindo os atributos que serão convertidos para tipos específicos
    protected $casts = [
        'email_verified_at' => 'datetime', // O campo de verificação de e-mail será tratado como um datetime
        'password' => 'hashed', // A senha será automaticamente criptografada
    ];

    /**
     * Relacionamento: um usuário pode ter muitos posts.
     * Este método define a relação com a tabela `posts`.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relacionamento: um usuário pode ter muitos comentários.
     * Este método define a relação com a tabela `comments`.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relacionamento: usuários que seguem o usuário atual.
     * Este método define uma relação de muitos para muitos com a tabela `user_relationships`.
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_relationships', 'followed_id', 'follower_id');
    }

    /**
     * Relacionamento: usuários que o usuário atual está seguindo.
     * Este método define uma relação de muitos para muitos com a tabela `user_relationships`.
     */
    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_relationships', 'follower_id', 'followed_id');
    }

    /**
     * Relacionamento: posts que o usuário curtiu.
     * Este método define uma relação de muitos para muitos com a tabela `likes`.
     */
    public function likedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }
}
