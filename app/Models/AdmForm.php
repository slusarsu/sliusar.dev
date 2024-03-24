<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'to',
        'subject',
        'cc',
        'bcc',
        'is_enabled',
        'send_notify',
        'fields',
        'link_hash',
    ];

    protected $casts = [
        'fields' => 'array',
        'is_enabled' => 'boolean',
        'send_notify' => 'boolean',
        'link_hash' => 'string',
    ];

    public function admFormItems(): HasMany
    {
        return $this->hasMany(AdmFormItem::class, 'adm_form_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fields(): array
    {
        $fields = [];
        foreach($this->fields as $field) {
            $fields[] = $field['field_name'];
        }

        return $fields;
    }
}
