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
use Zend\Db\Sql\Sql;
use Zend\Authentication\Result;

class IndexController extends AbstractActionController
{

private $termin_exist;
    public function indexAction()
    {

        if (isset ($_GET["task1"])) {
            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

            $stmt = $Adapter->query("SELECT id, time, type, category FROM (SELECT id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id, time, TYPE , 'warning' AS category FROM warnings201404)s ORDER BY UNIX_TIMESTAMP( time ) DESC LIMIT 0 , 200");
            $result = $stmt->execute();
            $this->layout('layout/layout');
            $viewmodel = new ViewModel(array(
                'pagetitle' => "Test Project | Home",
                'show_200' => $result
            ));

            return $viewmodel;

        }

        if (isset($_GET["task2"])) {
            $terminal_id = $_GET["terminal_id"];
            $from_date = $_GET["from_date"];
            $to_date = $_GET["to_date"];


            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
//    $sql="SELECT id,terminal_id, time, type, category FROM (SELECT id,terminal_id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201404)s WHERE time >= ? AND time <= ? AND terminal_id = ?";
            $sql = "SELECT id,terminal_id, time, type, category FROM (SELECT id,terminal_id, time,TYPE , 'notice' AS category FROM notices201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'notice' AS category FROM notices201404 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201402 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201403 UNION ALL SELECT id,terminal_id, time, TYPE , 'warning' AS category FROM warnings201404)s WHERE time >= ? AND time <= ? AND terminal_id = ?";
            $stmt = $Adapter->query($sql, array($from_date, $to_date, $terminal_id));
            $viewmodel = new ViewModel(array(
                'pagetitle' => "Test Project | Show date",
                'show_date' => $stmt
            ));
            return $viewmodel;
        }

        if (isset($_GET["task3"])) {
            $terminal_id = $_GET["terminal_id"];
            /* Verify if the */
            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $sql = "SELECT terminal_id FROM (SELECT * FROM notices201402
UNION ALL
SELECT * FROM notices201403
UNION ALL
SELECT * FROM notices201404
UNION ALL
SELECT * FROM warnings201402
UNION ALL
SELECT * FROM warnings201403
UNION ALL
SELECT * FROM warnings201404)s WHERE terminal_id = ?";

            $stmt = $Adapter->query($sql, array($terminal_id));

            if (count($stmt) != 0) {
                $uniqueId = time() . mt_rand();
                foreach ($stmt as $key => $value) {
//        print_r($value->terminal_id);
                    $sql = 'INSERT INTO devices VALUES (' . $value->terminal_id . ',"' . md5($uniqueId) . '")';
                    $Adapter->query($sql, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
                }
                $viewmodel = new ViewModel(array(
                    'device_id' => md5($uniqueId)
                ));


            } else {
                $viewmodel = new ViewModel(array(
                    'terminal_error' => "Terminal(s), that given by you is/are not found"
                ));
            }
            return $viewmodel;
        }


        if (isset($_GET["task4"])) {

            $terminal_id = $_GET["terminal_id"];
            $device_id = $_GET["device_id"];

            $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $sql = "SELECT terminal_id FROM devices WHERE terminal_id=? AND device_id=?";

            $stmt = $Adapter->query($sql, array($terminal_id, $device_id));
           if (count($stmt) != 0) {
               foreach ($stmt as $key => $value) {
                   $this->termin_exist=$value->terminal_id;
               }
               $Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
               $sql = "SELECT time,
TYPE , category
FROM (

SELECT terminal_id, time,
TYPE , 'notice' AS category
FROM notices201402
UNION ALL SELECT terminal_id, time,
TYPE , 'notice' AS category
FROM notices201403
UNION ALL SELECT terminal_id, time,
TYPE , 'notice' AS category
FROM notices201404
UNION ALL SELECT terminal_id, time,
TYPE , 'warning' AS category
FROM warnings201402
UNION ALL SELECT terminal_id, time,
TYPE , 'warning' AS category
FROM warnings201403
UNION ALL SELECT terminal_id, time,
TYPE , 'warning' AS category
FROM warnings201404
)s
WHERE terminal_id = ?";

               $stmt = $Adapter->query($sql,array($this->termin_exist));



                $viewmodel = new ViewModel(array(
                    'terminal_devices' => $stmt
                ));
               return $viewmodel;

            } else {
                echo "This device with the given terminal_id is not in the database !";
                $viewmodel = new ViewModel(array(
                    'error_term' => "This device with the given terminal_id is not in the database !"
                ));



            }




            return $viewmodel;
        }


      echo "asd";


        $this->layout('layout/layout');
        $viewmodel = new ViewModel();
        return $viewmodel;

    }

}
