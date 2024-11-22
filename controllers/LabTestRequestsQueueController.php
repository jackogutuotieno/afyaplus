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

class LabTestRequestsQueueController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsqueuelist[/{id}]", [PermissionMiddleware::class], "list.lab_test_requests_queue")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsQueueList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsqueueadd[/{id}]", [PermissionMiddleware::class], "add.lab_test_requests_queue")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsQueueAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsqueueview[/{id}]", [PermissionMiddleware::class], "view.lab_test_requests_queue")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsQueueView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsqueueedit[/{id}]", [PermissionMiddleware::class], "edit.lab_test_requests_queue")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsQueueEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/labtestrequestsqueuedelete[/{id}]", [PermissionMiddleware::class], "delete.lab_test_requests_queue")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "LabTestRequestsQueueDelete");
    }
}
