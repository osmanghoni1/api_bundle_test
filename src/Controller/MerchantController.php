<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Driver\Connection;

class MerchantController extends AbstractController
{
    /**
     * @Post("/create_mid", name="create_mid")
     */
    public function postMerchantAction(Request $request, Connection $connection)
    {
        $data = json_decode($request->getContent(), true);
        $mid = $data['mid'];
        $name = $data['name'];
        $stmt = $connection->prepare("INSERT INTO public.merchants (mid, name) VALUES (:mid, :name) RETURNING id");
        $stmt->execute([':mid' => $mid, ':name' => $name]);
        $id = $stmt->fetchColumn();

        return new JsonResponse(['table_id' => $id]);
    }

    /**
     * @Put("/update_mid_dba", name="update_mid_dba")
     */
    public function putMerchant(Request $request, Connection $connection)
    {
        $data = json_decode($request->getContent(), true);
        $mid = $data['mid'];
        $name = $data['name'];
        $stmt = $connection->prepare("UPDATE public.merchants SET name = :name WHERE mid = :mid RETURNING name");
        $stmt->execute([':mid' => $mid, ':name' => $name]);
        $newName = $stmt->fetchColumn();

        return new JsonResponse(['new_dba' => $newName]);
    }

    /**
     * @Delete("/delete_merchant", name="delete_merchant")
     */
    public function deleteMerchant(Request $request, Connection $connection)
    {
        $data = json_decode($request->getContent(), true);
        $mid = $data['mid'];
        $stmt = $connection->prepare("DELETE FROM public.merchants WHERE mid = :mid RETURNING id");
        $stmt->execute([':mid' => $mid]);
        $id = $stmt->fetchColumn();
        return new JsonResponse(['id' => $id]);
    }

}
