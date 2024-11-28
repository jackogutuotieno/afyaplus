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

class PatientQueueController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/patientqueuelist[/{id}]", [PermissionMiddleware::class], "list.patient_queue")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientQueueList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientqueueadd[/{id}]", [PermissionMiddleware::class], "add.patient_queue")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientQueueAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/patientqueueview[/{id}]", [PermissionMiddleware::class], "view.patient_queue")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientQueueView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientqueueedit[/{id}]", [PermissionMiddleware::class], "edit.patient_queue")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientQueueEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientqueuedelete[/{id}]", [PermissionMiddleware::class], "delete.patient_queue")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientQueueDelete");
    }
}
