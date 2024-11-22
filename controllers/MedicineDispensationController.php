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

class MedicineDispensationController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationlist[/{id}]", [PermissionMiddleware::class], "list.medicine_dispensation")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationadd[/{id}]", [PermissionMiddleware::class], "add.medicine_dispensation")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationview[/{id}]", [PermissionMiddleware::class], "view.medicine_dispensation")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationedit[/{id}]", [PermissionMiddleware::class], "edit.medicine_dispensation")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationdelete[/{id}]", [PermissionMiddleware::class], "delete.medicine_dispensation")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationDelete");
    }
}
