<?php

namespace Drupal\at_core\File;

interface FileOperationsInterface {

  /**
   * Rename old file to new file.
   *
   * @param string $old_file
   *   Source file to be renamed.
   * @param string $new_file
   *   The new file name.
   */
  public function fileRename($old_file, $new_file);

  /**
   * Replace strings in a file.
   *
   * @param $file_path
   *   The file to be processed (haystack).
   * @param $find
   *   The target string (needle).
   * @param $replace
   *   The replacement string.
   */
  public function fileStrReplace($file_path, $find, $replace);

  /**
   * Copy and rename a file.
   *
   * @param array $file_paths
   *   Associative array:
   *    - copy_source => "path to the source file"
   *    - copy_dest => "the destination path"
   *    - rename_oldname => "the old file name"
   *    - rename_newname => "the new file name"
   */
  public function fileCopyRename($file_paths);

  /**
   * Replace old file content with new content.
   *
   * @param string $data
   *   Content to replace old file contents.
   * @param string $file_path
   *   Path to file to be replaced.
   */
  public function fileReplace($data, $file_path);

  /**
   * Generate an .info.yml file that can be parsed by drupal_parse_info_file().
   *
   * @param array $data
   *   The associative array data to build the .info.yml file.
   * @param string $prefix
   *   A string to prefix each entry with, usually spaces for indentation.
   * @return string
   *   A string corresponding to $data in the .yml format.
   *
   * @see drupal_parse_info_file()
   */
  public function fileBuildInfoYml(array $data, $prefix = NULL);

  /**
   * Compare two files. First compare file size, then
   * compare their contents. Return true if the files
   * are the same, otherwise false.
   *
   * @param string $afile
   *   Path to 'a' file.
   * @param string $bfile
   *   Path to 'b' file.
   */
  public function fileCompare($afile, $bfile);

}
