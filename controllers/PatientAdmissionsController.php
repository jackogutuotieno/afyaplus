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

class PatientAdmissionsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientadmissionslist[/{id}]", [PermissionMiddleware::class], "list.patient_admissions")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAdmissionsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientadmissionsadd[/{id}]", [PermissionMiddleware::class], "add.patient_admissions")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAdmissionsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientadmissionsview[/{id}]", [PermissionMiddleware::class], "view.patient_admissions")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAdmissionsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientadmissionsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_admissions")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAdmissionsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientadmissionsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_admissions")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAdmissionsDelete");
    }
}
