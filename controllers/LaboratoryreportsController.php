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

    // GraphbySubmission (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/laboratoryreports/GraphbySubmission", [PermissionMiddleware::class], "summary.Laboratory_Reports.GraphbySubmission")]
    public function GraphbySubmission(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "LaboratoryReportsSummary", "GraphbySubmission");
    }

    // GraphbyTestsPerformed (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/laboratoryreports/GraphbyTestsPerformed", [PermissionMiddleware::class], "summary.Laboratory_Reports.GraphbyTestsPerformed")]
    public function GraphbyTestsPerformed(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "LaboratoryReportsSummary", "GraphbyTestsPerformed");
    }

    // GraphbyDisease (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/laboratoryreports/GraphbyDisease", [PermissionMiddleware::class], "summary.Laboratory_Reports.GraphbyDisease")]
    public function GraphbyDisease(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "LaboratoryReportsSummary", "GraphbyDisease");
    }
}
