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
 * Radiology_Report controller
 */
class RadiologyReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/radiologyreport", [PermissionMiddleware::class], "summary.Radiology_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyReportSummary");
    }

    // SubmissionsbyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/radiologyreport/SubmissionsbyMonth", [PermissionMiddleware::class], "summary.Radiology_Report.SubmissionsbyMonth")]
    public function SubmissionsbyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "RadiologyReportSummary", "SubmissionsbyMonth");
    }
}