<?php

namespace Src\BoundedContext\Mars\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

final class EloquentRoverModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rovers';
    
    //disable `updated_at`, `created_at` columns
    public $timestamps = false;

    //data columns in table
    protected $fillable = array('direction', 'position_x', 'position_y');

}
