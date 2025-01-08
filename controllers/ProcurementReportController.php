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
 * Procurement_Report controller
 */
class ProcurementReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/procurementreport", [PermissionMiddleware::class], "summary.Procurement_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ProcurementReportSummary");
    }

    // ProcurementbyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/procurementreport/ProcurementbyMonth", [PermissionMiddleware::class], "summary.Procurement_Report.ProcurementbyMonth")]
    public function ProcurementbyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "ProcurementReportSummary", "ProcurementbyMonth");
    }

    // ProcurementbyYear (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/procurementreport/ProcurementbyYear", [PermissionMiddleware::class], "summary.Procurement_Report.ProcurementbyYear")]
    public function ProcurementbyYear(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "ProcurementReportSummary", "ProcurementbyYear");
    }

    // ProcurementbySupplier (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/procurementreport/ProcurementbySupplier", [PermissionMiddleware::class], "summary.Procurement_Report.ProcurementbySupplier")]
    public function ProcurementbySupplier(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "ProcurementReportSummary", "ProcurementbySupplier");
    }

    // ProcurementbyCategory (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/procurementreport/ProcurementbyCategory", [PermissionMiddleware::class], "summary.Procurement_Report.ProcurementbyCategory")]
    public function ProcurementbyCategory(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "ProcurementReportSummary", "ProcurementbyCategory");
    }

    // ProcurementbySubcategory (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/procurementreport/ProcurementbySubcategory", [PermissionMiddleware::class], "summary.Procurement_Report.ProcurementbySubcategory")]
    public function ProcurementbySubcategory(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "ProcurementReportSummary", "ProcurementbySubcategory");
    }
}
