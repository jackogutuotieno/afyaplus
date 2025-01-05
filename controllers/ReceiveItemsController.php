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

class ReceiveItemsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/receiveitemslist[/{id}]", [PermissionMiddleware::class], "list.receive_items")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReceiveItemsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/receiveitemsadd[/{id}]", [PermissionMiddleware::class], "add.receive_items")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReceiveItemsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/receiveitemsview[/{id}]", [PermissionMiddleware::class], "view.receive_items")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReceiveItemsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/receiveitemsedit[/{id}]", [PermissionMiddleware::class], "edit.receive_items")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReceiveItemsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/receiveitemsdelete[/{id}]", [PermissionMiddleware::class], "delete.receive_items")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReceiveItemsDelete");
    }
}
