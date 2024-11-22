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

class ServiceSubcategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/servicesubcategorieslist[/{id}]", [PermissionMiddleware::class], "list.service_subcategories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceSubcategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/servicesubcategoriesadd[/{id}]", [PermissionMiddleware::class], "add.service_subcategories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceSubcategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/servicesubcategoriesview[/{id}]", [PermissionMiddleware::class], "view.service_subcategories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceSubcategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/servicesubcategoriesedit[/{id}]", [PermissionMiddleware::class], "edit.service_subcategories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceSubcategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/servicesubcategoriesdelete[/{id}]", [PermissionMiddleware::class], "delete.service_subcategories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceSubcategoriesDelete");
    }
}
