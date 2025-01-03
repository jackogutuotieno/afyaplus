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

class FloorsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/floorslist[/{id}]", [PermissionMiddleware::class], "list.floors")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FloorsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/floorsadd[/{id}]", [PermissionMiddleware::class], "add.floors")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FloorsAdd");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/floorsedit[/{id}]", [PermissionMiddleware::class], "edit.floors")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FloorsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/floorsdelete[/{id}]", [PermissionMiddleware::class], "delete.floors")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FloorsDelete");
    }
}
