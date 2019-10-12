<?php

namespace CCUPLUS\EloquentORM;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $credit
 * @property integer $department_id
 * @property integer $dimension_id
 * @property Collection|Comment[] $comments
 * @property Department $department
 * @property Dimension|null $dimension
 * @property Collection|Professor[] $professors
 * @property Collection|Semester[] $semesters
 */
final class Course extends Model
{
    use Searchable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 課程評論.
     *
     * @return BelongsToMany
     */
    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'course_comment');
    }

    /**
     * 課程所屬系所.
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * 課程所屬向度（通識課程）.
     *
     * @return BelongsTo
     */
    public function dimension(): BelongsTo
    {
        return $this->belongsTo(Dimension::class);
    }

    /**
     * 課程授課教授.
     *
     * @return BelongsToMany
     */
    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class)
            ->withPivot('semester_id');
    }

    /**
     * 課程授課學期.
     *
     * @return BelongsToMany
     */
    public function semesters(): BelongsToMany
    {
        return $this->belongsToMany(Semester::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'college' => $this->department->college,
            'department' => $this->department->name,
            'dimension' => optional($this->dimension)->name,
            'professors' => $this->professors->pluck('name')->unique()->values()->toArray(),
        ];
    }
}
