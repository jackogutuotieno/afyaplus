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

class BedsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/bedslist[/{id}]", [PermissionMiddleware::class], "list.beds")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/bedsadd[/{id}]", [PermissionMiddleware::class], "add.beds")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedsAdd");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/bedsedit[/{id}]", [PermissionMiddleware::class], "edit.beds")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/bedsdelete[/{id}]", [PermissionMiddleware::class], "delete.beds")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BedsDelete");
    }
}
