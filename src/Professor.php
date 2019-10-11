<?php

namespace CCUPLUS\EloquentORM;

/**
 * @property integer $id
 * @property string $name
 */
final class Professor extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
