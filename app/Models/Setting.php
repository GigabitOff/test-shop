<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Storage;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\SettingTranslation';
    protected $translationForeignKey = 'setting_id';

    protected $hidden = ['translations'];

    const SETTINGS_TYPE = [
        'string'=>'string',
        'text'=>'text',
        'img'=>'img',
        'file'=>'file',
        'phone'=>'phone',
        'json'=>'json',
        //'category'=>'category',
    ];
    const PHONES_STATUS = [
        'not_logged_in'=>'Not logged in',
        'signed_in_wholesale'=>'Signed in wholesale',
        'retail_is_logged_in'=>'Retail is logged in',
        //'category'=>'category',
    ];

    const PHONES_CATEGORY = [
        //'category_1'=>'Not logged in',
        'category_2'=>'Signed in wholesale',
        //'retail_is_logged_in'=>'Retail is logged in',
        //'category'=>'category',
    ];
    public $translatedAttributes = [
        'url',
        'description',
        'title',
        'img',
        'value_lang',
        'gallery',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'parent_id',
        'page_id',
        'key',
        'category',
        'category_phone',
        'status_phone',
        'display_name',
        'value',
        'details',
        'type',
        'lang',
        'json',
        'order',
    ];

    public function getContuct()
    {
        return $this->hasOne(Contuct::class, 'id', 'category_phone');
    }

    public function getImageFullUrlAttribute(): string
    {
        return ($this->isTypeImage && $this->value)
            ? Storage::disk('public')->url($this->value)
            : '';
    }

    public function getImageLangFullUrlAttribute(): string
    {
        return ($this->isTypeImage && $this->value_lang)
            ? Storage::disk('public')->url($this->value_lang)
            : '';
    }

    public function getIsTypeImageAttribute(): bool
    {
        return $this->type === 'image';
    }
}
