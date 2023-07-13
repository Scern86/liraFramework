<?php

namespace Scern\Lira;

use Closure;
use Scern\Lira\{Application\App, Config\Config};

class Core
{
    public const VERSION = '7.2.0';
    private static ?Config $config = null;
    private static ?SessionManager $session_manager = null;
    private static ?Logger $logger = null;
    private static ?CacheManager $cache_manager = null;
    private static ?EventManager $event_manager = null;
    private static ?User $user = null;
    private static ?DatabaseManager $database_manager = null;
    private static ?Lexicon $lexicon = null;
    private static ?App $application = null;

    public static function CONFIG(): Closure|Config
    {
        return self::$config ?? fn(Config $config) => self::$config = $config;
    }

    public static function SESSION(): Closure|SessionManager
    {
        return self::$session_manager ?? fn(SessionManager $session_manager) => self::$session_manager = $session_manager;
    }

    public static function LOG(): Closure|Logger
    {
        return self::$logger ?? fn(Logger $logger) => self::$logger = $logger;
    }

    public static function LEXICON(): Closure|Lexicon
    {
        return self::$lexicon ?? fn(Lexicon $lexicon) => self::$lexicon = $lexicon;
    }

    public static function CACHE(): Closure|CacheManager
    {
        return self::$cache_manager ?? fn(CacheManager $cache_manager) => self::$cache_manager = $cache_manager;
    }

    public static function EVENT(): Closure|EventManager
    {
        return self::$event_manager ?? fn(EventManager $event_manager) => self::$event_manager = $event_manager;
    }

    public static function USER(): Closure|User
    {
        return self::$user ?? fn(User $user) => self::$user = $user;
    }

    public static function DATABASE(): Closure|DatabaseManager
    {
        return self::$database_manager ?? fn(DatabaseManager $database_manager) => self::$database_manager = $database_manager;
    }

    public static function APP(): Closure|App
    {
        return self::$application ?? fn(App $application) => self::$application = $application;
    }
}