<?php
namespace Bmbyhood\Rest;

use Bmbyhood\Entities;

class QueriesRest extends EntityRest
{
    /**
     * @param Entities\Query $query
     *
     * @return RestResponse
     */
    public function createQuery(Entities\Query $query)
    {
        $response = $this->client->post('queries', $query->ToArray());

        return $this->response($response);
    }

    /**
     * @param string $queryId
     * @return RestResponse
     *
     */
    public function deleteQuery($queryId)
    {
        $response = $this->client->delete('queries/'.$queryId);

        return $this->response($response);
    }
}

?>