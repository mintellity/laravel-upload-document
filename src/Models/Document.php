<?php

namespace Mintellity\UploadDocument\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

/**
 * @method static create(string[] $array)
 */
class Document extends Model
{
    use HasUuids;

    protected $keyType = 'string';

    protected $fillable = [
        'model_type',
        'model_id'  ,
        'collection_name',
        'name' ,
        'file_name',
        'mime_type',
        'size'
    ];

    /**
     * Snake case the primary key name.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        //Replace primaryKeyName = (classname)_id
        $this->primaryKey = Str::snake(class_basename(static::class)).'_id';
    }

    /**
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
