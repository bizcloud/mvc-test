<?php

namespace Bizcloud\MVCTest;

class Renderer
{

    /**
     * Render view template.
     * Parameters are extracted for usage inside template.
     * @param string $template
     * @param array  $parameters
     */
    public function render($template, array $parameters = [])
    {
        if (is_array($template)) {
            $parameters = $template;
            $template = 'index';
        }

        $templateFileName = $template . '.php';

        $templatePath = join(
            DIRECTORY_SEPARATOR,
            [
                $this->getUserViewDirectory(),
                $templateFileName,
            ]
        );

        extract($parameters);

        require_once($templatePath);
    }

    /**
     * @return string
     */
    public static function getUserViewDirectory()
    {
        return join(
            DIRECTORY_SEPARATOR,
            [
                __DIR__,
                '..',
                'template',
            ]
        );
    }

}