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
 * Laboratory_Reports controller
 */
class LaboratoryReportsController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/laboratoryreports", [PermissionMiddleware::class], "summary.Laboratory_Reports")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LaboratoryReportsSummary");
    }

    // ReportbySubmissionMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/laboratoryreports/ReportbySubmissionMonth", [PermissionMiddleware::class], "summary.Laboratory_Reports.ReportbySubmissionMonth")]
    public function ReportbySubmissionMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "LaboratoryReportsSummary", "ReportbySubmissionMonth");
    }
}
