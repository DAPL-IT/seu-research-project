<?php

namespace App\Traits;

trait WebAlertTrait{
    protected function successAlert($message){
        return ['type'=> 'success', 'message'=>$message];
    }

    protected function warningAlert($message){
        return ['type'=> 'warning', 'message'=>$message];
    }

    protected function infoAlert($message){
        return ['type'=> 'info', 'message'=>$message];
    }

    protected function errorAlert($message){
        return ['type'=> 'error', 'message'=>$message];
    }
}
