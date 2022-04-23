<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $name
 * @property int $section_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Section $section
 * @method static \Database\Factories\LessonFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $description
 * @property int $status
 * @property mixed|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson withRichText($fields = [])
 */
class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'content',
    ];

    protected $casts = [
        'content' => AsRichTextContent::class,
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function kcls(): HasMany
    {
        return $this->hasMany(KCL::class, 'lesson_id');
    }

    public function kcs(): BelongsToMany
    {
        return $this->belongsToMany(
            Kc::class,
            KCL::class,
            'lesson_id',
            'kc_id',
        );
    }
}
