<?php

/**
 * Class Human: Father, mother, children, fisherman
 */
class Human extends AbstractHuman
{
    public $type;

    public $name;

    /**
     * @param $name
     * @param $type
     */
    public function __construct($name, $type)
    {
        $this->type = $type;
        $this->name = $name;

        $this->validate();
    }

    protected function validate()
    {
        if (!in_array($this->type , [self::TYPE_PARENT, self::TYPE_CHILD, self::TYPE_FISHERMAN])) {
            throw new Exception ('Unknown human type');
        }
    }
}