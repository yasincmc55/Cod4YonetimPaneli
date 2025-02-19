<?php

use App\Models\TranslationModel;

if (!function_exists('translate')) {
    function translate($key, $languageCode = 'tr')
    {
        $translationModel = new TranslationModel();
        $translation = $translationModel->getTranslation($key, $languageCode);

        return $translation ? $translation['value'] : 'Çeviri Bulunamadı';
    }


}


