<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\LanguageModel;

class LanguageController extends BaseController{
  public function language_save(){
    $lang = new LanguageModel();

    $name = $this->request->getPost('name');
    $lang_code = $this->request->getPost('lang_code');

    if(empty($name) || empty($lang_code)){
      return $this->response->setJSON([
        'status'=>'error',
        'message'=>'Name Or lang code cant be NULL'
      ]);
    }

    if($lang->insert(['name'=>$name , 'code'=>$lang_code])){
      return $this->response->setJSON([
        'status'=>'success',
        'message'=>'Language saved successfully.'
      ]);
    }else{
      return $this->response->setJSON([
        'status'=>'error',
        'message'=>'Failed to save language'
      ]);
    }


  }
}
