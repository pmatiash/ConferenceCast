<?php

class Boat
{
    private $_passengers = [];

    public function __construct(array $passengers = [])
    {
        $this->passengers = $passengers;
    }

    public function validate()
    {
        try {
            (new HumanBoatValidator($this))->validate();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function setPassengers(array $passengers)
    {
        $this->_passengers = $passengers;
        return $this;
    }

    public function getPassengers()
    {
        return $this->_passengers;
    }
}