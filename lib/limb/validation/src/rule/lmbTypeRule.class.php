<?php
lmb_require('limb/validation/src/rule/lmbSingleFieldRule.class.php');

class lmbTypeRule extends lmbSingleFieldRule
{
  protected $type;

  function __construct($field_name, $type, $custom_error = '{Field} must contain only "{Type}" values')
  {
    $this->type = $type;
    $custom_error = str_replace('{Type}', $type, $custom_error);
    parent::__construct($field_name, $custom_error);
  }

  function check($value)
  {
    try
    {
      lmb_assert_type($value, $this->type);
    }
    catch (lmbInvalidArgumentException $e)
    {
      $this->error($this->custom_error);
    }
  }
}
?>