<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Zend\View\Model\JsonModel;
class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        if (isset ($_GET["task1"]))    {
            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

            $stmt = $Adapter->query("SELECT id, time, type, category FROM (SELECT id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201404)s ORDER BY UNIX_TIMESTAMP( time ) DESC LIMIT 0 , 200");
            $result = $stmt->execute();
            $this->layout('layout/layout');
            $viewmodel = new ViewModel(array(
                'pagetitle'      => "Test Project | Home",
    'show_200' => $result
));

            return $viewmodel;

}

        if (isset($_GET["task2"]))    {
$terminal_id=$_GET["terminal_id"];
$from_date=$_GET["from_date"];
$to_date=$_GET["to_date"];




            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
//    $sql="SELECT id,terminal_id, time, type, category FROM (SELECT id,terminal_id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201404)s WHERE time >= ? AND time <= ? AND terminal_id = ?";
            $sql="SELECT id,terminal_id, time, type, category FROM (SELECT id,terminal_id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201404)s WHERE time >= ? AND time <= ? AND terminal_id = ?";
            $stmt = $Adapter->query($sql,array($from_date,$to_date,$terminal_id));

//            $result = $stmt->execute();


            $viewmodel = new ViewModel(array(
                'pagetitle'      => "Test Project | Show date",
                'show_date' => $stmt
            ));


            return $viewmodel;
        }

        if (isset($_GET["task3"]))    {
            $terminal_id=$_GET["terminal_id"];
            $from_date=$_GET["from_date"];
            $to_date=$_GET["to_date"];




            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
//    $sql="SELECT id,terminal_id, time, type, category FROM (SELECT id,terminal_id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201404)s WHERE time >= ? AND time <= ? AND terminal_id = ?";
            $sql="SELECT id,terminal_id, time, type, category FROM (SELECT id,terminal_id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201404)s WHERE time >= ? AND time <= ? AND terminal_id = ?";
            $stmt = $Adapter->query($sql,array($from_date,$to_date,$terminal_id));

//            $result = $stmt->execute();


            $viewmodel = new ViewModel(array(
                'pagetitle'      => "Test Project | Show date",
                'show_date' => $stmt
            ));


            return $viewmodel;
        }

//        if (isset ($_GET["task3"]))    {
//            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
//
//            $stmt = $Adapter->query("SELECT id, time, type, category FROM (SELECT id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201404)s ORDER BY UNIX_TIMESTAMP( time ) DESC LIMIT 0 , 200");
//            $result = $stmt->execute();
//            $this->layout('layout/layout');
//            $viewmodel = new ViewModel(array(
//                'pagetitle'      => "Test Project | Home",
//                'show_200' => $result
//            ));
//
//            return $viewmodel;
//
//        }





        $this->layout('layout/layout');
        $viewmodel = new ViewModel();


        return $viewmodel;

    }
//    public function showAction()
//    {
//
//
//
//
//
//    }
}
