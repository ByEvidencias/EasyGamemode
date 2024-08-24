<?php

namespace EasyGamemode\utils;

trait SingletonTrait {

    private static ?self $instance = null;

    public static function getInstance(): ?self {
        return self::$instance;
    }
}
