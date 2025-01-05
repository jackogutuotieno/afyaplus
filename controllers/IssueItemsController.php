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

class IssueItemsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/issueitemslist[/{id}]", [PermissionMiddleware::class], "list.issue_items")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IssueItemsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/issueitemsadd[/{id}]", [PermissionMiddleware::class], "add.issue_items")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IssueItemsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/issueitemsview[/{id}]", [PermissionMiddleware::class], "view.issue_items")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IssueItemsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/issueitemsedit[/{id}]", [PermissionMiddleware::class], "edit.issue_items")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IssueItemsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/issueitemsdelete[/{id}]", [PermissionMiddleware::class], "delete.issue_items")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "IssueItemsDelete");
    }
}
