<?php

/**
 * Class Transporter:
 */
class Transporter
{
    private $_waitingPassengers = [];

    private $_shippedPassengers = [];

    private $_boat;

    public function __construct($passengers)
    {
        $this->_waitingPassengers = $passengers;
    }

    /**
     * move on a board
     */
    private function boarding()
    {
        try {
            $boat = $this->getBoat();

            if (!$this->_waitingPassengers) {
                exit('Complete');
            }

            $this->_waitingPassengers = array_merge($this->_waitingPassengers, $boat->getPassengers());
            $boat->setPassengers([]);

            // first board 2 children if exists
            $boat->setPassengers($this->getChildrenAndUnset($this->_waitingPassengers, 2));

            // get not child
            if (!$boat->getPassengers()) {
                while (reset($this->_waitingPassengers)->type == Human::TYPE_CHILD) {
                    next($this->_waitingPassengers);
                }

                $boat->setPassengers([current($this->_waitingPassengers)]);
                unset($this->_waitingPassengers[key($this->_waitingPassengers)]);
            }

            // validate
            $boat->validate();

            // move forward
            $this->moveForward();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * move out board
     */
    private function landing()
    {
        try {
            $boat = $this->getBoat();

            $this->_shippedPassengers = array_merge($this->_shippedPassengers, $boat->getPassengers());

            // if all people were shipped move back fisherman
            if (!$this->_waitingPassengers) {
                $boat->setPassengers([$this->getFishermanAndUnset($this->_shippedPassengers)]);

            } else {
                $boat->setPassengers($this->getChildrenAndUnset($this->_shippedPassengers, 1));
            }

            // validate
            $boat->validate();

            // move back
            $this->moveBack();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function moveForward()
    {
        // logger message must be here in future

        echo "Waiting:<br/>";
        var_dump($this->_waitingPassengers);
        echo "<br/>moving forward...<br/>";
        echo "in a boat: <br/>";
        var_dump($this->getBoat()->getPassengers());
        echo "<br/>";
    }

    public function moveBack()
    {
        // logger message must be here in future

        echo "Shipped:<br/>";
        var_dump($this->_shippedPassengers);
        echo "<br/>moving back...<br/>";
        echo "in a boat: <br/>";
        var_dump($this->getBoat()->getPassengers());
        echo "<br/>";
    }

    public function getBoat()
    {
        if (!$this->_boat) {
            $this->_boat = new Boat();
        }

        return $this->_boat;
    }

    public function getChildrenAndUnset(array &$passengers, $limit = 0)
    {
        $children = [];

        foreach ($passengers as $key => $passenger) {
            if ($passenger->type == Human::TYPE_CHILD) {
                $children[$key] = $passenger;
            }
        }

        // limit
        if ($limit) {
            $children = array_slice($children, 0, $limit, true);

            if (count($children) != $limit) {
                return [];
            }
        }

        // unset
        foreach($children as $key => $child) {
            unset($passengers[$key]);
        }

        return $children;
    }

    public function getFishermanAndUnset(array &$passengers)
    {
        $fisherman = [];

        foreach ($passengers as $key => $passenger) {
            if ($passenger->type == Human::TYPE_FISHERMAN) {
                $fisherman = $passenger;
                unset($passengers[$key]);
            }
        }

        return $fisherman;
    }

    /**
     * transport people from side to side
     */
    public function transport()
    {
        while (true) {
            if (count($this->_waitingPassengers) == 1 &&
                reset($this->_waitingPassengers)->type == Human::TYPE_FISHERMAN &&
                reset($this->getBoat()->getPassengers())->type == Human::TYPE_FISHERMAN) {
                break;
            }
            $this->boarding();
            $this->landing();
        }

        echo "Complete";
    }
}