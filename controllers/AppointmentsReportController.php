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
 * Appointments_Report controller
 */
class AppointmentsReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/appointmentsreport", [PermissionMiddleware::class], "summary.Appointments_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AppointmentsReportSummary");
    }

    // AppointmentsSubmittedbyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/appointmentsreport/AppointmentsSubmittedbyMonth", [PermissionMiddleware::class], "summary.Appointments_Report.AppointmentsSubmittedbyMonth")]
    public function AppointmentsSubmittedbyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "AppointmentsReportSummary", "AppointmentsSubmittedbyMonth");
    }
}
