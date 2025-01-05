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

class SuppliersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/supplierslist[/{id}]", [PermissionMiddleware::class], "list.suppliers")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SuppliersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/suppliersadd[/{id}]", [PermissionMiddleware::class], "add.suppliers")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SuppliersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/suppliersview[/{id}]", [PermissionMiddleware::class], "view.suppliers")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SuppliersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/suppliersedit[/{id}]", [PermissionMiddleware::class], "edit.suppliers")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SuppliersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/suppliersdelete[/{id}]", [PermissionMiddleware::class], "delete.suppliers")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SuppliersDelete");
    }
}
