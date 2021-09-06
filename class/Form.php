<?php
namespace App;
class Form {

  public static $class = "form-control";
  
  /**
   * Gère l'automatisation des checkbox
   *
   * @param  string $name
   * @param  string $value
   * @param  array $data
   * @return string
   */
  public static function checkbox(string $name, string $value = null, array $data = []): string {
    $attributes = '';
    if(isset($data[$name]) && in_array($value, $data[$name])) {
      $attributes .= 'checked';
    }
    $attributes = ' class"' . self::$class . '"';
    return <<<HTML
      <input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTML;
  }
  
  /**
   * Gère l'automatisation des boutons radio
   *
   * @param  string $name
   * @param  string $value
   * @param  array $data
   * @return string
   */
  public static function radio(string $name, string $value, array $data): string {
    $attributes = '';
    if(isset($data[$name]) && $value === $data[$name]) {
      $attributes .= 'checked';
    }
    return <<<HTML
      <input type="radio" name="{$name}" value="$value" $attributes>
HTML;
  }
    
  /**
   * Gère l'automatisation des boutons select
   *
   * @param  string $name
   * @param  mixed $value
   * @param  array $options
   * @return string
   */
  public static function select(string $name, $value, array $options): string {
    foreach($options as $k => $option) {
      $attributes = $k == $value ? ' selected' : '';
      $html_options[] = "<option value='$k' $attributes>$option</option>";
    }
    return "<select class='form-control' name='$name'>" .  implode($html_options) . "</select>";
  }
  
  /**
   * Gère l'automatisation des champs génériques
   *
   * @param  string $name (ex: 'ville')
   * @param  string $value (ex: 'Ville')
   * @param  string $placeholder (ex: 'Paris,fr')
   * @return void
   */
  public static function generic(string $name, string $value, string $placeholder, string $infos = null) {
    $attributes = ' class="' . self::$class . '-sm alert alert-light mx-2 my-0"';
    return <<<HTML
    <div class="d-flex align-items-center mb-2">
      <label for="$name" style="width: 150px;">$value</label>
      <input type="text" 
             id="$name" 
             name="$name"
             value="$placeholder"
             $attributes>
      <p class="ml-2 my-0 text-secondary">$infos</p>
    </div>
HTML;
  }
}