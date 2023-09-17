<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $guarded = [];


    public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}


    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class,'buku_id','id');
    }
}
