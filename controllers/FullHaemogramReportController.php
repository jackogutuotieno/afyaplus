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

class FullHaemogramReportController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramreportlist[/{id}]", [PermissionMiddleware::class], "list.full_haemogram_report")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramReportList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramreportadd[/{id}]", [PermissionMiddleware::class], "add.full_haemogram_report")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramReportAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramreportview[/{id}]", [PermissionMiddleware::class], "view.full_haemogram_report")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramReportView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramreportedit[/{id}]", [PermissionMiddleware::class], "edit.full_haemogram_report")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramReportEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/fullhaemogramreportdelete[/{id}]", [PermissionMiddleware::class], "delete.full_haemogram_report")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FullHaemogramReportDelete");
    }
}
