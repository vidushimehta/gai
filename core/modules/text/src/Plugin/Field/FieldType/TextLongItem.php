<?php

/**
 * @file
 * Contains \Drupal\text\Plugin\Field\FieldType\TextLongItem.
 */

namespace Drupal\text\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'text_long' field type.
 *
 * @FieldType(
 *   id = "text_long",
 *   label = @Translation("Long text"),
 *   description = @Translation("This field stores long text in the database."),
 *   default_widget = "text_textarea",
 *   default_formatter = "text_default"
 * )
 */
class TextLongItem extends TextItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'text',
          'size' => 'big',
          'not null' => FALSE,
        ),
        'format' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => FALSE,
        ),
      ),
      'indexes' => array(
        'format' => array('format'),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function instanceSettingsForm(array $form, FormStateInterface $form_state) {
    $element = array();

    $element['text_processing'] = array(
      '#type' => 'radios',
      '#title' => t('Text processing'),
      '#default_value' => $this->getSetting('text_processing'),
      '#options' => array(
        t('Plain text'),
        t('Filtered text (user selects text format)'),
      ),
    );

    return $element;
  }

}
