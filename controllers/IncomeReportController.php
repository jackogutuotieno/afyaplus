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
 * Income_Report controller
 */
class IncomeReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/incomereport", [PermissionMiddleware::class], "summary.Income_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IncomeReportSummary");
    }

    // IncomebyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/incomereport/IncomebyMonth", [PermissionMiddleware::class], "summary.Income_Report.IncomebyMonth")]
    public function IncomebyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "IncomeReportSummary", "IncomebyMonth");
    }
}
