<?php
    namespace App\Http\Controllers;


    class StepsController {

        private $all;
        private $count;
        private $curr;

        public function __construct () {

            $this->count = 0;

        }

        public function add ($step) {

            $this->count++;
            $this->all[$this->count] = $step;

        }

        public function setCurrent ($step) {

            reset($this->all);
            for ($i=1; $i<=$this->count; $i++) {
                if ($this->all[$i]==$step) break;
                next($this->all);
            }
            $this->curr = current($this->all);

        }

        public function getCurrent () {

            return $this->curr;

        }

        public function getNext () {

            self::setCurrent($this->curr);
            return next($this->all);

        }

        public function getPrevious () {

            self::setCurrent($this->curr);
            return prev($this->all);
        }

    }

