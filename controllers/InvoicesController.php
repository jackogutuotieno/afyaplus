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

class InvoicesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/invoiceslist[/{id}]", [PermissionMiddleware::class], "list.invoices")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoicesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/invoicesadd[/{id}]", [PermissionMiddleware::class], "add.invoices")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoicesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/invoicesview[/{id}]", [PermissionMiddleware::class], "view.invoices")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoicesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/invoicesedit[/{id}]", [PermissionMiddleware::class], "edit.invoices")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoicesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/invoicesdelete[/{id}]", [PermissionMiddleware::class], "delete.invoices")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "InvoicesDelete");
    }
}
