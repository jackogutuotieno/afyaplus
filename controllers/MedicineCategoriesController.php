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

class MedicineCategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicinecategorieslist[/{id}]", [PermissionMiddleware::class], "list.medicine_categories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineCategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicinecategoriesadd[/{id}]", [PermissionMiddleware::class], "add.medicine_categories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineCategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicinecategoriesview[/{id}]", [PermissionMiddleware::class], "view.medicine_categories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineCategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicinecategoriesedit[/{id}]", [PermissionMiddleware::class], "edit.medicine_categories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineCategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicinecategoriesdelete[/{id}]", [PermissionMiddleware::class], "delete.medicine_categories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineCategoriesDelete");
    }
}
