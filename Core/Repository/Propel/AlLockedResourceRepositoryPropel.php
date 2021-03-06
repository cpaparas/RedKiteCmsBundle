<?php
/**
 * This file is part of the RedKiteCmsBunde Application and it is distributed
 * under the GPL LICENSE Version 2.0. To use this application you must leave
 * intact this copyright notice.
 *
 * Copyright (c) RedKite Labs <webmaster@redkite-labs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For extra documentation and help please visit http://www.redkite-labs.com
 *
 * @license    GPL LICENSE Version 2.0
 *
 */

namespace RedKiteLabs\RedKiteCmsBundle\Core\Repository\Propel;

use RedKiteLabs\RedKiteCmsBundle\Model\AlLockedResource;
use RedKiteLabs\RedKiteCmsBundle\Model\AlLockedResourceQuery;
use RedKiteLabs\RedKiteCmsBundle\Core\Repository\Repository\LockedResourceRepositoryInterface;
use RedKiteLabs\RedKiteCmsBundle\Core\Exception\Content\General\InvalidArgumentTypeException;

/**
 *  Implements the UserRepositoryInterface to work with Propel
 *
 *  @author RedKite Labs <webmaster@redkite-labs.com>
 */
class AlLockedResourceRepositoryPropel extends Base\AlPropelRepository implements LockedResourceRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRepositoryObjectClassName()
    {
        return '\RedKiteLabs\RedKiteCmsBundle\Model\AlLockedResource';
    }

    /**
     * {@inheritdoc}
     */
    public function setRepositoryObject($object = null)
    {
        if (null !== $object && !$object instanceof AlLockedResource) {
            throw new InvalidArgumentTypeException('exception_only_propel_locked_resource_objects_are_accepted');
        }

        return parent::setRepositoryObject($object);
    }

    /**
     * {@inheritdoc}
     */
    public function fromResourceName($resource)
    {
       return AlLockedResourceQuery::create()
                              ->filterByResourceName($resource)
                              ->findOne();
    }

    /**
     * {@inheritdoc}
     */
    public function fromResourceNameByUser($userId, $resource)
    {
        return AlLockedResourceQuery::create()
                               ->filterByUserId($userId)
                               ->filterByResourceName($resource)
                               ->findOne();
    }

    /**
     * {@inheritdoc}
     */
    public function freeLockedResource($resource)
    {
        return AlLockedResourceQuery::create()
                                    ->filterByResourceName($resource)
                                    ->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function removeExpiredResources($expiredTime)
    {
        return AlLockedResourceQuery::create('a')
                                    ->where('a.UpdatedAt <= ?', $expiredTime)
                                    ->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function freeUserResource($userId)
    {
        return AlLockedResourceQuery::create()
                                    ->filterByUserId($userId)
                                    ->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function fetchResources($userId = null)
    {
        return AlLockedResourceQuery::create()
                                    ->_if($userId)
                                        ->filterBySlotName($userId)
                                    ->_endif()
                                    ->find();
    }
}
