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

class PatientAppointmentsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentslist[/{id}]", [PermissionMiddleware::class], "list.patient_appointments")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentsadd[/{id}]", [PermissionMiddleware::class], "add.patient_appointments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentsview[/{id}]", [PermissionMiddleware::class], "view.patient_appointments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentsedit[/{id}]", [PermissionMiddleware::class], "edit.patient_appointments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentsdelete[/{id}]", [PermissionMiddleware::class], "delete.patient_appointments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsDelete");
    }
}
