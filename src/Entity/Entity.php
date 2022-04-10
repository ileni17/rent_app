<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\IdTrait;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Entity
{
    use IdTrait;

    use BlameableEntity {
        getCreatedBy as protected traitCreatedBy;
        getUpdatedBy as protected traitUpdatedBy;
    }

    use TimestampableEntity {
        getCreatedAt as protected traitCreatedAt;
        getUpdatedAt as protected traitUpdatedAt;
    }

    function __construct()
    {

    }

    public function getCreatedBy()
    {
        return $this->traitCreatedBy();
    }

    public function getUpdatedBy()
    {
        return $this->traitUpdatedBy();
    }

    public function getCreatedAt()
    {
        return $this->traitCreatedAt();
    }

    public function getUpdatedAt()
    {
        return $this->traitUpdatedAt();
    }

}

