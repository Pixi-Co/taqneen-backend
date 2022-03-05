<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Translation extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = "translation";


    protected $fillable = [
        'key',    'language_id',    'business_type_id',    'trans'
    ];


    public function businessType() {
        return $this->belongsTo(BusinessType::class, "business_type_id");
    }
    
    public function language() {
        return $this->belongsTo(Language::class, "language_id");
    }

    public static function getTransFilename($language, $businessType) {
        return "lang/trans_" . $language . "_" . $businessType . ".txt";
    }

    public static function createTransFile($language, $businessType) {
        $filename = self::getTransFilename($language, $businessType);
          
        $translations = Translation::query()
                                        ->where('language_id', $language)
                                        ->where('business_type_id', $businessType)
                                        ->pluck('trans', 'key')
                                        ->toArray();
        
        $content = json_encode($translations);
        file_put_contents($filename, $content);
    }

    public static function trans($key, $language, $businessType) {
        try { 
            $translationJson = file_get_contents(self::getTransFilename($language, $businessType));
            $translations = json_decode($translationJson, true);
            
            return isset($translations[$key])? $translations[$key] : $key;
        } catch (\Exception $th) {
            self::createTransFile($language, $businessType);
            return trans_lang($key);
        }
    }
}
