<?php

namespace PHPMaker2024\afyaplus;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\afyaplus\Attributes\Delete;
use PHPMaker2024\afyaplus\Attributes\Get;
use PHPMaker2024\afyaplus\Attributes\Map;
use PHPMaker2024\afyaplus\Attributes\Options;
use PHPMaker2024\afyaplus\Attributes\Patch;
use PHPMaker2024\afyaplus\Attributes\Post;
use PHPMaker2024\afyaplus\Attributes\Put;

/**
 * Patients_Appointments controller
 */
class PatientsAppointmentsController extends ControllerBase
{
    // calendar
    #[Map(["GET", "POST", "OPTIONS"], "/patientsappointments", [PermissionMiddleware::class], "calendar.Patients_Appointments")]
    public function calendar(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsAppointmentsCalendar");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientsappointmentsadd[/{id}]", [PermissionMiddleware::class], "add.Patients_Appointments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsAppointmentsAdd");
    }

    // view
    #[Map(["GET","OPTIONS"], "/patientsappointmentsview[/{id}]", [PermissionMiddleware::class], "view.Patients_Appointments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsAppointmentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientsappointmentsedit[/{id}]", [PermissionMiddleware::class], "edit.Patients_Appointments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsAppointmentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientsappointmentsdelete[/{id}]", [PermissionMiddleware::class], "delete.Patients_Appointments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientsAppointmentsDelete");
    }
}
