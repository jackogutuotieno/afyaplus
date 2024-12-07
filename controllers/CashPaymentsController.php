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

class CashPaymentsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/cashpaymentslist[/{id}]", [PermissionMiddleware::class], "list.cash_payments")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CashPaymentsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/cashpaymentsadd[/{id}]", [PermissionMiddleware::class], "add.cash_payments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CashPaymentsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/cashpaymentsview[/{id}]", [PermissionMiddleware::class], "view.cash_payments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CashPaymentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/cashpaymentsedit[/{id}]", [PermissionMiddleware::class], "edit.cash_payments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CashPaymentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/cashpaymentsdelete[/{id}]", [PermissionMiddleware::class], "delete.cash_payments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CashPaymentsDelete");
    }
}
