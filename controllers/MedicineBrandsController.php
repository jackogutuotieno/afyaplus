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

class MedicineBrandsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/medicinebrandslist[/{id}]", [PermissionMiddleware::class], "list.medicine_brands")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineBrandsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/medicinebrandsadd[/{id}]", [PermissionMiddleware::class], "add.medicine_brands")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineBrandsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/medicinebrandsview[/{id}]", [PermissionMiddleware::class], "view.medicine_brands")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineBrandsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/medicinebrandsedit[/{id}]", [PermissionMiddleware::class], "edit.medicine_brands")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineBrandsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/medicinebrandsdelete[/{id}]", [PermissionMiddleware::class], "delete.medicine_brands")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MedicineBrandsDelete");
    }
}
