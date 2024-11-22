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

class ExpensesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/expenseslist[/{id}]", [PermissionMiddleware::class], "list.expenses")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExpensesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/expensesadd[/{id}]", [PermissionMiddleware::class], "add.expenses")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExpensesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/expensesview[/{id}]", [PermissionMiddleware::class], "view.expenses")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExpensesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/expensesedit[/{id}]", [PermissionMiddleware::class], "edit.expenses")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExpensesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/expensesdelete[/{id}]", [PermissionMiddleware::class], "delete.expenses")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExpensesDelete");
    }
}
