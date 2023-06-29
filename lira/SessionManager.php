<?php

namespace Scern\Lira;
class SessionManager
{
    private static ?string $session_id = null;

    public function sessionStart(): void
    {
        self::$session_id = session_id();
        if (empty(self::$session_id)) {
            session_start();
            session_write_close();
            self::$session_id = session_id();
        }
    }

    public function sessionRenew(): void
    {
        session_start();
        session_regenerate_id();
        $this->sessionStart();
    }

    public function isSessionStarted(): bool
    {
        return !is_null(self::$session_id);
    }

    public function getSessionId(): ?string
    {
        return self::$session_id;
    }
}