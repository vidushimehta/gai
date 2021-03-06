<?php

/**
 * @file
 * Definition of Drupal\field\Tests\BulkDeleteTest.
 */

namespace Drupal\field\Tests;

use Drupal\Core\Entity\ContentEntityDatabaseStorage;
use Drupal\Core\Entity\EntityInterface;
use Drupal\field\Entity\FieldInstanceConfig;

/**
 * Bulk delete fields and instances, and clean up afterwards.
 *
 * @group field
 */
class BulkDeleteTest extends FieldUnitTestBase {

  /**
   * The fields to use in this test.
   *
   * @var array
   */
  protected $fieldStorages;

  /**
   * The entities to use in this test.
   *
   * @var array
   */
  protected $entities;

  /**
   * The entities to use in this test, keyed by bundle.
   *
   * @var array
   */
  protected $entities_by_bundles;

  /**
   * The bundles for the entities used in this test.
   *
   * @var array
   */
  protected $bundles;

  /**
   * The entity type to be used in the test classes.
   *
   * @var array
   */
  protected $entity_type = 'entity_test';

  /**
   * Tests that the expected hooks have been invoked on the expected entities.
   *
   * @param $expected_hooks
   *   An array keyed by hook name, with one entry per expected invocation.
   *   Each entry is the value of the "$entity" parameter the hook is expected
   *   to have been passed.
   * @param $actual_hooks
   *   The array of actual hook invocations recorded by field_test_memorize().
   */
  function checkHooksInvocations($expected_hooks, $actual_hooks) {
    foreach ($expected_hooks as $hook => $invocations) {
      $actual_invocations = $actual_hooks[$hook];

      // Check that the number of invocations is correct.
      $this->assertEqual(count($actual_invocations), count($invocations), "$hook() was called the expected number of times.");

      // Check that the hook was called for each expected argument.
      foreach ($invocations as $argument) {
        $found = FALSE;
        foreach ($actual_invocations as $actual_arguments) {
          // The argument we are looking for is either an array of entities as
          // the second argument or a single entity object as the first.
          if ($argument instanceof EntityInterface && $actual_arguments[0]->id() == $argument->id()) {
            $found = TRUE;
            break;
          }
          // In case of an array, compare the array size and make sure it
          // contains the same elements.
          elseif (is_array($argument) && count($actual_arguments[1]) == count($argument) && count(array_diff_key($actual_arguments[1], $argument)) == 0) {
            $found = TRUE;
            break;
          }
        }
        $this->assertTrue($found, "$hook() was called on expected argument");
      }
    }
  }

  function setUp() {
    parent::setUp();

    $this->fieldStorages = array();
    $this->entities = array();
    $this->entities_by_bundles = array();

    // Create two bundles.
    $this->bundles = array('bb_1' => 'bb_1', 'bb_2' => 'bb_2');
    foreach ($this->bundles as $name => $desc) {
      entity_test_create_bundle($name, $desc);
    }

    // Create two fields.
    $field_storage = entity_create('field_storage_config', array(
      'name' => 'bf_1',
      'entity_type' => $this->entity_type,
      'type' => 'test_field',
      'cardinality' => 1
    ));
    $field_storage->save();
    $this->fieldStorages[] = $field_storage;
    $field_storage = entity_create('field_storage_config', array(
      'name' => 'bf_2',
      'entity_type' => $this->entity_type,
      'type' => 'test_field',
      'cardinality' => 4
    ));
    $field_storage->save();
    $this->fieldStorages[] = $field_storage;

    // For each bundle, create an instance of each field, and 10
    // entities with values for each field.
    foreach ($this->bundles as $bundle) {
      foreach ($this->fieldStorages as $field_storage) {
        entity_create('field_instance_config', array(
          'field_storage' => $field_storage,
          'bundle' => $bundle,
        ))->save();
      }
      for ($i = 0; $i < 10; $i++) {
        $entity = entity_create($this->entity_type, array('type' => $bundle));
        foreach ($this->fieldStorages as $field_storage) {
          $entity->{$field_storage->getName()}->setValue($this->_generateTestFieldValues($field_storage->getCardinality()));
        }
        $entity->save();
      }
    }
    $this->entities = entity_load_multiple($this->entity_type);
    foreach ($this->entities as $entity) {
      // Also keep track of the entities per bundle.
      $this->entities_by_bundles[$entity->bundle()][$entity->id()] = $entity;
    }
  }

  /**
   * Verify that deleting an instance leaves the field data items in
   * the database and that the appropriate Field API functions can
   * operate on the deleted data and instance.
   *
   * This tests how EntityFieldQuery interacts with field instance deletion and
   * could be moved to FieldCrudTestCase, but depends on this class's setUp().
   */
  function testDeleteFieldInstance() {
    $bundle = reset($this->bundles);
    $field_storage = reset($this->fieldStorages);
    $field_name = $field_storage->name;
    $factory = \Drupal::service('entity.query');

    // There are 10 entities of this bundle.
    $found = $factory->get('entity_test')
      ->condition('type', $bundle)
      ->execute();
    $this->assertEqual(count($found), 10, 'Correct number of entities found before deleting');

    // Delete the instance.
    $instance = FieldInstanceConfig::loadByName($this->entity_type, $bundle, $field_storage->name);
    $instance->delete();

    // The instance still exists, deleted.
    $instances = entity_load_multiple_by_properties('field_instance_config', array('field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE));
    $this->assertEqual(count($instances), 1, 'There is one deleted instance');
    $instance = $instances[$instance->uuid()];
    $this->assertEqual($instance->bundle, $bundle, 'The deleted instance is for the correct bundle');

    // Check that the actual stored content did not change during delete.
    $schema = ContentEntityDatabaseStorage::_fieldSqlSchema($field_storage);
    $table = ContentEntityDatabaseStorage::_fieldTableName($field_storage);
    $column = ContentEntityDatabaseStorage::_fieldColumnName($field_storage, 'value');
    $result = db_select($table, 't')
      ->fields('t', array_keys($schema[$table]['fields']))
      ->execute();
    foreach ($result as $row) {
      $this->assertEqual($this->entities[$row->entity_id]->{$field_storage->name}->value, $row->$column);
    }

    // There are 0 entities of this bundle with non-deleted data.
    $found = $factory->get('entity_test')
      ->condition('type', $bundle)
      ->condition("$field_name.deleted", 0)
      ->execute();
    $this->assertFalse($found, 'No entities found after deleting');

    // There are 10 entities of this bundle when deleted fields are allowed, and
    // their values are correct.
    $found = $factory->get('entity_test')
      ->condition('type', $bundle)
      ->condition("$field_name.deleted", 1)
      ->sort('id')
      ->execute();
    $this->assertEqual(count($found), 10, 'Correct number of entities found after deleting');
    $this->assertFalse(array_diff($found, array_keys($this->entities)));
  }

  /**
   * Verify that field data items and instances are purged when an
   * instance is deleted.
   */
  function testPurgeInstance() {
    // Start recording hook invocations.
    field_test_memorize();

    $bundle = reset($this->bundles);
    $field_storage = reset($this->fieldStorages);

    // Delete the instance.
    $instance = FieldInstanceConfig::loadByName($this->entity_type, $bundle, $field_storage->name);
    $instance->delete();

    // No field hooks were called.
    $mem = field_test_memorize();
    $this->assertEqual(count($mem), 0, 'No field hooks were called');

    $batch_size = 2;
    for ($count = 8; $count >= 0; $count -= $batch_size) {
      // Purge two entities.
      field_purge_batch($batch_size);

      // There are $count deleted entities left.
      $found = \Drupal::entityQuery('entity_test')
        ->condition('type', $bundle)
        ->condition($field_storage->name . '.deleted', 1)
        ->execute();
      $this->assertEqual(count($found), $count, 'Correct number of entities found after purging 2');
    }

    // Check hooks invocations.
    // FieldItemInterface::delete() should have been called once for each entity in the
    // bundle.
    $actual_hooks = field_test_memorize();
    $hooks = array();
    $entities = $this->entities_by_bundles[$bundle];
    foreach ($entities as $id => $entity) {
      $hooks['field_test_field_delete'][] = $entity;
    }
    $this->checkHooksInvocations($hooks, $actual_hooks);

    // The instance still exists, deleted.
    $instances = entity_load_multiple_by_properties('field_instance_config', array('field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE));
    $this->assertEqual(count($instances), 1, 'There is one deleted instance');

    // Purge the instance.
    field_purge_batch($batch_size);

    // The instance is gone.
    $instances = entity_load_multiple_by_properties('field_instance_config', array('field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE));
    $this->assertEqual(count($instances), 0, 'The instance is gone');

    // The field storage still exists, not deleted, because it has a second
    // instance.
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
    $this->assertTrue(isset($storages[$field_storage->uuid()]), 'The field storage exists and is not deleted');
  }

  /**
   * Verify that field storages are preserved and purged correctly as multiple
   * instances are deleted and purged.
   */
  function testPurgeFieldStorage() {
    // Start recording hook invocations.
    field_test_memorize();

    $field_storage = reset($this->fieldStorages);

    // Delete the first instance.
    $bundle = reset($this->bundles);
    $instance = FieldInstanceConfig::loadByName($this->entity_type, $bundle, $field_storage->name);
    $instance->delete();

    // Assert that FieldItemInterface::delete() was not called yet.
    $mem = field_test_memorize();
    $this->assertEqual(count($mem), 0, 'No field hooks were called.');

    // Purge the data.
    field_purge_batch(10);

    // Check hooks invocations.
    // FieldItemInterface::delete() should have been called once for each entity in the
    // bundle.
    $actual_hooks = field_test_memorize();
    $hooks = array();
    $entities = $this->entities_by_bundles[$bundle];
    foreach ($entities as $id => $entity) {
      $hooks['field_test_field_delete'][] = $entity;
    }
    $this->checkHooksInvocations($hooks, $actual_hooks);

    // The instance still exists, deleted.
    $instances = entity_load_multiple_by_properties('field_instance_config', array('uuid' => $instance->uuid(), 'include_deleted' => TRUE));
    $this->assertTrue(isset($instances[$instance->uuid()]) && $instances[$instance->uuid()]->deleted, 'The instance exists and is deleted');

    // Purge again to purge the instance.
    field_purge_batch(0);

    // The instance is gone.
    $instances = entity_load_multiple_by_properties('field_instance_config', array('uuid' => $instance->uuid(), 'include_deleted' => TRUE));
    $this->assertEqual(count($instances), 0, 'The instance is purged.');
    // The field storage still exists, not deleted.
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
    $this->assertTrue(isset($storages[$field_storage->uuid()]) && !$storages[$field_storage->uuid()]->deleted, 'The field storage exists and is not deleted');

    // Delete the second instance.
    $bundle = next($this->bundles);
    $instance = FieldInstanceConfig::loadByName($this->entity_type, $bundle, $field_storage->name);
    $instance->delete();

    // Assert that FieldItemInterface::delete() was not called yet.
    $mem = field_test_memorize();
    $this->assertEqual(count($mem), 0, 'No field hooks were called.');

    // Purge the data.
    field_purge_batch(10);

    // Check hooks invocations (same as above, for the 2nd bundle).
    $actual_hooks = field_test_memorize();
    $hooks = array();
    $entities = $this->entities_by_bundles[$bundle];
    foreach ($entities as $id => $entity) {
      $hooks['field_test_field_delete'][] = $entity;
    }
    $this->checkHooksInvocations($hooks, $actual_hooks);

    // The field storage and instance still exist, deleted.
    $instances = entity_load_multiple_by_properties('field_instance_config', array('uuid' => $instance->uuid(), 'include_deleted' => TRUE));
    $this->assertTrue(isset($instances[$instance->uuid()]) && $instances[$instance->uuid()]->deleted, 'The instance exists and is deleted');
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
    $this->assertTrue(isset($storages[$field_storage->uuid()]) && $storages[$field_storage->uuid()]->deleted, 'The field storage exists and is deleted');

    // Purge again to purge the instance and the field storage.
    field_purge_batch(0);

    // The field storage and instance are gone.
    $instances = entity_load_multiple_by_properties('field_instance_config', array('uuid' => $instance->uuid(), 'include_deleted' => TRUE));
    $this->assertEqual(count($instances), 0, 'The instance is purged.');
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
    $this->assertEqual(count($storages), 0, 'The field storage is purged.');
  }

}
