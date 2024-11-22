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

class LabSpecimensController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/labspecimenslist[/{id}]", [PermissionMiddleware::class], "list.lab_specimens")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabSpecimensList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/labspecimensadd[/{id}]", [PermissionMiddleware::class], "add.lab_specimens")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabSpecimensAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/labspecimensview[/{id}]", [PermissionMiddleware::class], "view.lab_specimens")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabSpecimensView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/labspecimensedit[/{id}]", [PermissionMiddleware::class], "edit.lab_specimens")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabSpecimensEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/labspecimensdelete[/{id}]", [PermissionMiddleware::class], "delete.lab_specimens")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabSpecimensDelete");
    }
}
