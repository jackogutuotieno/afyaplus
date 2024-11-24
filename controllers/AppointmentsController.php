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
 * Appointments controller
 */
class AppointmentsController extends ControllerBase
{
    // calendar
    #[Map(["GET", "POST", "OPTIONS"], "/appointments", [PermissionMiddleware::class], "calendar.Appointments")]
    public function calendar(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AppointmentsCalendar");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/appointmentsadd[/{id}]", [PermissionMiddleware::class], "add.Appointments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AppointmentsAdd");
    }

    // view
    #[Map(["GET","OPTIONS"], "/appointmentsview[/{id}]", [PermissionMiddleware::class], "view.Appointments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AppointmentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/appointmentsedit[/{id}]", [PermissionMiddleware::class], "edit.Appointments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AppointmentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/appointmentsdelete[/{id}]", [PermissionMiddleware::class], "delete.Appointments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AppointmentsDelete");
    }
}
