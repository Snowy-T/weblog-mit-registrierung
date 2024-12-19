<?php

trait Entity
{

    public function __construct($daten = array())
    {
        if ($daten) {
            foreach ($daten as $k => $v) {
                $setterName = 'set' . ucfirst($k);
                if (method_exists($this, $setterName)) {
                    $this->$setterName($v);
                }
            }
        }
    }


    public function toArray($mitId = true): array
    {
        $attribut = get_object_vars($this);
        if (!$mitId) {
            unset($attribut['id']);
        }
        return $attribut;
    }

    public function speichere()
    {
        if ($this->getID() > 0) {
            $this->_update();
        } else {
            $this->_insert();
        }
    }
}
