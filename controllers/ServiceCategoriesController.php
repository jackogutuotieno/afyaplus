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

class ServiceCategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/servicecategorieslist[/{id}]", [PermissionMiddleware::class], "list.service_categories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceCategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/servicecategoriesadd[/{id}]", [PermissionMiddleware::class], "add.service_categories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceCategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/servicecategoriesview[/{id}]", [PermissionMiddleware::class], "view.service_categories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceCategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/servicecategoriesedit[/{id}]", [PermissionMiddleware::class], "edit.service_categories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceCategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/servicecategoriesdelete[/{id}]", [PermissionMiddleware::class], "delete.service_categories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceCategoriesDelete");
    }
}
