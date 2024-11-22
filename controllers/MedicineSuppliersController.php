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

class MedicineSuppliersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicinesupplierslist[/{id}]", [PermissionMiddleware::class], "list.medicine_suppliers")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineSuppliersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicinesuppliersadd[/{id}]", [PermissionMiddleware::class], "add.medicine_suppliers")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineSuppliersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicinesuppliersview[/{id}]", [PermissionMiddleware::class], "view.medicine_suppliers")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineSuppliersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicinesuppliersedit[/{id}]", [PermissionMiddleware::class], "edit.medicine_suppliers")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineSuppliersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicinesuppliersdelete[/{id}]", [PermissionMiddleware::class], "delete.medicine_suppliers")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineSuppliersDelete");
    }
}
