<?php

namespace Bizcloud\MVCTest;


    use Bizcloud\MVCTest\Exception\ActionNotFound;
    use Bizcloud\MVCTest\Exception\ControllerNotFound;

    /**
     * Abstract controller. Extend this class to make your controllers.
     */
abstract class AbstractController
{

    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_GET = 'GET';

    /** @var Renderer */
    private $renderer;

    /** @inheritdoc */
    public function __construct()
    {
        $this->renderer = new Renderer();
    }


    /**
     * Processing controller action
     * @param string|null $actionName
     * @return mixed
     * @throws ActionNotFound
     */
    public final function processAction($actionName)
    {
        $actionName = ($actionName ?? 'index') . 'Action';

        if (method_exists(static::class, $actionName) && is_callable([static::class, $actionName])) {
            return static::$actionName();
        } else {
            throw new ActionNotFound();
        }
    }

    /**
     * Template rendering
     * @param string $template
     * @param array  $parameters
     */
    public function render($template = 'index', array $parameters = [])
    {
        $this->renderer->render($template, $parameters);
    }

    /**
     * Creates $_POST from php://input
     * Parses php input and returns valid post parameters array
     * @return array Post parameters array
     */
    public function getPost(): array
    {
        parse_str(file_get_contents('php://input'), $postParameters);

        return $postParameters;
    }

    /**
     * Get POST parameter by name. Returns null if parameter was not received
     * @param string $parameterName
     * @return mixed|null
     */
    public function getParameter(string $parameterName)
    {
        return $this->getPost()[$parameterName] ?? null;
    }

    /**
     * Check request method
     * @param string $method
     * @return bool
     */
    public function isRequestMethod(string $method): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $method;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->isRequestMethod(self::HTTP_METHOD_POST);
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->isRequestMethod(self::HTTP_METHOD_GET);
    }

    /**
     * @param string $controllerName
     * @param string $action
     * @return mixed
     * @throws ActionNotFound
     * @throws ControllerNotFound
     */
    public function redirectToControllerRoute(string $controllerName, string $action)
    {
        if (!class_exists($controllerName)) {
            throw new ControllerNotFound();
        }

        /** @var AbstractController $controller */
        $controller = new $controllerName;

        return $controller->processAction($action);
    }

    /**
     * @param string $url
     */
    public function redirect(string $url)
    {
        header(sprintf('Location: %s', $url));
    }

}