<?php

namespace JrvZf2SimpleMvc\Controller;

use
    JrvZf2SimpleMvc\Exception\SimpleMvcException;
use
    Zend\Http\Response;
use
    Zend\Mvc\Controller\AbstractActionController;
use
    Zend\View\Model\ViewModel;

/**
 * Class TestController
 *
 * LongDescHere
 *
 * PHP version 5
 */
class SimpleController extends AbstractActionController
{
    /**
     * indexAction
     *
     * @return array|ViewModel
     * @throws \JrvZf2SimpleMvc\Exception\SimpleMvcException
     */
    public function indexAction()
    {
        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        $protocol = ($request->getServer('HTTPS') != 'on' ? 'http://' : 'https://');
        $baseUrl = $protocol . $request->getServer('HTTP_HOST');

        $config = $this->getServiceLocator()->get('config');

        /** @var \Zend\Mvc\Router\RouteMatch $routeMatch */
        $routeMatch = $this->getEvent()->getRouteMatch(); //->getParam('alias');
        $routeName = $routeMatch->getMatchedRouteName();

        $routeConfig = $config['router']['routes'][$routeName];
        $variables = array(
            'baseUrl' => $baseUrl,
        );

        $viewModel = new ViewModel();

        if (!isset($routeConfig['viewConfig'])) {

            throw new SimpleMvcException('Missing viewConfig in route configuration.');
        }

        $viewConfig = $routeConfig['viewConfig'];

        if (isset($viewConfig['template'])) {

            $viewModel->setTemplate(
                realpath($routeConfig['viewConfig']['template'])
            );
        } else {

            throw new SimpleMvcException("Missing viewConfig['template'] in route configuration.");
        }

        if (isset($viewConfig['terminate'])) {

            $viewModel->setTerminal($viewConfig['terminate']);
        }

        if (isset($viewConfig['options'])) {

            $viewModel->setOptions($viewConfig['options']);
        }

        if (isset($viewConfig['variables'])) {

            $variables = array_merge($viewConfig['variables'], $variables);

            $viewModel->setVariables($variables);
        }

        return $viewModel;
    }

}
