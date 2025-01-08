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
 * Procurement_Overview controller
 */
class ProcurementOverviewController extends ControllerBase
{
    // dashboard
    #[Map(["GET", "POST", "OPTIONS"], "/procurementoverview", [PermissionMiddleware::class], "dashboard.Procurement_Overview")]
    public function dashboard(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ProcurementOverview");
    }
}
