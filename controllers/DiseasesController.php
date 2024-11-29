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

class DiseasesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/diseaseslist[/{id}]", [PermissionMiddleware::class], "list.diseases")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiseasesList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/diseasesview[/{id}]", [PermissionMiddleware::class], "view.diseases")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiseasesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/diseasesedit[/{id}]", [PermissionMiddleware::class], "edit.diseases")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiseasesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/diseasesdelete[/{id}]", [PermissionMiddleware::class], "delete.diseases")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DiseasesDelete");
    }
}
