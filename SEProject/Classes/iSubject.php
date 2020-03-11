<?php

    interface iSubject
    {
        public function registerObserver($user);
        public function removeObserver($user);
        public function notifyObservers($ID);
    }

?>