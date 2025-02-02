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

class SubCountyController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/subcountylist[/{id}]", [PermissionMiddleware::class], "list.sub_county")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubCountyList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/subcountyadd[/{id}]", [PermissionMiddleware::class], "add.sub_county")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubCountyAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/subcountyview[/{id}]", [PermissionMiddleware::class], "view.sub_county")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubCountyView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/subcountyedit[/{id}]", [PermissionMiddleware::class], "edit.sub_county")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubCountyEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/subcountydelete[/{id}]", [PermissionMiddleware::class], "delete.sub_county")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubCountyDelete");
    }
}
