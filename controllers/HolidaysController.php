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

class HolidaysController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/holidayslist[/{id}]", [PermissionMiddleware::class], "list.holidays")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "HolidaysList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/holidaysadd[/{id}]", [PermissionMiddleware::class], "add.holidays")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "HolidaysAdd");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/holidaysedit[/{id}]", [PermissionMiddleware::class], "edit.holidays")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "HolidaysEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/holidaysdelete[/{id}]", [PermissionMiddleware::class], "delete.holidays")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "HolidaysDelete");
    }
}
