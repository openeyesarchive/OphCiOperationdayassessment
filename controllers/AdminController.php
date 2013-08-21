<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class AdminController extends ModuleAdminController
{
    public function actionViewCataractNurses()
    {
        $this->render('/admin/cataractnurses',array(

        ));
    }

    public function actionDeleteCataractNurses()
    {

        $criteria = new CDbCriteria;
        $criteria->addInCondition('id',@$_POST['cataract_nurse']);

        if (OphCiOperationdayassessment_Cataract_Nurses::model()->deleteAll($criteria)) {
            echo "1";
            Audit::add('admin-CataractNurse','delete',serialize($_POST));
        } else {
            echo "0";
        }
    }

    public function actionVerifyDeleteCataractNurses()
    {

        foreach (OphCiOperationdayassessment_Cataract_Nurses::model()->findAllByPk(@$_POST['id']) as $cb) {
            if (!$cb->canDelete()) {
                echo "0";
                return;
            }
        }

        echo "1";
    }

    public function actionEditCataractNurse()
    {
        $this->actionAddCataractNurse();
    }

    public function actionAddCataractNurse()
    {

        if (isset($_GET['id'])) {
            if (!$nurse = OphCiOperationdayassessment_Cataract_Nurses::model()->findByPk(@$_GET['id']))
            {
                throw new Exception("OphCiOperationdayassessment_Cataract_Nurses not found: ".@$_GET['id']);
            }
        }
        else
            $nurse = new OphCiOperationdayassessment_Cataract_Nurses;


        $errors = array();

        if (!empty($_POST)) {

            $nurse->name = $_POST['OphCiOperationdayassessment_Cataract_Nurses']['name'];

            if (!$nurse->validate())
            $errors = $nurse->getErrors();

            if (empty($errors)) {

                    if (!$nurse->save()) {
                        throw new Exception("Unable to save cataract nurse");
                    }
            }
            $this->redirect('viewcataractnurses/');
        }

        $this->render('/admin/editcataractnurse',array(
            'nurse' => $nurse,
            'errors' => $errors,
        ));
    }

}