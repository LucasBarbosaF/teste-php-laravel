<?php

namespace App\Models\Categories;

use App\Models\DocumentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name'];


    public function documents()
    {
        return $this->hasMany(DocumentModel::class);
    }
}
