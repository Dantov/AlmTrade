<?php
static::$style .= '
    .' . static::$className . ' {
    display:inline-block;
    position: relative;
    width: '. $this->width .'px;
	height: '. $this->height .'px;
	background: url(\''. $this->path .'\') 0 0 no-repeat;
	background-size: contain;
    background-position: center;
	}';

echo "<$this->wrapp $this->link $this->class $style ></$this->wrapp>";