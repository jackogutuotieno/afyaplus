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

class InvoiceReportController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/invoicereportlist[/{id}]", [PermissionMiddleware::class], "list.invoice_report")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoiceReportList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/invoicereportview[/{id}]", [PermissionMiddleware::class], "view.invoice_report")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoiceReportView");
    }
}
