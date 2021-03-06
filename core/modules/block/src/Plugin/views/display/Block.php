<?php

/**
 * @file
 * Definition of Drupal\views\Plugin\views\display\Block.
 * Definition of Drupal\block\Plugin\views\display\Block.
 */

namespace Drupal\block\Plugin\views\display;

use Drupal\Component\Utility\String;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\Block\ViewsBlock;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Views;

/**
 * The plugin that handles a block.
 *
 * @ingroup views_display_plugins
 *
 * @ViewsDisplay(
 *   id = "block",
 *   title = @Translation("Block"),
 *   help = @Translation("Display the view as a block."),
 *   theme = "views_view",
 *   register_theme = FALSE,
 *   uses_hook_block = TRUE,
 *   contextual_links_locations = {"block"},
 *   admin = @Translation("Block")
 * )
 *
 * @see \Drupal\views\Plugin\block\block\ViewsBlock
 * @see \Drupal\views\Plugin\Derivative\ViewsBlock
 */
class Block extends DisplayPluginBase {

  /**
   * Whether the display allows attachments.
   *
   * @var bool
   */
  protected $usesAttachments = TRUE;

  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['block_description'] = array('default' => '', 'translatable' => TRUE);
    $options['block_category'] = array('default' => 'Lists (Views)', 'translatable' => TRUE);
    $options['block_hide_empty'] = array('default' => FALSE);

    $options['allow'] = array(
      'contains' => array(
        'items_per_page' => array('default' => 'items_per_page'),
      ),
    );

    return $options;
  }

  /**
   * Returns plugin-specific settings for the block.
   *
   * @param array $settings
   *   The settings of the block.
   *
   * @return array
   *   An array of block-specific settings to override the defaults provided in
   *   \Drupal\views\Plugin\Block\ViewsBlock::defaultConfiguration().
   *
   * @see \Drupal\views\Plugin\Block\ViewsBlock::defaultConfiguration()
   */
  public function blockSettings(array $settings) {
    $settings['items_per_page'] = 'none';
    return $settings;
  }

  /**
   * The display block handler returns the structure necessary for a block.
   */
  public function execute() {
    // Prior to this being called, the $view should already be set to this
    // display, and arguments should be set on the view.
    $element = $this->view->render();
    if ($this->outputIsEmpty() && $this->getOption('block_hide_empty') && empty($this->view->style_plugin->definition['even empty'])) {
      return array();
    }
    else {
      return $element;
    }
  }

  /**
   * Provide the summary for page options in the views UI.
   *
   * This output is returned as an array.
   */
  public function optionsSummary(&$categories, &$options) {
    parent::optionsSummary($categories, $options);

    $categories['block'] = array(
      'title' => t('Block settings'),
      'column' => 'second',
      'build' => array(
        '#weight' => -10,
      ),
    );

    $block_description = strip_tags($this->getOption('block_description'));
    if (empty($block_description)) {
      $block_description = t('None');
    }
    $block_category = String::checkPlain($this->getOption('block_category'));

    $options['block_description'] = array(
      'category' => 'block',
      'title' => t('Block name'),
      'value' => views_ui_truncate($block_description, 24),
    );
    $options['block_category'] = array(
      'category' => 'block',
      'title' => t('Block category'),
      'value' => views_ui_truncate($block_category, 24),
    );

    $filtered_allow = array_filter($this->getOption('allow'));

    $options['allow'] = array(
      'category' => 'block',
      'title' => t('Allow settings'),
      'value' => empty($filtered_allow) ? t('None') : t('Items per page'),
    );

    $options['block_hide_empty'] = array(
      'category' => 'other',
      'title' => t('Hide block if the view output is empty'),
      'value' => $this->getOption('block_hide_empty') ? t('Hide') : t('Show'),
    );
  }

  /**
   * Provide the default form for setting options.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    switch ($form_state['section']) {
      case 'block_description':
        $form['#title'] .= t('Block admin description');
        $form['block_description'] = array(
          '#type' => 'textfield',
          '#description' => t('This will appear as the name of this block in administer >> structure >> blocks.'),
          '#default_value' => $this->getOption('block_description'),
        );
        break;
      case 'block_category':
        $form['#title'] .= t('Block category');
        $form['block_category'] = array(
          '#type' => 'textfield',
          '#autocomplete_route_name' => 'block.category_autocomplete',
          '#description' => t('The category this block will appear under on the <a href="@href">blocks placement page</a>.', array('@href' => url('admin/structure/block'))),
          '#default_value' => $this->getOption('block_category'),
        );
        break;
      case 'block_hide_empty':
        $form['#title'] .= t('Block empty settings');

        $form['block_hide_empty'] = array(
          '#title' => t('Hide block if no result/empty text'),
          '#type' => 'checkbox',
          '#description' => t('Hide the block if there is no result and no empty text and no header/footer which is shown on empty result'),
          '#default_value' => $this->getOption('block_hide_empty'),
        );
        break;
      case 'exposed_form_options':
        $this->view->initHandlers();
        if (!$this->usesExposed() && parent::usesExposed()) {
          $form['exposed_form_options']['warning'] = array(
            '#weight' => -10,
            '#markup' => '<div class="messages messages--warning">' . t('Exposed filters in block displays require "Use AJAX" to be set to work correctly.') . '</div>',
          );
        }
        break;
      case 'allow':
        $form['#title'] .= t('Allow settings in the block configuration');

        $options = array(
          'items_per_page' => t('Items per page'),
        );

        $allow = array_filter($this->getOption('allow'));
        $form['allow'] = array(
          '#type' => 'checkboxes',
          '#default_value' => $allow,
          '#options' => $options,
        );
        break;
    }
  }

  /**
   * Perform any necessary changes to the form values prior to storage.
   * There is no need for this function to actually store the data.
   */
  public function submitOptionsForm(&$form, FormStateInterface $form_state) {
    parent::submitOptionsForm($form, $form_state);
    switch ($form_state['section']) {
      case 'block_description':
      case 'block_category':
      case 'allow':
      case 'block_hide_empty':
        $this->setOption($form_state['section'], $form_state['values'][$form_state['section']]);
        break;
    }
  }

  /**
   * Adds the configuration form elements specific to this views block plugin.
   *
   * This method allows block instances to override the views items_per_page.
   *
   * @param \Drupal\views\Plugin\Block\ViewsBlock $block
   *   The ViewsBlock plugin.
   * @param array $form
   *   The form definition array for the block configuration form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array $form
   *   The renderable form array representing the entire configuration form.
   *
   * @see \Drupal\views\Plugin\Block\ViewsBlock::blockForm()
   */
  public function blockForm(ViewsBlock $block, array &$form, FormStateInterface $form_state) {
    $allow_settings = array_filter($this->getOption('allow'));

    $block_configuration = $block->getConfiguration();

    foreach ($allow_settings as $type => $enabled) {
      if (empty($enabled)) {
        continue;
      }
      switch ($type) {
        case 'items_per_page':
          $form['override']['items_per_page'] = array(
            '#type' => 'select',
            '#title' => t('Items per block'),
            '#options' => array(
              'none' => t('@count (default setting)', array('@count' => $this->getPlugin('pager')->getItemsPerPage())),
              5 => 5,
              10 => 10,
              20 => 20,
              40 => 40,
            ),
            '#default_value' => $block_configuration['items_per_page'],
          );
          break;
      }
    }

    return $form;
  }

  /**
   * Handles form validation for the views block configuration form.
   *
   * @param \Drupal\views\Plugin\Block\ViewsBlock $block
   *   The ViewsBlock plugin.
   * @param array $form
   *   The form definition array for the block configuration form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @see \Drupal\views\Plugin\Block\ViewsBlock::blockValidate()
   */
  public function blockValidate(ViewsBlock $block, array $form, FormStateInterface $form_state) {
  }

  /**
   * Handles form submission for the views block configuration form.
   *
   * @param \Drupal\views\Plugin\Block\ViewsBlock $block
   *   The ViewsBlock plugin.
   * @param array $form
   *   The form definition array for the full block configuration form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * * @see \Drupal\views\Plugin\Block\ViewsBlock::blockSubmit()
   */
  public function blockSubmit(ViewsBlock $block, $form, FormStateInterface $form_state) {
    if (isset($form_state['values']['override']['items_per_page'])) {
      $block->setConfigurationValue('items_per_page', $form_state['values']['override']['items_per_page']);
    }
  }

  /**
   * Allows to change the display settings right before executing the block.
   *
   * @param \Drupal\views\Plugin\Block\ViewsBlock $block
   *   The block plugin for views displays.
   */
  public function preBlockBuild(ViewsBlock $block) {
    $config = $block->getConfiguration();
    if ($config['items_per_page'] !== 'none') {
      $this->view->setItemsPerPage($config['items_per_page']);
    }
  }

  /**
   * Block views use exposed widgets only if AJAX is set.
   */
  public function usesExposed() {
      if ($this->ajaxEnabled()) {
        return parent::usesExposed();
      }
      return FALSE;
    }

  /**
   * Overrides \Drupal\views\Plugin\views\display\DisplayPluginBase::remove().
   */
  public function remove() {
    parent::remove();

    $plugin_id = 'views_block:' . $this->view->storage->id() . '-' . $this->display['id'];
    foreach (entity_load_multiple_by_properties('block', array('plugin' => $plugin_id)) as $block) {
      $block->delete();
    }
  }

}
