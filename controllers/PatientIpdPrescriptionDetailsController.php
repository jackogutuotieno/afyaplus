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

class PatientIpdPrescriptionDetailsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptiondetailslist[/{id}]", [PermissionMiddleware::class], "list.patient_ipd_prescription_details")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionDetailsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptiondetailsadd[/{id}]", [PermissionMiddleware::class], "add.patient_ipd_prescription_details")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionDetailsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptiondetailsview[/{id}]", [PermissionMiddleware::class], "view.patient_ipd_prescription_details")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionDetailsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptiondetailsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_ipd_prescription_details")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionDetailsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptiondetailsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_ipd_prescription_details")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionDetailsDelete");
    }
}
