<?php

/**
 * @file
 * Contains \Drupal\oauth_manual_tokens\Controller\OAuthManualTokensController.
 */

namespace Drupal\oauth_manual_tokens\Controller;

use Drupal\Core\Url;
use Drupal\Core\Utility\LinkGeneratorInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\user\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller routines for oauth routes.
 */
class OAuthManualTokensController extends \Drupal\oauth\Controller\OAuthController implements ContainerInjectionInterface {

  /**
   * {@inheritdoc}
   */
  public function consumers(UserInterface $user) {

    // OAuth decorates the return as a string when it is really a render array.
    /* @var $list array */
    $list = parent::consumers($user);

    if ($user->hasPermission('create manual consumer')) {

      // Protect against the possibility that OAuth changes the page structure.
      if (array_key_exists('heading', $list)) {
        $heading_key = 'heading';
        $heading = $list[$heading_key];
        $list[$heading_key] = [];
        $list[$heading_key][] = $heading;
        $list[$heading_key][]['#markup'] = ' | ';
      } else {
        $heading_key = 'manual_footer';
      }

      $list[$heading_key][]['#markup'] = $this->linkGenerator->generate(
        $this->t('Manually add consumer'),
        Url::fromRoute('oauth_manual_tokens.user_consumer_add',
          array('user' => $user->id())
        )
      );
    }

    return $list;
  }
}
