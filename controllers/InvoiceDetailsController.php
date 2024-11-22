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

class InvoiceDetailsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/invoicedetailslist[/{id}]", [PermissionMiddleware::class], "list.invoice_details")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoiceDetailsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/invoicedetailsadd[/{id}]", [PermissionMiddleware::class], "add.invoice_details")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoiceDetailsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/invoicedetailsview[/{id}]", [PermissionMiddleware::class], "view.invoice_details")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoiceDetailsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/invoicedetailsedit[/{id}]", [PermissionMiddleware::class], "edit.invoice_details")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoiceDetailsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/invoicedetailsdelete[/{id}]", [PermissionMiddleware::class], "delete.invoice_details")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoiceDetailsDelete");
    }
}
