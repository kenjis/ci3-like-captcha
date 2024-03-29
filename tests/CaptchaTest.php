<?php

declare(strict_types=1);

namespace Kenjis\CI3Like\Captcha;

use PHPUnit\Framework\TestCase;

use function strlen;
use function unlink;

class CaptchaTest extends TestCase
{
    /** @var Captcha */
    protected $captcha;

    protected function setUp(): void
    {
        $this->captcha = new Captcha();
    }

    public function test_create_instance(): void
    {
        $actual = $this->captcha;
        $this->assertInstanceOf(Captcha::class, $actual);
    }

    public function test_createCaptcha_with_word(): void
    {
        $data = [
            'word'      => 'abcd',
            'img_path'  => __DIR__ . '/',
            'img_url'   => 'http://example.com/captcha/',
        ];
        $cap = Captcha::createCaptcha($data);

        $this->assertSame($data['word'], $cap['word']);

        $this->assertMatchesRegularExpression(
            '!<img  src="http://example\.com/captcha/.*\.png" style="width: 150px; height: 30px; border: 0;" alt="captcha" />!',
            $cap['image']
        );

        $file = __DIR__ . '/' . $cap['filename'];
        $this->assertFileExists($file);

        unlink($file);
    }

    public function test_createCaptcha_without_word(): void
    {
        $data = [
            'img_path'  => __DIR__ . '/',
            'img_url'   => 'http://example.com/captcha/',
        ];
        $cap = Captcha::createCaptcha($data);

        // $cap['word'] is random 5 letter strings.
        $this->assertSame(5, strlen($cap['word']));

        $this->assertMatchesRegularExpression(
            '!<img  src="http://example\.com/captcha/.*\.png" style="width: 150px; height: 30px; border: 0;" alt="captcha" />!',
            $cap['image']
        );

        $file = __DIR__ . '/' . $cap['filename'];
        $this->assertFileExists($file);

        unlink($file);
    }
}
