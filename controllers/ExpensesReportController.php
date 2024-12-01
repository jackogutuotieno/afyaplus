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
 * Expenses_Report controller
 */
class ExpensesReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/expensesreport", [PermissionMiddleware::class], "summary.Expenses_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExpensesReportSummary");
    }

    // ExpensesbyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/expensesreport/ExpensesbyMonth", [PermissionMiddleware::class], "summary.Expenses_Report.ExpensesbyMonth")]
    public function ExpensesbyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "ExpensesReportSummary", "ExpensesbyMonth");
    }
}
