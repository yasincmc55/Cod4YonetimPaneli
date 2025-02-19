<?php

namespace App\Models;

use CodeIgniter\Model;

class TranslationModel extends Model
{
    protected $table = 'translations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['translatable_id', 'translatable_type', 'key', 'value', 'language_code'];

    // Belirli bir dil için bir kaydın çevirisini getirir
    public function getTranslation($key, $languageCode)
    {
        return $this->where([
            'key' => $key,
            'language_code' => $languageCode
        ])->first();
    }

    // Mevcut bir çeviri olup olmadığını kontrol eder
    public function checkTranslation($translatableId, $translatableType, $key, $languageCode)
    {
        return $this->where([
            'translatable_id' => $translatableId,
            'translatable_type' => $translatableType,
            'key' => $key,
            'language_code' => $languageCode
        ])->first();
    }

    // Çeviriyi güncelle veya ekle
    public function saveTranslation($translatableId, $translatableType, $key, $value, $languageCode)
    {
        // Mevcut bir çeviri kaydı olup olmadığını kontrol et
        $existingTranslation = $this->checkTranslation($translatableId, $translatableType, $key, $languageCode);

        if ($existingTranslation) {
            // Mevcut çeviriyi güncelle
            return $this->updateTranslation($existingTranslation['id'], $value);
        } else {
            // Yeni bir çeviri ekle
            return $this->insert([
                'translatable_id' => $translatableId,
                'translatable_type' => $translatableType,
                'key' => $key,
                'value' => $value,
                'language_code' => $languageCode
            ]);
        }
    }

    public function updateTranslation($id, $value)
    {
        return $this->update($id, [
            'value' => $value
        ]);
    }
}
