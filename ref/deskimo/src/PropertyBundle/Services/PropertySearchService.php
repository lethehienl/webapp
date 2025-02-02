<?php


namespace PropertyBundle\Services;


use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use PropertyBundle\Util\SearchUtil;

class PropertySearchService
{
  private $finder;

  public function __construct(PaginatedFinderInterface $finder)
  {
    $this->finder = $finder;
  }

  public function searchProperty($payload) {
    $boolQuery = new \Elastica\Query\BoolQuery();
    $options = [];

    if (isset($payload['keyword'])) {
      $fieldQuery = new \Elastica\Query\MatchQuery();
      $fieldQuery->setFieldQuery('name', $payload['keyword']);
      $boolQuery->addShould($fieldQuery);
    }

    if (@$payload['is_open']) {
      $isOpenQuery = new \Elastica\Query\Terms('isOpen', [$payload['is_open']]);
      $boolQuery->addMust($isOpenQuery);
    }

    if (isset($payload['country_code'])) {
      $countryCodeQuery = new \Elastica\Query\Terms('countryCode', [$payload['country_code']]);
      $boolQuery->addMust($countryCodeQuery);
    }

    if (isset($payload['lat']) && isset($payload['lng']) && @$payload['distance']) {
        $distance = $payload['distance'];
        $distanceQuery = new \Elastica\Query\GeoDistance('geoLocation',
          ['lat' => $payload['lat'], 'lon' => $payload['lng']],
          $distance
        );

        $boolQuery->addMust($distanceQuery);
    }

    $finalQuery = new \Elastica\Query($boolQuery);

    if (isset($payload['sort_by'])) {
      $sortData = @SearchUtil::SORT_MAPPING[$payload['sort_by']];

      if ($payload['sort_by'] != SearchUtil::NEAREST_SORT_TYPE) {
        $finalQuery->setSort(array($sortData['field'] => array('order' => $sortData['order'])));
      } else {
        $finalQuery->setSort(array($sortData['field'] => array(
          'order' => $sortData['order'],
          'unit' => @$sortData['unit'],
          'geoLocation' => [$payload['lng'], $payload['lat']]
          )));
      }
    }

    $results = $this->finder->findPaginated($finalQuery, $options);

    if (@$payload['page']) {
      $results->setCurrentPage($payload['page']);
    }

    return [
      'results' => $results->getCurrentPageResults(),
      'has_next_page' => $results->hasNextPage(),
      'next_page' => $results->hasNextPage() ? $results->getNextPage() : 0,
      'current_page' => $results->getCurrentPage(),
      'total_pages' => $results->getNbPages(),
      'total_results' => $results->count(),
    ];
  }
}