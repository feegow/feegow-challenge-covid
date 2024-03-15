<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\OpenApi(
 *   @OA\Info(
 *     title="API de Vacinação de Funcionários",
 *     version="1.0.0",
 *     description="Uma API para registro de vacinação de funcionários contra a COVID-19.",
 *     @OA\Contact(
 *       email="suporte@empresa.com",
 *       name="Suporte Técnico"
 *     )
 *   )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
