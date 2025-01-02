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

class LeaveCategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/leavecategorieslist[/{id}]", [PermissionMiddleware::class], "list.leave_categories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveCategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/leavecategoriesadd[/{id}]", [PermissionMiddleware::class], "add.leave_categories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveCategoriesAdd");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/leavecategoriesedit[/{id}]", [PermissionMiddleware::class], "edit.leave_categories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveCategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/leavecategoriesdelete[/{id}]", [PermissionMiddleware::class], "delete.leave_categories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LeaveCategoriesDelete");
    }
}
