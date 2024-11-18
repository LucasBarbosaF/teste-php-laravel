<?php

namespace App\Models\Documents;

use App\Models\Categories\CategoryModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $fillable = ['title', 'contents', 'category_id'];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }
}
