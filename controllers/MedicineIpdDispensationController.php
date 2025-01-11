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

class MedicineIpdDispensationController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicineipddispensationlist[/{id}]", [PermissionMiddleware::class], "list.medicine_ipd_dispensation")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineIpdDispensationList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicineipddispensationadd[/{id}]", [PermissionMiddleware::class], "add.medicine_ipd_dispensation")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineIpdDispensationAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicineipddispensationview[/{id}]", [PermissionMiddleware::class], "view.medicine_ipd_dispensation")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineIpdDispensationView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicineipddispensationedit[/{id}]", [PermissionMiddleware::class], "edit.medicine_ipd_dispensation")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineIpdDispensationEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicineipddispensationdelete[/{id}]", [PermissionMiddleware::class], "delete.medicine_ipd_dispensation")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineIpdDispensationDelete");
    }
}
