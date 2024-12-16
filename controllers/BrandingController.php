<?php

namespace PHPMaker2024\afyaplus;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\afyaplus\Attributes\Delete;
use PHPMaker2024\afyaplus\Attributes\Get;
use PHPMaker2024\afyaplus\Attributes\Map;
use PHPMaker2024\afyaplus\Attributes\Options;
use PHPMaker2024\afyaplus\Attributes\Patch;
use PHPMaker2024\afyaplus\Attributes\Post;
use PHPMaker2024\afyaplus\Attributes\Put;

class BrandingController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/brandinglist[/{id}]", [PermissionMiddleware::class], "list.branding")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BrandingList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/brandingview[/{id}]", [PermissionMiddleware::class], "view.branding")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BrandingView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/brandingedit[/{id}]", [PermissionMiddleware::class], "edit.branding")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BrandingEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/brandingdelete[/{id}]", [PermissionMiddleware::class], "delete.branding")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BrandingDelete");
    }
}
