<?php

class HumanBoatValidator
{
    private $_boat;

    public function __construct(Boat $boat) {
        $this->_boat = $boat;
    }

    public function validate() {
        if (count($this->_boat->passengers) > 2) {
            throw new Exception ('The boat is full');

        } elseif(count($this->_boat->passengers) == 2) {
            foreach ($this->_boat->passengers as $passenger) {
                if ($passenger->type !== Human::TYPE_CHILD) {
                    throw new Exception ('Boat can transport only two children');
                }
            }
        }
    }
}