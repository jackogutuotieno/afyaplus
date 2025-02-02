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

class CountyController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/countylist[/{id}]", [PermissionMiddleware::class], "list.county")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CountyList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/countyadd[/{id}]", [PermissionMiddleware::class], "add.county")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CountyAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/countyview[/{id}]", [PermissionMiddleware::class], "view.county")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CountyView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/countyedit[/{id}]", [PermissionMiddleware::class], "edit.county")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CountyEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/countydelete[/{id}]", [PermissionMiddleware::class], "delete.county")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CountyDelete");
    }
}
