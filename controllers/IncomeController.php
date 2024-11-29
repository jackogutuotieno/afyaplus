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

class IncomeController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/incomelist[/{id}]", [PermissionMiddleware::class], "list.income")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IncomeList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/incomeadd[/{id}]", [PermissionMiddleware::class], "add.income")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IncomeAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/incomeview[/{id}]", [PermissionMiddleware::class], "view.income")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IncomeView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/incomeedit[/{id}]", [PermissionMiddleware::class], "edit.income")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IncomeEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/incomedelete[/{id}]", [PermissionMiddleware::class], "delete.income")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IncomeDelete");
    }
}
