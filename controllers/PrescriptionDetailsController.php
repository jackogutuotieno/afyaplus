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

class PrescriptionDetailsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/prescriptiondetailslist[/{id}]", [PermissionMiddleware::class], "list.prescription_details")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionDetailsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/prescriptiondetailsadd[/{id}]", [PermissionMiddleware::class], "add.prescription_details")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionDetailsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/prescriptiondetailsview[/{id}]", [PermissionMiddleware::class], "view.prescription_details")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionDetailsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/prescriptiondetailsedit[/{id}]", [PermissionMiddleware::class], "edit.prescription_details")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionDetailsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/prescriptiondetailsdelete[/{id}]", [PermissionMiddleware::class], "delete.prescription_details")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PrescriptionDetailsDelete");
    }
}
