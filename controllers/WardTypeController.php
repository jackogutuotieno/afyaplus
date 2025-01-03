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

class WardTypeController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/wardtypelist[/{id}]", [PermissionMiddleware::class], "list.ward_type")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardTypeList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/wardtypeadd[/{id}]", [PermissionMiddleware::class], "add.ward_type")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardTypeAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/wardtypeview[/{id}]", [PermissionMiddleware::class], "view.ward_type")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardTypeView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/wardtypeedit[/{id}]", [PermissionMiddleware::class], "edit.ward_type")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardTypeEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/wardtypedelete[/{id}]", [PermissionMiddleware::class], "delete.ward_type")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "WardTypeDelete");
    }
}
