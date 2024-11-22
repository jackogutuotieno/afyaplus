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

class MedicineStockController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicinestocklist[/{id}]", [PermissionMiddleware::class], "list.medicine_stock")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineStockList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicinestockadd[/{id}]", [PermissionMiddleware::class], "add.medicine_stock")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineStockAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicinestockview[/{id}]", [PermissionMiddleware::class], "view.medicine_stock")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineStockView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicinestockedit[/{id}]", [PermissionMiddleware::class], "edit.medicine_stock")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineStockEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicinestockdelete[/{id}]", [PermissionMiddleware::class], "delete.medicine_stock")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineStockDelete");
    }
}
