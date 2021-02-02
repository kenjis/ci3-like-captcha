<?php

declare(strict_types=1);

namespace Kenjis\CI3Like\Captcha;

use PHPUnit\Framework\TestCase;

class CI3LikeCaptchaTest extends TestCase
{
    /** @var CI3LikeCaptcha */
    protected $cI3LikeCaptcha;

    protected function setUp(): void
    {
        $this->cI3LikeCaptcha = new CI3LikeCaptcha();
    }

    public function testIsInstanceOfCI3LikeCaptcha(): void
    {
        $actual = $this->cI3LikeCaptcha;
        $this->assertInstanceOf(CI3LikeCaptcha::class, $actual);
    }
}
