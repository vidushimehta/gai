<?php

/**
 * @file
 * Contains \Drupal\database_test\Form\DatabaseTestForm.
 */

namespace Drupal\database_test\Form;

use Drupal\Component\Utility\String;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for database_test module.
 */
class DatabaseTestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'database_test_theme_tablesort';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $header = array(
      'username' => array('data' => t('Username'), 'field' => 'u.name'),
      'status' => array('data' => t('Status'), 'field' => 'u.status'),
    );

    $query = db_select('users', 'u');
    $query->condition('u.uid', 0, '<>');

    $count_query = clone $query;
    $count_query->addExpression('COUNT(u.uid)');

    $query = $query
      ->extend('Drupal\Core\Database\Query\PagerSelectExtender')
      ->extend('Drupal\Core\Database\Query\TableSortExtender');
    $query
      ->fields('u', array('uid'))
      ->limit(50)
      ->orderByHeader($header)
      ->setCountQuery($count_query);
    $uids = $query
      ->execute()
      ->fetchCol();

    $options = array();

    foreach (user_load_multiple($uids) as $account) {
      $options[$account->id()] = array(
        'title' => array('data' => array('#title' => String::checkPlain($account->getUsername()))),
        'username' => String::checkPlain($account->getUsername()),
        'status' =>  $account->isActive() ? t('active') : t('blocked'),
      );
    }

    $form['accounts'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => t('No people available.'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
