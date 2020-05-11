<?php

namespace App\Listener;

use App\Entity\Property;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber {

/**
 * cacheManager
 *
 * @var mixed
 */
private $cacheManager;

/**
 * uploaderHelper
 *
 * @var mixed
 */
private $uploaderHelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Property) {
            return;
        }
        $this->cacheManager->remove($this->uploaderHelp->asset($entity, 'imageFile'));
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Property) {
            return;
        }
        if ($entity->getImageFile() instanceof UploadedFile) {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }
    }
/**
 * Get cacheManager
 *
 * @return  mixed
 */ 
public function getCacheManager()
{
return $this->cacheManager;
}

/**
 * Set cacheManager
 *
 * @param  mixed  $cacheManager  cacheManager
 *
 * @return  self
 */ 
public function setCacheManager($cacheManager)
{
$this->cacheManager = $cacheManager;

return $this;
}

/**
 * Get uploaderHelper
 *
 * @return  mixed
 */ 
public function getUploaderHelper()
{
return $this->uploaderHelper;
}

/**
 * Set uploaderHelper
 *
 * @param  mixed  $uploaderHelper  uploaderHelper
 *
 * @return  self
 */ 
public function setUploaderHelper($uploaderHelper)
{
$this->uploaderHelper = $uploaderHelper;

return $this;
}
}