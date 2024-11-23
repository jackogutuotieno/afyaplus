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

class ExportlogController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/exportloglist[/{FileId:.*}]", [PermissionMiddleware::class], "list.exportlog")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExportlogList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/exportlogadd[/{FileId:.*}]", [PermissionMiddleware::class], "add.exportlog")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExportlogAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/exportlogview[/{FileId:.*}]", [PermissionMiddleware::class], "view.exportlog")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExportlogView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/exportlogedit[/{FileId:.*}]", [PermissionMiddleware::class], "edit.exportlog")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExportlogEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/exportlogdelete[/{FileId:.*}]", [PermissionMiddleware::class], "delete.exportlog")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ExportlogDelete");
    }
}
