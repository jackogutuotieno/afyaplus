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

class UrinalysisTestController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/urinalysistestlist[/{id}]", [PermissionMiddleware::class], "list.urinalysis_test")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisTestList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/urinalysistestadd[/{id}]", [PermissionMiddleware::class], "add.urinalysis_test")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisTestAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/urinalysistestview[/{id}]", [PermissionMiddleware::class], "view.urinalysis_test")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisTestView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/urinalysistestedit[/{id}]", [PermissionMiddleware::class], "edit.urinalysis_test")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisTestEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/urinalysistestdelete[/{id}]", [PermissionMiddleware::class], "delete.urinalysis_test")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UrinalysisTestDelete");
    }
}
