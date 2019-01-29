<?php
namespace Bmbyhood\Rest;

use Bmbyhood\Entities;
use Bmbyhood\Rest\QueryParams\TimeLineSummaryQueryParams;
use Bmbyhood\Rest\Response\TimeLineStats;
use Bmbyhood\Rest\Response\TimeLineResponse;

class BmbySyncRest extends EntityRest
{
    /**
     * Update or insert repository properties
     *
     * @param Entities\Property[] $properties
     * @return RestResponse
     * @throws \Exception
     */
    public function postRepositoryProperties($properties)
    {
        if (!is_array($properties)) {
            throw new \Exception('The argument should be array of Entities\Property');
        }

        $data = [];

        foreach ($properties as $property) {
            $data[] = $property->toArray();
        }

        $response = $this->client->post('bmbysync/repositoryproperties', $data);

        return $this->response($response);
    }

    /**
     * Update or insert repository property
     *
     * @param Entities\Property $property
     * @return RestResponse
     *
     */
    public function postRepositoryProperty(Entities\Property $property)
    {
        $response = $this->client->post('bmbysync/repositoryproperty', $property->ToArray());

        return $this->response($response);
    }

    /**
     * Update or insert agency property
     *
     * @param Entities\Property $property
     * @return RestResponse
     *
     */
    public function postAgencyProperty(Entities\Property $property)
    {
        $response = $this->client->post('bmbysync/agencyproperty', $property->ToArray());

        return $this->response($response);
    }

    /**
     * Update or insert customer
     *
     * @param Entities\Customer $customer
     * @return RestResponse
     */
    public function postCustomer(Entities\Customer $customer)
    {
        $response = $this->client->post('bmbysync/customer', $customer->ToArray());

        return $this->response($response);
    }

    /**
     * Update or insert CRM Task
     *
     * @param Entities\CrmTask $crmTask
     * @return RestResponse
     */
    public function postCrmTask(Entities\CrmTask $crmTask)
    {
        $response = $this->client->post('bmbysync/crmtask', $crmTask->ToArray());

        return $this->response($response);
    }

    /**
     * Update or insert agency broker from bmby
     *
     * @param Entities\BmbyBroker $broker
     * @return RestResponse
     */
    public function postBmbyBroker(Entities\BmbyBroker $broker)
    {
        $response = $this->client->post('bmbysync/agencybroker', $broker->ToArray());

        return $this->response($response);
    }

    /**
     * Update agency broker settings from bmby
     *
     * @param Entities\BmbyBrokerSettings $brokerSettings
     * @return RestResponse
     */
    public function postBmbyBrokerSettings(Entities\BmbyBrokerSettings $brokerSettings)
    {
        $response = $this->client->put('bmbysync/brokerportalsettings', $brokerSettings->ToArray(), $brokerSettings->getFiles(), true);

        return $this->response($response);
    }

    /**
     * Get Localization
     *
     * @param int $localizationId
     * @return RestResponse
     */
    public function getLocalization($localizationId)
    {
        $response = $this->client->get('bmbysync/localizations/'.$localizationId, []);

        return $this->response($response);
    }

    /**
     * Get Broker Settings
     *
     * @param int $projectId
     * @param int $userId
     *
     * @return RestResponse
     */
    public function getBrokerSettings($projectId, $userId, $bmbyInstanceId = '')
    {
        $response = $this->client->get("bmbysync/brokersettings/$projectId/$userId", ['bmbyInstanceId' => $bmbyInstanceId]);

        return $this->response($response);
    }

    /**
     * List Localizations
     *
     * @return RestResponse
     */
    public function listLocalizations()
    {
        $response = $this->client->get('bmbysync/localizations', []);

        return $this->response($response);
    }

    /**
     * @param TimeLineSummaryQueryParams $queryParams
     * @return TimeLineStats
     */
    public function TimeLineStats(TimeLineSummaryQueryParams $queryParams)
    {
        $response = $this->client->get('bmbysync/timeline-stats', $queryParams->toArray());

        return $this->response($response, TimeLineStats::class);
    }

    /**
     * @param TimeLineSummaryQueryParams $queryParams
     * @return TimeLineResponse
     */
    public function listTimeLineSummary(TimeLineSummaryQueryParams $queryParams)
    {
        $response = $this->client->get('bmbysync/time-line-summary', $queryParams->toArray());

        return $this->response($response, TimeLineResponse::class);
    }

    /**
     * @param TimeLineSummaryQueryParams $queryParams
     * @return TimeLineResponse
     */
    public function listTimeLine(TimeLineSummaryQueryParams $queryParams)
    {
        $params = (string)$queryParams;
        $params = $params ? '?'.$params : '';

        $response = $this->client->get('bmbysync/time-line'.$params, []);

        return $this->response($response, TimeLineResponse::class);
    }

    /**
     * @param string $eventIdß
     *
     * @return RestResponse
     */
    public function setTimeLineEventAsDone($eventId)
    {
        $response = $this->client->put('bmbysync/set-event-as-done/'.$eventId, []);

        return $this->response($response);
    }
}

?>