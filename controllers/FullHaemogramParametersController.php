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

class FullHaemogramParametersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramparameterslist[/{id}]", [PermissionMiddleware::class], "list.full_haemogram_parameters")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramParametersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramparametersadd[/{id}]", [PermissionMiddleware::class], "add.full_haemogram_parameters")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramParametersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramparametersview[/{id}]", [PermissionMiddleware::class], "view.full_haemogram_parameters")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramParametersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramparametersedit[/{id}]", [PermissionMiddleware::class], "edit.full_haemogram_parameters")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramParametersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramparametersdelete[/{id}]", [PermissionMiddleware::class], "delete.full_haemogram_parameters")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramParametersDelete");
    }
}
