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
 * Visits_Report1 controller
 */
class VisitsReport1Controller extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/visitsreport1", [PermissionMiddleware::class], "summary.Visits_Report1")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "VisitsReport1Summary");
    }

    // VisitsbyMonth (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/visitsreport1/VisitsbyMonth", [PermissionMiddleware::class], "summary.Visits_Report1.VisitsbyMonth")]
    public function VisitsbyMonth(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "VisitsReport1Summary", "VisitsbyMonth");
    }
}
