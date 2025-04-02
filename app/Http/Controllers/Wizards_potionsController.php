<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wizards_potions extends Model
{
    use HasFactory;

    protected $table = 'wizards_potions';
    public $timestamps = false;

    protected $fillable = ['wizard_id', 'potion_id', 'date_brewed'];

    public function getAll()
    {
        return self::all();
    }
}
