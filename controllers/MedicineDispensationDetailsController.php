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

class MedicineDispensationDetailsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationdetailslist[/{id}]", [PermissionMiddleware::class], "list.medicine_dispensation_details")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationDetailsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationdetailsadd[/{id}]", [PermissionMiddleware::class], "add.medicine_dispensation_details")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationDetailsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationdetailsview[/{id}]", [PermissionMiddleware::class], "view.medicine_dispensation_details")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationDetailsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationdetailsedit[/{id}]", [PermissionMiddleware::class], "edit.medicine_dispensation_details")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationDetailsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicinedispensationdetailsdelete[/{id}]", [PermissionMiddleware::class], "delete.medicine_dispensation_details")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineDispensationDetailsDelete");
    }
}
