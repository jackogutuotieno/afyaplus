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

class ItemPurchasesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/itempurchaseslist[/{id}]", [PermissionMiddleware::class], "list.item_purchases")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemPurchasesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/itempurchasesadd[/{id}]", [PermissionMiddleware::class], "add.item_purchases")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemPurchasesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/itempurchasesview[/{id}]", [PermissionMiddleware::class], "view.item_purchases")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemPurchasesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/itempurchasesedit[/{id}]", [PermissionMiddleware::class], "edit.item_purchases")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemPurchasesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/itempurchasesdelete[/{id}]", [PermissionMiddleware::class], "delete.item_purchases")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ItemPurchasesDelete");
    }
}
