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

class IpdBillingReportController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ipdbillingreportlist[/{patient_uhid}]", [PermissionMiddleware::class], "list.ipd_billing_report")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IpdBillingReportList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ipdbillingreportview[/{patient_uhid}]", [PermissionMiddleware::class], "view.ipd_billing_report")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IpdBillingReportView");
    }
}
