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

namespace RedKiteLabs\RedKiteCmsBundle\Core\ElFinder;

use RedKiteLabs\RedKiteCmsBundle\Core\ElFinder\Base\ElFinderBaseConnector;

/**
 * Configures the ElFinder library to manage media files, like images, flash, pdf and more
 */
class ElFinderStylesheetsConnector extends ElFinderBaseConnector
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $stylesheetsFolder = $this->container->getParameter('red_kite_cms.deploy_bundle.css_dir') ;

        return $this->generateOptions($stylesheetsFolder, 'Stylesheets');
    }
}
