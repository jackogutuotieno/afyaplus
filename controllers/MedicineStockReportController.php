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
 * Medicine_Stock_Report controller
 */
class MedicineStockReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/medicinestockreport", [PermissionMiddleware::class], "summary.Medicine_Stock_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineStockReportSummary");
    }

    // StockUpdatebyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/medicinestockreport/StockUpdatebyMonth", [PermissionMiddleware::class], "summary.Medicine_Stock_Report.StockUpdatebyMonth")]
    public function StockUpdatebyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "MedicineStockReportSummary", "StockUpdatebyMonth");
    }

    // StockbySupplier (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/medicinestockreport/StockbySupplier", [PermissionMiddleware::class], "summary.Medicine_Stock_Report.StockbySupplier")]
    public function StockbySupplier(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "MedicineStockReportSummary", "StockbySupplier");
    }

    // StockbyExpiryStatus (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/medicinestockreport/StockbyExpiryStatus", [PermissionMiddleware::class], "summary.Medicine_Stock_Report.StockbyExpiryStatus")]
    public function StockbyExpiryStatus(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "MedicineStockReportSummary", "StockbyExpiryStatus");
    }

    // StockbyMedicineBrand (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/medicinestockreport/StockbyMedicineBrand", [PermissionMiddleware::class], "summary.Medicine_Stock_Report.StockbyMedicineBrand")]
    public function StockbyMedicineBrand(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "MedicineStockReportSummary", "StockbyMedicineBrand");
    }
}
