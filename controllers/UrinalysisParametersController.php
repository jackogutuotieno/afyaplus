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

class UrinalysisParametersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/urinalysisparameterslist[/{id}]", [PermissionMiddleware::class], "list.urinalysis_parameters")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisParametersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/urinalysisparametersadd[/{id}]", [PermissionMiddleware::class], "add.urinalysis_parameters")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisParametersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/urinalysisparametersview[/{id}]", [PermissionMiddleware::class], "view.urinalysis_parameters")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisParametersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/urinalysisparametersedit[/{id}]", [PermissionMiddleware::class], "edit.urinalysis_parameters")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisParametersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/urinalysisparametersdelete[/{id}]", [PermissionMiddleware::class], "delete.urinalysis_parameters")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisParametersDelete");
    }
}
