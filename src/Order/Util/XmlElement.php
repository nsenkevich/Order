<?php

namespace Order\Utils;

use SimpleXMLElement;

class XmlElement extends SimpleXMLElement
{
    /**
     * @param string $name
     */
    public function getValue($name)
    {
        return isset($this->$name) && count($this->$name->children()) === 0 
            ? (string) $this->$name : NULL;
    }

}