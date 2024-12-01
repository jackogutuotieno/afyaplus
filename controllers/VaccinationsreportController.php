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
 * Vaccinations_Report controller
 */
class VaccinationsReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/vaccinationsreport", [PermissionMiddleware::class], "summary.Vaccinations_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "VaccinationsReportSummary");
    }

    // VaccinationsbyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/vaccinationsreport/VaccinationsbyMonth", [PermissionMiddleware::class], "summary.Vaccinations_Report.VaccinationsbyMonth")]
    public function VaccinationsbyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "VaccinationsReportSummary", "VaccinationsbyMonth");
    }
}
