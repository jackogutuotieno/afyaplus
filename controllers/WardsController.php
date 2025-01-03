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

class WardsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/wardslist[/{id}]", [PermissionMiddleware::class], "list.wards")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/wardsadd[/{id}]", [PermissionMiddleware::class], "add.wards")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/wardsview[/{id}]", [PermissionMiddleware::class], "view.wards")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/wardsedit[/{id}]", [PermissionMiddleware::class], "edit.wards")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/wardsdelete[/{id}]", [PermissionMiddleware::class], "delete.wards")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardsDelete");
    }
}
