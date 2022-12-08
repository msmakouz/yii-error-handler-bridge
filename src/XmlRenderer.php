<?php

namespace Spiral\YiiErrorHandler;

use Spiral\Exceptions\ExceptionRendererInterface;
use Spiral\Exceptions\Verbosity;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

final class XmlRenderer implements ExceptionRendererInterface
{
    public const FORMATS = ['application/xml', 'text/xml'];

    public function __construct(
        private readonly ?ThrowableRendererInterface $renderer = new \Yiisoft\ErrorHandler\Renderer\XmlRenderer()
    ) {
    }

    public function render(
        \Throwable $exception,
        ?Verbosity $verbosity = Verbosity::BASIC,
        string $format = null,
    ): string {
        if ($verbosity >= Verbosity::VERBOSE) {
            return (string)$this->renderer->renderVerbose($exception);
        }

        return (string)$this->renderer->render($exception);
    }

    public function canRender(string $format): bool
    {
        return \in_array($format, self::FORMATS, true);
    }
}
