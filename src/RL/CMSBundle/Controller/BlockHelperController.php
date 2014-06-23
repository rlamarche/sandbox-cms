<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 23/06/14
 * Time: 20:40
 */

namespace RL\CMSBundle\Controller;

use RL\CMSBundle\Entity\Block;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlockHelperController extends Controller {
    public function renderAction($name, $template = null)
    {
        $block = $this->getDoctrine()->getRepository('RLCMSBundle:Block')->loadByName($name);
        if (is_null($block)) {
            $block = new Block();
            $block->setTitle('Undefined block');
            $block->setContent('The block "'.$name.'" is not yet defined.');
        }
        if ($template == null) {
            $template = $block->getTemplate();
        }
        return $this->render('RLCMSBundle:BlockHelper:'.$template.'.html.twig', array('block' => $block));
    }
}