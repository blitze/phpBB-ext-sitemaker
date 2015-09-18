<?php
/**
 *
 * @package primetime
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

interface mapper_interface
{
    public function load(array $condition = array());

    public function find(array $condition = array());

    public function save($entity);

    public function delete($condition);
}
