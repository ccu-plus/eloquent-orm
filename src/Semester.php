<?php

namespace CCUPLUS\EloquentORM;

use Illuminate\Support\Str;

/**
 * @property integer $id
 * @property string $name
 * @property string|null $value
 */
final class Semester extends Model
{
    /**
     * 取得學期數字型態之值.
     *
     * @return string|null
     */
    public function getValueAttribute(): ?string
    {
        if (!$this->exists) {
            return null;
        }

        return sprintf(
            '%s%d',
            mb_substr($this->name, 0, 3),
            Str::endsWith($this->name, '上') ? 1 : 2
        );
    }

    /**
     * 取得最新學期 Eloquent Model.
     *
     * @return Semester
     */
    public static function newest(): Semester
    {
        $cmp = function (Semester $a, Semester $b) {
            $spaceship = intval($a->name) <=> intval($b->name);

            if ($spaceship !== 0) {
                return $spaceship;
            }

            return Str::endsWith($a->name, '上') ? -1 : 1;
        };

        return static::all()->sort($cmp)->last();
    }
}
