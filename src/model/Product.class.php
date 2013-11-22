<?php

class Product extends lmbActiveRecord
{
  protected $_default_sort_params = array('title' => 'ASC');

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('description');
    $validator->addRequiredRule('price');
    return $validator;
  }

  function getImagePath()
  {
    if(($image_name = $this->getImageName()) && file_exists(lmb_env_get('PRODUCT_IMAGES_DIR') . $image_name))
      return lmb_env_get('LIMB_HTTP_BASE_PATH') . 'product_images/' . $image_name;
    else
      return lmb_env_get('LIMB_HTTP_BASE_PATH') . '/shared/cms/images/icons/cancel.png';
  }

}