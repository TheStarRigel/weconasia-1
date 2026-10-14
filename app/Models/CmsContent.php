<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    protected $table = 'cms_contents';

    protected $fillable = [
        'section_key',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    /**
     * Retrieve content by section key with fallback default array
     */
    public static function getSection(string $key, array $default = []): array
    {
        $record = static::where('section_key', $key)->first();
        if ($record && is_array($record->content)) {
            return array_merge($default, $record->content);
        }
        return $default;
    }

    /**
     * Update or create a section's content
     */
    public static function setSection(string $key, array $content): self
    {
        return static::updateOrCreate(
            ['section_key' => $key],
            ['content' => $content]
        );
    }
}
