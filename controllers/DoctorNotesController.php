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

class DoctorNotesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/doctornoteslist[/{id}]", [PermissionMiddleware::class], "list.doctor_notes")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorNotesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/doctornotesadd[/{id}]", [PermissionMiddleware::class], "add.doctor_notes")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorNotesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/doctornotesview[/{id}]", [PermissionMiddleware::class], "view.doctor_notes")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorNotesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/doctornotesedit[/{id}]", [PermissionMiddleware::class], "edit.doctor_notes")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorNotesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/doctornotesdelete[/{id}]", [PermissionMiddleware::class], "delete.doctor_notes")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DoctorNotesDelete");
    }
}
