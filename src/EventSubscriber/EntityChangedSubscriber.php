<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\EventSubscriber;

use App\Entity\Log;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of ProjectSaveListener
 *
 * @author aurelien.stride
 */
class EntityChangedSubscriber implements EventSubscriber {

    public function postFlush(PostFlushEventArgs $args) {
        //return;
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $session = new Session();
        if (!$session->get('logged'))
            return;

        foreach ($uow->getIdentityMap() as $key => $entities) {
            foreach ($entities as $id => $entity) {
                try {

                    if (!$entity)
                        continue;

                    if (($class = get_class($entity)) == Log::class)
                        continue;

                    $t = explode('\\', $class);
                    $class = end($t);

                    $logs = $em->getRepository(Log::class)->findBy(['Entity' => $class, 'FieldID' => $entity->getId()]);
                    if (count($logs))
                        continue;

                    $v = '[CREATION]';
                    $audit = new Log();
                    $audit->setDate(new \DateTime('now'));
                    $audit->setUser($session->get('logged'));
                    $audit->setField('[CREATION]');
                    $audit->setFieldID($entity->getId());
                    $audit->setEntity($class);
                    $audit->setValue($v);
                    $em->persist($audit);
                    //$em->flush();
                } catch (Exception $ex) {
                    
                }
            }
        }
    }

    public function onFlush(OnFlushEventArgs $args) {

        //return;
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $session = new Session();
        if (!$session->get('logged'))
            return;

        /*
         * Deletions
         */
        $entities = $uow->getScheduledEntityDeletions();

        foreach ($entities as $entity) {
            try {

                if (($class = get_class($entity)) == Log::class)
                    continue;
                if (!$entity->getId())
                    continue;

                $t = explode('\\', $class);
                $class = end($t);
                $v = '[DELETION]';
                $audit = new Log();
                $audit->setDate(new \DateTime('now'));
                $audit->setUser($session->get('logged'));
                $audit->setField('[DELETION]');
                $audit->setFieldID($entity->getId());
                $audit->setEntity($class);
                $audit->setValue($v);
                $em->persist($audit);
                //$em->flush();
            } catch (Exception $ex) {
                
            }
        }

        /*
         * Update
         */
        $entities = $uow->getScheduledEntityUpdates();

        foreach ($entities as $entity) {
            try {
                if (($class = get_class($entity)) == Log::class)
                    continue;
                if (!$entity->getId())
                    continue;

                $t = explode('\\', $class);
                $class = end($t);
                $changeSet = $uow->getEntityChangeSet($entity);

                foreach ($changeSet as $field => $value):
                    $v = $this->setValue($value[0]) . "\n" . ' >> ' . "\n" . $this->setValue($value[1]);
                    $audit = new Log();
                    $audit->setDate(new \DateTime('now'));
                    $audit->setUser($session->get('logged'));
                    $audit->setField($field);
                    $audit->setFieldID($entity->getId());
                    $audit->setEntity($class);
                    $audit->setValue($v);
                    $em->persist($audit);
                    //$em->flush();
                endforeach;
            } catch (Exception $ex) {
                
            }
        }

        $uow->computeChangeSets();
    }

    private function setValue($v) {
        switch (gettype($v)):
            case 'string':
            case 'integer':
            case 'double':
                return (string) $v;
                break;
            case 'array':
                return serialize($v);
                break;
            case 'object':
                if (method_exists($v, '__toString'))
                    return $v->__toString();
                if (method_exists($v, 'setTimestamp'))
                    return $v->format('Y-m-d H:i:s');
                return '[Unknown data]';
                break;
            case 'boolean':
                return $v ? 'TRUE' : 'FALSE';
                break;
        endswitch;
    }

    public function getSubscribedEvents() {
        return array(Events::onFlush, Events::postFlush);
    }

}
