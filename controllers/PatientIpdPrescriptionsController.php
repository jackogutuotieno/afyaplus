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

class PatientIpdPrescriptionsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptionslist[/{id}]", [PermissionMiddleware::class], "list.patient_ipd_prescriptions")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptionsadd[/{id}]", [PermissionMiddleware::class], "add.patient_ipd_prescriptions")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptionsview[/{id}]", [PermissionMiddleware::class], "view.patient_ipd_prescriptions")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptionsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_ipd_prescriptions")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientipdprescriptionsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_ipd_prescriptions")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientIpdPrescriptionsDelete");
    }
}
