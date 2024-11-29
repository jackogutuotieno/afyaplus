<?php

namespace PHPMaker2024\afyaplus;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\afyaplus\Attributes\Delete;
use PHPMaker2024\afyaplus\Attributes\Get;
use PHPMaker2024\afyaplus\Attributes\Map;
use PHPMaker2024\afyaplus\Attributes\Options;
use PHPMaker2024\afyaplus\Attributes\Patch;
use PHPMaker2024\afyaplus\Attributes\Post;
use PHPMaker2024\afyaplus\Attributes\Put;

class LaboratoryBillingReportController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/laboratorybillingreportlist[/{id}]", [PermissionMiddleware::class], "list.laboratory_billing_report")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LaboratoryBillingReportList");
    }

    // search
    #[Map(["GET","POST","OPTIONS"], "/laboratorybillingreportsearch", [PermissionMiddleware::class], "search.laboratory_billing_report")]
    public function search(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LaboratoryBillingReportSearch");
    }
}
