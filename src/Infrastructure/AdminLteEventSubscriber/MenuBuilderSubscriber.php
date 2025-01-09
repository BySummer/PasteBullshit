<?php

namespace App\Infrastructure\AdminLteEventSubscriber;

use KevinPapst\AdminLTEBundle\Event\BreadcrumbMenuEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemInterface;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class MenuBuilderSubscriber implements EventSubscriberInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security    = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SidebarMenuEvent::class    => ['onSetupNavbar', 100],
            BreadcrumbMenuEvent::class => ['onSetupNavbar', 100],
        ];
    }

    public function onSetupNavbar(SidebarMenuEvent $event)
    {
        $this->setupServerItem($event);
        $this->setupPlayerItem($event);
        $this->activateByRoute($event->getRequest()->get('_route'), $event->getItems());
    }

    private function setupServerItem(SidebarMenuEvent $event)
    {
        $server = new MenuItemModel(
            'server',
            'Сервера',
            null,
            [],
            'far fas fa-network-wired'
        );
        $server->addChild(
            new MenuItemModel(
                'server-form',
                'Управление',
                'admin_server_show',
                [],
                'fas fa-bars'
            )
        );

        $event->addItem($server);
    }

    private function setupPlayerItem(SidebarMenuEvent $event)
    {
        $player = new MenuItemModel(
            'player',
            'Игроки',
            null,
            [],
            'far fas fa-user-alt'
        );
        $player->addChild(
            new MenuItemModel(
                'player-form',
                'Управление',
                'admin_player_show',
                [],
                'fas fa-bars'
            )
        );
        $player->addChild(
            new MenuItemModel(
                'player-form',
                'История посещений',
                'admin_player_visit_log_show',
                [],
                'fa fa-history'
            )
        );

        $event->addItem($player);
    }

    /**
     * @param MenuItemInterface[] $items
     */
    protected function activateByRoute(string $route, array $items)
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif ($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }
    }
}