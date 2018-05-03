<?php

namespace Drupal\oauth_manual_tokens\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listen to the dynamic Route Events
 */
class OAuthManualTokensRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('oauth.user_consumer')) {
      $route->setDefault('_controller', '\Drupal\oauth_manual_tokens\Controller\OAuthManualTokensController::consumers');
    }
  }
}