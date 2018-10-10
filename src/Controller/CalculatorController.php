<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class CalculatorController extends AbstractController
{
    /**
     * @Post("/api/calc", name="calc");
     */
    public function postCalcAction(Request $request)
    {
        
        $data = json_decode($request->getContent(), true);
        $op = $data['op'];
        $n1 = $data['n1'];
        $n2 = $data['n2'];
        return new JsonResponse($this->do_operation($op, $n1, $n2));
    }

    private function do_operation(string $op, int $n1, int $n2) {
        if ($op === '*') {
            return ['product' => ($n1 * $n2)];
        }

        if ($op === '+') {
            return [ 'sum' => ($n1 + $n2)];
        }

        if ($op === '-') {
            return ['difference' => ($n1 - $n2)];
        }

        if ($op === '/' && $n2 !== 0) {
            return ['quotient' => ($n1 / $n2)];
        }

        if ($op === '/' && $n2 == 0) {
            return 'undefined';
        }

    }
}
