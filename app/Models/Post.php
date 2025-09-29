<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    // Atributos que podem ser preenchidos em massa
    protected $fillable = ['content', 'user_id'];

    /**
     * Relacionamento: o usuário dono do post.
     * Um post pertence a um usuário, definido pela chave estrangeira `user_id`.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento: comentários associados ao post.
     * Um post pode ter vários comentários.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relacionamento: fotos associadas ao post.
     * Um post pode ter várias fotos.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Relacionamento: curtidas associadas ao post.
     * Um post pode receber várias curtidas.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
