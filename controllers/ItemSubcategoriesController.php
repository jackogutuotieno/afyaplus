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

class ItemSubcategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/itemsubcategorieslist[/{id}]", [PermissionMiddleware::class], "list.item_subcategories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemSubcategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/itemsubcategoriesadd[/{id}]", [PermissionMiddleware::class], "add.item_subcategories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemSubcategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/itemsubcategoriesview[/{id}]", [PermissionMiddleware::class], "view.item_subcategories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemSubcategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/itemsubcategoriesedit[/{id}]", [PermissionMiddleware::class], "edit.item_subcategories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemSubcategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/itemsubcategoriesdelete[/{id}]", [PermissionMiddleware::class], "delete.item_subcategories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemSubcategoriesDelete");
    }
}
