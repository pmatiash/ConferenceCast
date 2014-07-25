<?php

abstract class AbstractHuman
{
    const TYPE_PARENT = 0;
    const TYPE_CHILD = 1;
    const TYPE_FISHERMAN = 2;

    abstract protected function validate();

}