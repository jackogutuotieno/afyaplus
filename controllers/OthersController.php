<?php

namespace PHPMaker2024\afyaplus;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use Slim\Exception\HttpUnauthorizedException;
use PHPMaker2024\afyaplus\Attributes\Delete;
use PHPMaker2024\afyaplus\Attributes\Get;
use PHPMaker2024\afyaplus\Attributes\Map;
use PHPMaker2024\afyaplus\Attributes\Options;
use PHPMaker2024\afyaplus\Attributes\Patch;
use PHPMaker2024\afyaplus\Attributes\Post;
use PHPMaker2024\afyaplus\Attributes\Put;

/**
 * Class others controller
 */
class OthersController extends ControllerBase
{
    // Swagger
    #[Get("/swagger/swagger", [], "swagger")]
    public function swagger(Request $request, Response $response, array $args): Response
    {
        $basePath = GetBasePath($request);
        $lang = $this->container->get("app.language");
        $title = $lang->phrase("ApiTitle");
        if (!$title || $title == "ApiTitle") {
            $title = "REST API"; // Default
        }
        $data = [
            "title" => $title,
            "version" => Config("API_VERSION"),
            "basePath" => $basePath
        ];
        $view = $this->container->get("app.view");
        return $view->render($response, "swagger.php", $data);
    }

    // Index
    #[Get("/[index]", [PermissionMiddleware::class], "index")]
    public function index(Request $request, Response $response, array $args): Response
    {
        $url = "appointmentsreportlist";
        if ($url == "") {
            throw new HttpUnauthorizedException($request, DeniedMessage());
        }
        return $response->withHeader("Location", $url)->withStatus(302);
    }
}
