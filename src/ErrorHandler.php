<?php

namespace Bizcloud\MVCTest;

class ErrorHandler
{
    const VIEW_PATH = __DIR__ . DIRECTORY_SEPARATOR . '../templates';

    /** @var Renderer */
    private $renderer;

    /** @inheritdoc */
    public function __construct()
    {
        $this->renderer = new Renderer();
    }

    /**
     * @param \Exception $exception
     */
    public function handle(\Exception $exception)
    {

        $this->renderException($exception);
    }

    /**
     * @param \Exception $exception
     */
    public function renderException(\Exception $exception)
    {
        $templatePath = join(
            DIRECTORY_SEPARATOR,
            [
                Renderer::getUserViewDirectory(),
                'error.php',
            ]
        );

        if (!file_exists($templatePath)) {
            $templatePath = join(
                DIRECTORY_SEPARATOR,
                [
                    self::VIEW_PATH,
                    'error.php',
                ]
            );
        }



        extract(['exception' => $exception]);

        $this->sendHeadersWithHttpCode($exception->getCode());

        require_once($templatePath);
    }

    /**
     * @param int $httpCode
     */
    private function sendHeadersWithHttpCode(int $httpCode)
    {
        $message = 'Internal Server Error';

        if ($httpCode === 404) {
            $message = 'Not Found';
        }

        header(sprintf('HTTP/1.1 %d %s', $httpCode, $message));
    }

}