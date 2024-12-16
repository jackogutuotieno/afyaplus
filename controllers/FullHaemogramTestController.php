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

class FullHaemogramTestController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramtestlist[/{id}]", [PermissionMiddleware::class], "list.full_haemogram_test")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramTestList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramtestadd[/{id}]", [PermissionMiddleware::class], "add.full_haemogram_test")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramTestAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramtestview[/{id}]", [PermissionMiddleware::class], "view.full_haemogram_test")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramTestView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramtestedit[/{id}]", [PermissionMiddleware::class], "edit.full_haemogram_test")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramTestEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramtestdelete[/{id}]", [PermissionMiddleware::class], "delete.full_haemogram_test")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramTestDelete");
    }
}
