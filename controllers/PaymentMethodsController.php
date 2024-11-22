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

class PaymentMethodsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/paymentmethodslist[/{id}]", [PermissionMiddleware::class], "list.payment_methods")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PaymentMethodsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/paymentmethodsadd[/{id}]", [PermissionMiddleware::class], "add.payment_methods")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PaymentMethodsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/paymentmethodsview[/{id}]", [PermissionMiddleware::class], "view.payment_methods")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PaymentMethodsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/paymentmethodsedit[/{id}]", [PermissionMiddleware::class], "edit.payment_methods")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PaymentMethodsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/paymentmethodsdelete[/{id}]", [PermissionMiddleware::class], "delete.payment_methods")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PaymentMethodsDelete");
    }
}
