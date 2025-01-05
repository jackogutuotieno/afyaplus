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

class ItemCategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/itemcategorieslist[/{id}]", [PermissionMiddleware::class], "list.item_categories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemCategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/itemcategoriesadd[/{id}]", [PermissionMiddleware::class], "add.item_categories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemCategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/itemcategoriesview[/{id}]", [PermissionMiddleware::class], "view.item_categories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemCategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/itemcategoriesedit[/{id}]", [PermissionMiddleware::class], "edit.item_categories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemCategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/itemcategoriesdelete[/{id}]", [PermissionMiddleware::class], "delete.item_categories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemCategoriesDelete");
    }
}
