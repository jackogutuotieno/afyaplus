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

class RadiologyRequestsQueueController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsqueuelist[/{id}]", [PermissionMiddleware::class], "list.radiology_requests_queue")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsQueueList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsqueueadd[/{id}]", [PermissionMiddleware::class], "add.radiology_requests_queue")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsQueueAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsqueueview[/{id}]", [PermissionMiddleware::class], "view.radiology_requests_queue")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsQueueView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsqueueedit[/{id}]", [PermissionMiddleware::class], "edit.radiology_requests_queue")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsQueueEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/radiologyrequestsqueuedelete[/{id}]", [PermissionMiddleware::class], "delete.radiology_requests_queue")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RadiologyRequestsQueueDelete");
    }
}
